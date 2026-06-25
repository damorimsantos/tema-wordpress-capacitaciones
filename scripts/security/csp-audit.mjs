import puppeteer from 'file:///c:/Users/damor/Documents/ssh-sftp-wordpress-hashtag/node_modules/puppeteer-core/lib/esm/puppeteer/puppeteer-core.js';

const CHROME = 'C:/Program Files/Google/Chrome/Application/chrome.exe';
const BASE = 'https://hashtagcapacitaciones.com';
const PAGES = [
  '/',
  '/blog/',
  '/sifecha-en-excel/',
  '/curso-excel-gratis/',
  '/pg-inscripcion-ia/',
  '/acceso-portal/',
];

// resourceType -> CSP directive bucket
const BUCKET = {
  document: 'frame-src', // sub_frame docs; top doc is self
  script: 'script-src',
  stylesheet: 'style-src',
  image: 'img-src',
  font: 'font-src',
  media: 'media-src',
  xhr: 'connect-src',
  fetch: 'connect-src',
  websocket: 'connect-src',
  eventsource: 'connect-src',
  ping: 'connect-src',
  manifest: 'connect-src',
  other: 'connect-src',
  texttrack: 'media-src',
};

const SELF = new Set(['hashtagcapacitaciones.com', 'www.hashtagcapacitaciones.com']);
const buckets = {}; // directive -> Set(origin)
const frames = new Set();
const consoleViolations = [];

function addOrigin(directive, url) {
  try {
    const u = new URL(url);
    if (u.protocol === 'data:' || u.protocol === 'blob:') {
      (buckets[directive] ||= new Set()).add(u.protocol);
      return;
    }
    const origin = `${u.protocol}//${u.host}`;
    if (SELF.has(u.host)) return; // 'self' covers it
    (buckets[directive] ||= new Set()).add(origin);
  } catch { /* ignore */ }
}

const browser = await puppeteer.launch({
  executablePath: CHROME,
  headless: 'new',
  args: ['--no-sandbox', '--disable-gpu', '--ignore-certificate-errors'],
});

for (const path of PAGES) {
  const page = await browser.newPage();
  await page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36');
  page.on('request', (req) => {
    const rt = req.resourceType();
    const url = req.url();
    if (rt === 'document') {
      // sub-frame documents -> frame-src; top doc -> self
      if (req.frame() && req.frame() !== page.mainFrame()) addOrigin('frame-src', url);
      return;
    }
    const dir = BUCKET[rt] || 'connect-src';
    addOrigin(dir, url);
  });
  page.on('framenavigated', (f) => { try { frames.add(new URL(f.url()).host); } catch {} });
  try {
    await page.goto(BASE + path, { waitUntil: 'networkidle2', timeout: 60000 });
  } catch (e) {
    console.error(`NAV WARN ${path}: ${e.message}`);
  }
  await new Promise((r) => setTimeout(r, 5000)); // let GTM/tracking fire
  await page.close();
  console.error(`done ${path}`);
}

await browser.close();

const out = {};
for (const [dir, set] of Object.entries(buckets)) {
  out[dir] = [...set].sort();
}
console.log(JSON.stringify(out, null, 2));
