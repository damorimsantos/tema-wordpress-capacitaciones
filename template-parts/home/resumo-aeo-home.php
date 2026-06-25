<?php
/**
 * Bloco "respuesta primero" (answer-first) de la MARCA en la Home — AEO/GEO.
 *
 * Porte do template-parts/home/resumo-aeo-home.php do hashtag, adaptado a
 * Capacitaciones: copy en espanol (LatAm neutro, tuteo), numeros REAIS da Cap
 * (inc/hashtag-stats.php) e areas de ensino do knowsAbout do schema
 * (hashtag_schema_org_knows_about() — mesma lista visivel<->schema, reforca AEO).
 *
 * Define em 1-2 frases extraiveis "que es Hashtag Capacitaciones" (grounding de
 * entidade + prova social num passage so), com bento de KPIs e chips das areas.
 *
 * Design: dark glassmorphism na paleta da Cap (navy + verde #0f8 + dourado
 * #ffc13e). CSS puro, below-the-hero, sem imagem/JS pesado -> nao afeta LCP.
 * NAO emite schema (Organization/WebSite ja vem do grafo nativo).
 *
 * 🔴 Regra 0 (governanca de paginas): este bloco muda o VISUAL da home -> so vai
 * pra prod apos validacao + aprovacao do Diego (DDEV browser-real primeiro).
 */

if (!defined('ABSPATH')) {
    exit;
}

$stats          = function_exists('hashtag_stats_data') ? hashtag_stats_data() : [];
$alunos_np      = function_exists('hashtag_alunos_formatado') ? hashtag_alunos_formatado('curto-np') : '2.700';
$alunos_curto   = function_exists('hashtag_alunos_formatado') ? hashtag_alunos_formatado('curto') : '+2.700';
$grupo_np       = function_exists('hashtag_alunos_grupo') ? hashtag_alunos_grupo('curto-np') : '205 mil';
$grupo_curto    = function_exists('hashtag_alunos_grupo') ? hashtag_alunos_grupo('curto') : '+205 mil';
$youtube_curto  = function_exists('hashtag_youtube_inscritos') ? hashtag_youtube_inscritos() : '178 mil';
$ano_fundacao   = (int) ($stats['ano_fundacao'] ?? 2015);
$anos           = function_exists('hashtag_anos_mercado') ? hashtag_anos_mercado() : ((int) date('Y') - $ano_fundacao);

// Areas de ensino = knowsAbout do schema (mesma fonte/ordem -> consistencia
// visivel<->schema). A Cap nao tem catalogo de cursos ainda; chips sao rotulos de
// area (sem link), o que evita apontar pra paginas que nao existem (decisao Diego:
// "so o que existe hoje"). Quando o catalogo existir, viram links.
$areas = [];
if (function_exists('hashtag_schema_org_knows_about')) {
    foreach (hashtag_schema_org_knows_about() as $area_name) {
        $area_name = trim((string) $area_name);
        if ($area_name !== '') {
            $areas[] = $area_name;
        }
    }
}

// KPIs (numero grande + label), todos do inc/hashtag-stats.php. Sem nota Google e
// sem Reclame Aqui na operacao LatAm (ainda) -> nao entram no bento.
$kpis = [
    ['num' => $youtube_curto, 'unit' => '', 'label' => 'suscriptores en YouTube'],
    ['num' => $alunos_curto,  'unit' => '', 'label' => 'estudiantes en América Latina'],
    ['num' => $grupo_curto,   'unit' => '', 'label' => 'estudiantes en el grupo Hashtag'],
    ['num' => (string) $anos, 'unit' => 'años', 'label' => 'de experiencia del grupo (desde ' . $ano_fundacao . ')'],
];
?>
<section class="secao resumo-home" aria-labelledby="resumo-home-titulo">
    <style id="hashtag-resumo-home-css">
        .resumo-home{--h-green:#0f8;--h-gold:#ffc13e;position:relative;padding:6.5rem 5rem}
        .resumo-home__card{position:relative;max-width:140rem;margin:0 auto;border-radius:2.8rem;padding:4.4rem 5rem;background:radial-gradient(120% 80% at 0% 0%,rgba(0,255,136,.12),transparent 42%),radial-gradient(130% 90% at 100% 100%,rgba(255,193,62,.10),transparent 46%),rgba(12,20,46,.72);backdrop-filter:blur(16px) saturate(135%);-webkit-backdrop-filter:blur(16px) saturate(135%);box-shadow:0 3rem 7rem rgba(0,0,0,.4),inset 0 1px 0 rgba(255,255,255,.06);color:#fff}
        .resumo-home__card::before{content:"";position:absolute;inset:0;border-radius:inherit;padding:1px;background:linear-gradient(135deg,rgba(0,255,136,.6),rgba(255,193,62,.3) 45%,transparent 70%);-webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude;pointer-events:none}
        .resumo-home__eyebrow{display:inline-flex;align-items:center;gap:.7rem;font-size:1.2rem;font-weight:600;letter-spacing:.12rem;text-transform:uppercase;color:var(--h-green);background:rgba(0,255,136,.08);border:1px solid rgba(0,255,136,.28);padding:.6rem 1.2rem;border-radius:10rem;margin:0 0 1.8rem}
        .resumo-home__eyebrow::before{content:"";width:.7rem;height:.7rem;border-radius:50%;background:var(--h-gold);box-shadow:0 0 .9rem var(--h-gold)}
        .resumo-home__titulo{font-size:clamp(2.4rem,3.4vw,3.4rem);font-weight:600;line-height:1.18;margin:0 0 1.6rem;letter-spacing:-.02em}
        .resumo-home__titulo .realce{font-weight:700;background:linear-gradient(100deg,var(--h-green),var(--h-gold));-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:var(--h-green)}
        .resumo-home__resposta{font-size:1.75rem;line-height:1.6;color:rgba(255,255,255,.9);margin:0 0 3.2rem}
        .resumo-home__bento{display:grid;grid-template-columns:repeat(4,1fr);gap:1.4rem;margin:0 0 3rem}
        .resumo-home__cell{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:1.6rem;padding:2rem 1.8rem;display:flex;flex-direction:column;justify-content:center;min-height:12rem;transition:transform .25s ease,border-color .25s ease,background .25s ease}
        .resumo-home__cell:hover{transform:translateY(-.4rem);border-color:rgba(0,255,136,.45);background:rgba(255,255,255,.06)}
        .resumo-home__kpi-num{font-size:clamp(2.6rem,3.6vw,3.6rem);font-weight:800;line-height:1;letter-spacing:-.03em;background:linear-gradient(120deg,#fff,var(--h-green) 80%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:var(--h-green)}
        .resumo-home__kpi-num small{font-size:.42em;font-weight:700;-webkit-text-fill-color:var(--h-green);color:var(--h-green);margin-left:.3rem}
        .resumo-home__kpi-label{font-size:1.35rem;color:rgba(255,255,255,.7);margin-top:.9rem;font-weight:500;line-height:1.35}
        .resumo-home__areas-titulo{font-size:1.3rem;font-weight:600;letter-spacing:.06rem;text-transform:uppercase;color:rgba(255,255,255,.6);margin:0 0 1.4rem}
        .resumo-home__chips-wrap{position:relative}
        .resumo-home__chips{display:flex;flex-wrap:wrap;gap:1rem;list-style:none;margin:0;padding:0;overflow:hidden;transition:max-height .35s ease}
        .resumo-home__chips li{display:inline-flex}
        .resumo-home__chip{display:inline-flex;align-items:center;gap:.8rem;font-size:1.45rem;line-height:1.3;color:rgba(255,255,255,.92);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);padding:.8rem 1.4rem;border-radius:1.1rem}
        .resumo-home__chip::before{content:"";flex:0 0 auto;width:.8rem;height:.8rem;border-radius:50%;background:linear-gradient(135deg,var(--h-green),var(--h-gold));box-shadow:0 0 .8rem rgba(0,255,136,.6)}
        .resumo-home__toggle{display:none;align-items:center;gap:.7rem;margin:1.8rem 0 0;padding:.9rem 1.7rem;font-family:inherit;font-size:1.45rem;font-weight:600;color:var(--h-green);background:rgba(0,255,136,.09);border:1px solid rgba(0,255,136,.3);border-radius:10rem;cursor:pointer;transition:background .2s ease,border-color .2s ease}
        .resumo-home__toggle:hover{background:rgba(0,255,136,.16);border-color:rgba(0,255,136,.52)}
        .resumo-home__chips-wrap.has-toggle .resumo-home__toggle{display:inline-flex}
        .resumo-home__toggle svg{width:1.4rem;height:1.4rem;transition:transform .3s ease}
        .resumo-home__toggle[aria-expanded="true"] svg{transform:rotate(180deg)}
        @supports not ((-webkit-background-clip:text) or (background-clip:text)){
            .resumo-home__titulo .realce,.resumo-home__kpi-num{color:var(--h-green);-webkit-text-fill-color:var(--h-green)}
        }
        @media(max-width:62em){
            .resumo-home__bento{grid-template-columns:repeat(2,1fr)}
        }
        @media(max-width:47.9375em){
            .resumo-home{padding:3.9rem 1.6rem}
            .resumo-home__card{padding:2.6rem 2rem;border-radius:2rem;backdrop-filter:blur(12px) saturate(130%);-webkit-backdrop-filter:blur(12px) saturate(130%)}
            .resumo-home__resposta{font-size:1.6rem;margin-bottom:2.6rem}
            .resumo-home__bento{gap:1rem;margin-bottom:2.6rem}
            .resumo-home__cell{padding:1.6rem 1.4rem;min-height:10rem}
        }
    </style>

    <div class="resumo-home__card">
            <span class="resumo-home__eyebrow">Sobre Hashtag Capacitaciones</span>

            <h2 id="resumo-home-titulo" class="resumo-home__titulo">
                ¿Qué es <span class="realce">Hashtag Capacitaciones</span>?
            </h2>
            <p class="resumo-home__resposta">
                Hashtag Capacitaciones es la escuela online de tecnología y productividad
                del grupo Hashtag para América Latina. Enseñamos
                <strong>Excel e Inteligencia Artificial</strong> con un enfoque
                100% práctico para el mercado laboral. Formamos parte del grupo Hashtag, en el mercado
                desde <?php echo esc_html((string) $ano_fundacao); ?> y con más de
                <strong><?php echo esc_html($grupo_np); ?> estudiantes</strong>.
            </p>

            <div class="resumo-home__bento">
                <?php foreach ($kpis as $kpi) : ?>
                    <div class="resumo-home__cell">
                        <span class="resumo-home__kpi-num">
                            <?php echo esc_html($kpi['num']); ?><?php if ($kpi['unit'] !== '') : ?><small><?php echo esc_html($kpi['unit']); ?></small><?php endif; ?>
                        </span>
                        <span class="resumo-home__kpi-label"><?php echo esc_html($kpi['label']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($areas)) : ?>
                <p class="resumo-home__areas-titulo">Áreas de enseñanza</p>
                <div class="resumo-home__chips-wrap">
                    <ul id="resumo-home-chips" class="resumo-home__chips">
                        <?php foreach ($areas as $area) : ?>
                            <li><span class="resumo-home__chip"><?php echo esc_html($area); ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php $btn_more = sprintf('Ver todas las %d áreas', count($areas)); ?>
                    <button type="button" class="resumo-home__toggle" aria-expanded="false" aria-controls="resumo-home-chips"
                        data-more="<?php echo esc_attr($btn_more); ?>" data-less="Ver menos">
                        <span class="resumo-home__toggle-txt"><?php echo esc_html($btn_more); ?></span>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            <?php endif; ?>
        </div>
</section>
<?php
// Colapsa os chips de areas em 2 linhas + toggle "Ver todas" (a partir da 3a linha).
// Progressive-enhancement: sem JS todos os chips aparecem (importante p/ AEO/crawler).
if (empty($GLOBALS['hashtag_resumo_home_js_printed'])) {
    $GLOBALS['hashtag_resumo_home_js_printed'] = true;
    ?>
    <script>
    (function () {
        function setup(wrap) {
            var ul = wrap.querySelector('.resumo-home__chips');
            var btn = wrap.querySelector('.resumo-home__toggle');
            if (!ul || !btn) return;
            var items = ul.querySelectorAll('li');
            if (items.length < 3) return;

            function collapsedHeight() {
                var ulTop = ul.getBoundingClientRect().top;
                var lines = [], limit = 0;
                for (var i = 0; i < items.length; i++) {
                    var r = items[i].getBoundingClientRect();
                    var top = Math.round(r.top - ulTop);
                    if (lines.indexOf(top) === -1) {
                        if (lines.length >= 2) break;
                        lines.push(top);
                    }
                    limit = Math.max(limit, Math.round(r.bottom - ulTop));
                }
                return limit;
            }

            var collapsed = collapsedHeight();
            if (ul.scrollHeight <= collapsed + 4) return;

            var open = false;
            ul.style.maxHeight = collapsed + 'px';
            wrap.classList.add('has-toggle');

            btn.addEventListener('click', function () {
                open = !open;
                ul.style.maxHeight = open ? ul.scrollHeight + 'px' : collapsed + 'px';
                btn.setAttribute('aria-expanded', String(open));
                var t = btn.querySelector('.resumo-home__toggle-txt');
                if (t) t.textContent = open ? (btn.dataset.less || 'Ver menos') : (btn.dataset.more || 'Ver más');
            });

            var rt;
            window.addEventListener('resize', function () {
                clearTimeout(rt);
                rt = setTimeout(function () {
                    if (open) return;
                    ul.style.maxHeight = '';
                    collapsed = collapsedHeight();
                    ul.style.maxHeight = collapsed + 'px';
                }, 200);
            });
        }
        function init() {
            var wraps = document.querySelectorAll('.resumo-home__chips-wrap');
            for (var i = 0; i < wraps.length; i++) setup(wraps[i]);
        }
        if (document.readyState !== 'loading') init();
        else document.addEventListener('DOMContentLoaded', init);
    })();
    </script>
    <?php
}
