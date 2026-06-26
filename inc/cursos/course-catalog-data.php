<?php

/**
 * Catalogo unico de cursos da Capacitaciones — fonte de verdade (C6.2).
 *
 * Porte do padrao do hashtag (inc/cursos/course-catalog-data.php), adaptado a Cap:
 *   - So 2 cursos reais: Excel (visivel) + IA (oculto, visible=false — nao divulgado no
 *     perpetuo; entra so p/ single-source, get_course('ia') ainda devolve os dados).
 *   - URLs/UTM DIVERGEM do hashtag: a Cap usa `fonte=lespera` + `utm_campaign=capacitacion`
 *     (NAO `src=lesX-site`/`conversion=perpetuo-lesX`) e o DESTINO varia por contexto
 *     (header -> LP lp.hashtagcapacitaciones.com; footer -> ?curso=excel; card home -> popup;
 *     scroller home -> decorativo, sem <a>). Por isso cada curso traz um mapa `urls` por
 *     contexto com o href EXATO (UTM ja embutido) que o wiring visual (C6.3) reproduz
 *     byte-a-byte. build_course_url() devolve esse href quando existe; senao monta no
 *     padrao Cap a partir de `link`.
 *   - Sem Comunidade / 'outros' / 'todos-os-cursos' (a Cap nao tem essas paginas) ->
 *     `comunidade_categorias` vazio e nenhum curso 'outros'.
 *
 * Campos canonicos (= hashtag): name, curso_de, titulo_curto, subtitulo, ranking, categoria,
 *   sufixo, utm_campaign, link (URL canonica SEM querystring, base do schema/llms), icon,
 *   card_image, teacher, card_class, alt, scroller, visible.
 * Extra Cap: schema_url (canonica p/ schema; default = link), urls (mapa contexto->href
 *   exato), cta_popup (bool: card home abre popup em vez de linkar), scroller_decorative
 *   (bool: item do scroller renderiza sem <a>).
 *
 * Regras derivadas (ver Hashtag_Course_Catalog): scroller/cards home = ranking != null;
 *   schema ItemList = todos com ranking. Como so o Excel e visivel, ele e o unico na vitrine.
 */

return (static function () {
    $assets_base_uri = get_template_directory_uri() . '/desenvolvimento_hashtag/assets';
    $icone           = $assets_base_uri . '/imgs/Global/%C3%8Dcone'; // "Ícone" URL-encoded

    $home     = 'https://hashtagcapacitaciones.com';
    $lp_excel = 'https://lp.hashtagcapacitaciones.com/excel/pg-inscripcion';

    return [
        'courses' => [
            'excel' => [
                'name'                => 'Excel',
                'curso_de'            => 'Curso de Excel',
                'titulo_curto'        => 'Excel',
                'subtitulo'           => 'Impresionante',
                'ranking'             => 1,
                'categoria'           => 'negocios',
                'sufixo'              => 'ex',
                'utm_campaign'        => 'capacitacion',
                'link'                => $home . '/', // oferta = home (sem landing /curso-excel propria)
                'schema_url'          => $home . '/',
                // Descricao p/ Course schema (C3.4). ES com tildes (guia "Espanhol Do Site").
                'schema_description'  => 'Curso online de Excel de Hashtag Capacitaciones: aprende desde lo basico hasta lo avanzado (formulas, funciones, graficos, tablas dinamicas y automatizacion) con un enfoque practico aplicado al mercado laboral.',
                'icon'                => $icone . '/icone-excel.svg',
                'card_image'          => '', // sem foto da Olivia nos assets; card home e popup
                'teacher'             => 'Olivia',
                'card_class'          => 'course-card--excel',
                'alt'                 => 'Olivia - Excel',
                'visible'             => true,
                'cta_popup'           => true,  // card home abre popup (href="#"), nao linka
                'scroller_decorative' => true,  // item do scroller sem <a> (decorativo)
                'urls'                => [
                    // hrefs EXATOS de prod (header-capacitaciones.php / footer-hashtag.php) — byte-a-byte.
                    'header-links' => $lp_excel . '?fonte=lespera&utm_source=site&utm_medium=header&utm_content=header-matriculese&utm_campaign=capacitacion',
                    'footer-links' => $home . '/?curso=excel&utm_source=site&utm_medium=footer&utm_content=footer-cursos&utm_campaign=capacitacion',
                ],
                'scroller'            => [
                    'src'    => $icone . '/icone-excel.svg',
                    'width'  => 40,
                    'height' => 40,
                    'classe' => 'url-curso-lancamento--excel',
                ],
            ],

            'ia' => [
                'name'         => 'Inteligencia Artificial',
                'curso_de'     => 'Curso de Inteligencia Artificial',
                'titulo_curto' => 'Inteligencia Artificial',
                'subtitulo'    => 'Impresionante',
                'ranking'      => 2,
                'categoria'    => 'negocios',
                'sufixo'       => 'ia',
                'utm_campaign' => 'capacitacion',
                // OCULTO (visible=false): some da vitrine (scroller/card/footer/header/ItemList);
                // get_course('ia') ainda devolve. landing = templates/pg-vendas-ia.php (redir BR).
                'link'         => 'https://www.hashtagtreinamentos.com/curso-ia',
                'schema_url'   => 'https://www.hashtagtreinamentos.com/curso-ia',
                'icon'         => $icone . '/icone-ia.webp',
                'card_image'   => '',
                'teacher'      => '',
                'card_class'   => 'course-card--ia',
                'alt'          => 'Inteligencia Artificial',
                'visible'      => false,
                'urls'         => [],
                'scroller'     => [
                    'src'    => $icone . '/icone-ia.webp',
                    'width'  => 40,
                    'height' => 40,
                    'classe' => 'url-curso-lancamento--ia',
                ],
            ],
        ],

        // A Cap nao tem pagina Comunidade -> sem agrupamento por categoria.
        'comunidade_categorias' => [],
    ];
})();
