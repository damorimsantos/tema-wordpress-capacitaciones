import puppeteer from 'file:///c:/Users/damor/Documents/ssh-sftp-wordpress-hashtag/node_modules/puppeteer-core/lib/esm/puppeteer/puppeteer-core.js';

const CHROME = 'C:/Program Files/Google/Chrome/Application/chrome.exe';
const BASE = 'https://hashtagcapacitaciones.com';
const PAGES = ['/', '/blog/', '/sifecha-en-excel/', '/curso-excel-gratis/', '/pg-inscripcion-ia/', '/acceso-portal/'];

const violations = new Set();
const pageErrors = [];

const browser = await puppeteer.launch({
  executablePath: CHROME,
  headless: 'new',
  args: ['--no-sandbox', '--disable-gpu', '--ignore-certificate-errors'],
});

for (const path of PAGES) {
  const page = await browser.newPage();
  await page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36');
  // Capture CSP report-only violations directly from the DOM event (most reliable).
  await page.evaluateOnNewDocument(() => {
    window.__cspV = [];
    document.addEventListener('securitypolicyviolation', (e) => {
      window.__cspV.push({ d: e.effectiveDirective || e.violatedDirective, u: e.blockedURI });
    });
  });
  page.on('pageerror', (e) => pageErrors.push(`${path}: ${e.message}`));
  const sep = path.includes('?') ? '&' : '?';
  try {
    await page.goto(`${BASE}${path}${sep}_cb=${Date.now()}`, { waitUntil: 'networkidle2', timeout: 60000 });
  } catch (e) {
    console.error(`NAV WARN ${path}: ${e.message}`);
  }
  await new Promise((r) => setTimeout(r, 6000)); // let GTM/tracking fire
  const v = await page.evaluate(() => window.__cspV || []);
  for (const item of v) {
    let host = item.u;
    try { host = new URL(item.u).host || item.u; } catch {}
    violations.add(`${item.d}\t${host}\t(${path})`);
  }
  await page.close();
  console.error(`done ${path} — ${v.length} violations`);
}

await browser.close();
console.log('=== CSP report-only violations (directive \\t host \\t page) ===');
console.log([...violations].sort().join('\n') || '(none)');
console.log('\n=== page errors ===');
console.log(pageErrors.join('\n') || '(none)');
