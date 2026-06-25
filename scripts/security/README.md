# mu-plugins (cópia versionada)

Os mu-plugins da Capacitaciones vivem em `wp-content/mu-plugins/` (fora do repositório do
tema). Esta pasta guarda a **cópia versionada** deles para histórico/git.

| Arquivo | O que faz | Deploy |
|---|---|---|
| `hashtag-security-headers.php` | Security headers (X-Frame-Options, X-Content-Type-Options, Referrer-Policy, COOP/CORP, Permissions-Policy, remove X-Powered-By) + **CSP** (hoje em **report-only**) + hardening (405 em métodos exóticos, `DISALLOW_FILE_EDIT`, bloqueio de user-enum `/wp/v2/users`). | SFTP `node .vscode/upload_sftp_files.mjs wp-content/mu-plugins/hashtag-security-headers.php` |
| `hashtag-security-hardening.php` | Remove o `generator` (version disclosure) do WP. | SFTP `node .vscode/upload_sftp_files.mjs wp-content/mu-plugins/hashtag-security-hardening.php` |
| `hashtag-mailer.php` | Transporte SMTP transacional (substitui post-smtp). **INERTE** até as constantes `HASHTAG_SMTP_*` existirem no wp-config. | SFTP `node .vscode/upload_sftp_files.mjs wp-content/mu-plugins/hashtag-mailer.php` |
| `hashtag-theme-modules.php` | **Loader** dos módulos novos do tema (`inc/seo/*`, `inc/media/*`...) via `after_setup_theme` — evita tocar no `functions.php` (que diverge de prod). Lista em `$modules`. | SFTP `node .vscode/upload_sftp_files.mjs wp-content/mu-plugins/hashtag-theme-modules.php` |

## Regras

- **A fonte de deploy é o arquivo em `wp-content/mu-plugins/`** — editar lá e subir por SFTP.
  Manter esta cópia em sincronia ao mudar (é só snapshot p/ git).
- **CSP allowlist** = array `hashtag_csp_directives()`. Construído por auditoria browser-real
  (puppeteer) das páginas reais da Cap. Editar lá + SFTP + purgar `cloudways` + validar com
  cache-buster.
- **CSP está em REPORT-ONLY** (`HASHTAG_CSP_REPORT_ONLY=true`, default). Não bloqueia — só
  reporta. Flip p/ **enforce**: `define('HASHTAG_CSP_REPORT_ONLY', false);` no wp-config de prod,
  **depois** de observar tráfego real (pixels de conversão de Google Ads/Facebook disparam em
  evento de form-submit na landing de lead e podem não ter aparecido na auditoria de page-load).
- Validar violações: `csp-violations.mjs` (puppeteer, captura `securitypolicyviolation`).
