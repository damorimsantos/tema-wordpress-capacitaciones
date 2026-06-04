<?php
/*
Template Name: Acceso al Portal
*/

/**
 * Pagina-ponte de acesso ao portal do aluno (capacitaciones).
 *
 * Durante a migracao do portal, os botoes de "Inicio de sesion" levam o aluno
 * para ca. Ele informa o e-mail e o backend (REST /wp-json/hashtag/v1/consulta-portal)
 * consulta o portal antigo (e, se necessario, o backoffice do novo) para
 * descobrir o destino certo e redirecionar.
 *
 * Standalone (nao usa get_header/get_footer): tela focada, sem distracao.
 *
 * @package Hashtag
 */

if (! defined('ABSPATH')) {
    exit;
}

$assets_base_uri = get_template_directory_uri() . '/desenvolvimento_hashtag/assets';
$logo_uri        = $assets_base_uri . '/imgs/Global/logo-hashtag.webp';
$consulta_url    = esc_url_raw(rest_url('hashtag/v1/consulta-portal'));
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="noindex, nofollow" />
  <!-- Sinaliza ao GTM para nao injetar popups/overlays/widgets nesta pagina-ponte -->
  <meta name="hashtag-sem-overlays" content="1" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
    rel="stylesheet" />

  <?php wp_head(); ?>

  <style>
    .ap-page * { box-sizing: border-box; }

    .ap-page {
      margin: 0;
      min-height: 100vh;
      min-height: 100dvh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      color: #0b1020;
      background: radial-gradient(circle at 50% 0%, #16275a 0%, #0e1939 45%, #070d1f 100%);
    }

    .ap-card {
      width: 100%;
      max-width: 27rem;
      background: #fff;
      border-radius: 1.5rem;
      padding: 2.75rem 2.25rem 2.5rem;
      box-shadow: 0 1.5rem 3.5rem rgba(4, 9, 25, 0.45);
      text-align: center;
    }

    .ap-logo {
      width: 9.5rem;
      height: auto;
      margin: 0 auto 1.75rem;
      display: block;
    }

    .ap-title {
      font-size: 1.35rem;
      line-height: 1.3;
      font-weight: 700;
      margin: 0 0 0.6rem;
      color: #0e1939;
    }

    .ap-subtitle {
      font-size: 0.95rem;
      line-height: 1.5;
      font-weight: 400;
      margin: 0 0 1.75rem;
      color: #5a637a;
    }

    .ap-form {
      display: flex;
      flex-direction: column;
      gap: 0.9rem;
      text-align: left;
    }

    .ap-label {
      font-size: 0.85rem;
      font-weight: 600;
      color: #0e1939;
      margin-bottom: -0.3rem;
    }

    .ap-input {
      width: 100%;
      height: 3.4rem;
      padding: 0 1.1rem;
      font-size: 1rem;
      font-family: inherit;
      color: #0b1020;
      background: #f6f8fd;
      border: 1.5px solid #d4dbec;
      border-radius: 0.85rem;
      outline: none;
      transition: border-color 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
    }

    .ap-input::placeholder { color: #9aa3b8; }

    .ap-input:focus {
      border-color: #1f6feb;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(31, 111, 235, 0.15);
    }

    .ap-input[aria-invalid="true"] {
      border-color: #e0294b;
      box-shadow: 0 0 0 3px rgba(224, 41, 75, 0.12);
    }

    /* honeypot — fora da tela, longe de campos reais */
    .ap-hp {
      position: absolute;
      left: -9999px;
      width: 1px;
      height: 1px;
      overflow: hidden;
    }

    .ap-button {
      position: relative;
      width: 100%;
      height: 3.6rem;
      margin-top: 0.4rem;
      border: 0;
      border-radius: 2rem;
      background: hsl(152, 100%, 50%);
      color: #062013;
      font-family: inherit;
      font-size: 1.02rem;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      transition: transform 0.15s ease, filter 0.15s ease, opacity 0.15s ease;
    }

    .ap-button:hover:not(:disabled) { transform: translateY(-1px); filter: brightness(1.04); }
    .ap-button:active:not(:disabled) { transform: translateY(0); }
    .ap-button:disabled { cursor: default; opacity: 0.85; }

    .ap-button__label { display: inline-flex; align-items: center; gap: 0.5rem; }

    .ap-spinner {
      display: none;
      width: 1.35rem;
      height: 1.35rem;
      border: 2.5px solid rgba(6, 32, 19, 0.25);
      border-top-color: #062013;
      border-radius: 50%;
      animation: ap-spin 0.7s linear infinite;
    }

    .ap-button.is-loading .ap-button__label { visibility: hidden; }
    .ap-button.is-loading .ap-spinner {
      display: block;
      position: absolute;
      top: 50%;
      left: 50%;
      margin: -0.675rem 0 0 -0.675rem;
    }

    @keyframes ap-spin { to { transform: rotate(360deg); } }

    .ap-message {
      min-height: 1.1rem;
      margin: 0.9rem 0 0;
      font-size: 0.88rem;
      line-height: 1.4;
      text-align: center;
    }

    .ap-message.is-error { color: #d61f3f; }
    .ap-message.is-success { color: #0f8a4d; }

    .ap-footnote {
      margin: 1.75rem 0 0;
      font-size: 0.78rem;
      color: #8b93a7;
      line-height: 1.5;
    }

    @media (max-width: 30rem) {
      .ap-card { padding: 2.25rem 1.4rem 2rem; border-radius: 1.25rem; }
      .ap-title { font-size: 1.2rem; }
    }

    @media (prefers-reduced-motion: reduce) {
      .ap-spinner { animation-duration: 1.4s; }
      .ap-button { transition: none; }
    }
  </style>
</head>

<body <?php body_class('ap-page'); ?>>
  <main class="ap-card">
    <a href="<?php echo esc_url(home_url('/')); ?>">
      <img
        class="ap-logo"
        src="<?php echo esc_url($logo_uri); ?>"
        width="152"
        height="42"
        alt="Hashtag Capacitaciones"
        decoding="async" />
    </a>

    <h1 class="ap-title">Ingresa tu correo electrónico registrado en el Portal</h1>
    <p class="ap-subtitle">Te dirigiremos al portal correcto del alumno.</p>

    <form class="ap-form" id="ap-form" data-endpoint="<?php echo esc_url($consulta_url); ?>" novalidate>
      <label class="ap-label" for="ap-email">Correo electrónico</label>
      <input
        class="ap-input"
        type="email"
        id="ap-email"
        name="email"
        inputmode="email"
        autocomplete="email"
        autocapitalize="off"
        spellcheck="false"
        placeholder="tu@correo.com"
        aria-describedby="ap-message"
        required />

      <!-- honeypot anti-bot: humanos nao veem; bots preenchem -->
      <div class="ap-hp" aria-hidden="true">
        <label for="ap-website">No completes este campo</label>
        <input type="text" id="ap-website" name="website" tabindex="-1" autocomplete="off" />
      </div>

      <button class="ap-button" id="ap-submit" type="submit">
        <span class="ap-button__label">Ir al portal</span>
        <span class="ap-spinner" aria-hidden="true"></span>
      </button>
    </form>

    <p class="ap-message" id="ap-message" role="status" aria-live="polite"></p>

    <p class="ap-footnote">Usa el mismo correo electrónico que registraste en el portal del alumno.</p>
  </main>

  <script>
    (function () {
      var form = document.getElementById('ap-form');
      var input = document.getElementById('ap-email');
      var hp = document.getElementById('ap-website');
      var button = document.getElementById('ap-submit');
      var message = document.getElementById('ap-message');
      var endpoint = form.getAttribute('data-endpoint');
      var busy = false;

      function setMessage(text, type) {
        message.textContent = text || '';
        message.className = 'ap-message' + (type ? ' is-' + type : '');
      }

      function setLoading(state) {
        busy = state;
        button.classList.toggle('is-loading', state);
        button.disabled = state;
        button.setAttribute('aria-busy', state ? 'true' : 'false');
        input.disabled = state;
      }

      function isValidEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
      }

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (busy) return;

        // honeypot preenchido => provavel bot; nao faz nada
        if (hp && hp.value) return;

        var email = (input.value || '').trim();
        input.removeAttribute('aria-invalid');

        if (!isValidEmail(email)) {
          input.setAttribute('aria-invalid', 'true');
          setMessage('Ingresa un correo electrónico válido.', 'error');
          input.focus();
          return;
        }

        setMessage('', null);
        setLoading(true);

        fetch(endpoint, {
          method: 'POST',
          credentials: 'omit',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ email: email, website: hp ? hp.value : '' })
        })
          .then(function (res) {
            return res.json().then(function (data) {
              return { status: res.status, data: data };
            });
          })
          .then(function (result) {
            var data = result.data || {};

            if (data.ok && data.url) {
              setMessage('¡Listo! Redirigiendo...', 'success');
              window.location.assign(data.url);
              return;
            }

            setLoading(false);
            setMessage(data.message || 'No fue posible consultar ahora. Intenta de nuevo.', 'error');
          })
          .catch(function () {
            setLoading(false);
            setMessage('Error de conexión. Verifica tu conexión e intenta de nuevo.', 'error');
          });
      });
    })();
  </script>

  <?php wp_footer(); ?>
</body>

</html>
