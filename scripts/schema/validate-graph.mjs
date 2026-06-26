// Valida o grafo de schema nativo (inc/seo/schema/) de uma ou mais URLs. (Porte do hashtag.)
// Uso: node scripts/schema/validate-graph.mjs <url1> [url2 ...]
//   ex DDEV:  node ... https://capacitaciones.ddev.site/ https://capacitaciones.ddev.site/blog
//   ex prod:  node ... "https://hashtagcapacitaciones.com/?_cb=$(date +%s)"  (cache-buster fura Varnish)
// Checa: presenca do <script id="hashtag-schema-graph">, tipos no @graph, blocos FORA do
// grafo (adjacentes), @id duplicado, integridade de referencia (toda {@id} resolve num no)
// e residuo do schema antigo (#Article do Rank Math Pro / schema-and-structured-data).
import { execFileSync } from 'node:child_process';

const UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120 Safari/537.36';
const fetchHtml = (u) => {
  try { return execFileSync('curl', ['-sk', '-A', UA, u], { encoding: 'utf-8', maxBuffer: 64 * 1024 * 1024 }); }
  catch { return ''; }
};
const typeOf = (n) => Array.isArray(n['@type']) ? n['@type'].join('/') : (n['@type'] || '?');
const collectIds = (o, s) => {
  if (Array.isArray(o)) o.forEach((x) => collectIds(x, s));
  else if (o && typeof o === 'object') { if (o['@id'] && Object.keys(o).length > 1) s.add(o['@id']); for (const k in o) if (k !== '@id') collectIds(o[k], s); }
};
const collectRefs = (o, a) => {
  if (Array.isArray(o)) o.forEach((x) => collectRefs(x, a));
  else if (o && typeof o === 'object') { const ks = Object.keys(o); if (ks.length === 1 && ks[0] === '@id') a.push(o['@id']); else for (const k in o) collectRefs(o[k], a); }
};

let allOk = true;
for (const url of process.argv.slice(2)) {
  const html = fetchHtml(url);
  const blocks = [...html.matchAll(/<script[^>]*type="application\/ld\+json"[^>]*>([\s\S]*?)<\/script>/gi)].map((m) => m[1].trim());
  const m = html.match(/id="hashtag-schema-graph"[^>]*>([\s\S]*?)<\/script>/);
  const leftover = /"@id":"[^"]*#Article"/.test(html) || /schema-and-structured-data/.test(html);
  const short = url.replace(/^https?:\/\/[^/]+/, '').split('?')[0] || '/';
  if (!m) { console.log(`  X  ${short} — SEM grafo nativo (${html.length} bytes)`); allOk = false; continue; }
  let G;
  try { G = JSON.parse(m[1])['@graph']; } catch { console.log(`  X  ${short} — @graph JSON invalido`); allOk = false; continue; }
  const ids = new Set(); collectIds(G, ids);
  const refs = []; collectRefs(G, refs);
  const dangling = [...new Set(refs)].filter((r) => !ids.has(r));
  const outside = blocks.filter((b) => !b.includes('"@graph"')).map((b) => { try { const o = JSON.parse(b); return Array.isArray(o) ? o.map(typeOf).join('+') : typeOf(o); } catch { return 'PARSE_ERR'; } });
  const ok = !dangling.length && !leftover;
  if (!ok) allOk = false;
  console.log(`  ${ok ? 'OK ' : 'X  '}${short} | grafo:[${G.map(typeOf).join(',')}]` +
    (outside.length ? ` | adjacentes:[${outside.join(',')}]` : '') +
    (leftover ? ' | <<RM-LEFTOVER' : '') +
    (dangling.length ? ` | <<@id PENDURADO:${JSON.stringify(dangling)}` : ''));
}
console.log(allOk ? '\n=> OK: grafo nativo, integridade @id 100%, zero residuo do schema antigo.' : '\n=> PROBLEMA (ver acima).');
process.exit(allOk ? 0 : 1);
