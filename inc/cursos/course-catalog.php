<?php

/**
 * Engine do catalogo de cursos da Capacitaciones (C6.2).
 *
 * Porte quase-identico do hashtag (inc/cursos/course-catalog.php). Unica divergencia:
 * build_course_url() segue a convencao de URL da Cap (ver course-catalog-data.php) —
 * href EXATO por contexto via mapa `urls`, com fallback `fonte=lespera`+`utm_campaign`
 * (NAO o `src=lesX-site`/`conversion=perpetuo-lesX` do hashtag).
 *
 * NOTA C6.3 (visual, Regra 0): os renderers (render_course_card/_track/_grouped/_scroller)
 * sao portados verbatim do hashtag (markup + strings PT-BR + foto mockup) e ficam DORMENTES
 * — nenhum template da Cap os chama ainda. Quando o wiring visual entrar (C6.3), eles serao
 * adaptados a Cap (card home = popup, scroller = decorativo, copy ES) e validados byte-a-byte.
 * Hoje a Cap consome so a camada de DADOS (get_course/get_all_courses/build_course_url/
 * get_course_schema_url), usada por schema-course (C3.4)/llms/answer-first.
 */

if (!class_exists('Hashtag_Course_Catalog')) {
    class Hashtag_Course_Catalog
    {
        // ===========================================================================
        // Catálogo (load + normalize)
        // ===========================================================================

        public static function get_catalog()
        {
            static $catalog = null;

            if ($catalog !== null) {
                return $catalog;
            }

            $catalog = self::normalize_catalog_strings(
                require __DIR__ . '/course-catalog-data.php'
            );

            return $catalog;
        }

        private static function normalize_catalog_strings($value)
        {
            if (is_array($value)) {
                foreach ($value as $key => $item) {
                    $value[$key] = self::normalize_catalog_strings($item);
                }

                return $value;
            }

            if (!is_string($value)) {
                return $value;
            }

            if (
                strpos($value, 'Ã') === false &&
                strpos($value, 'Â') === false &&
                strpos($value, 'â') === false
            ) {
                return $value;
            }

            return utf8_decode($value);
        }

        // ===========================================================================
        // API pública nova
        // ===========================================================================

        public static function get_course($slug)
        {
            $catalog = self::get_catalog();
            $course  = $catalog['courses'][$slug] ?? null;

            if ($course === null) {
                return null;
            }

            return array_merge(['slug' => $slug], $course);
        }

        public static function get_all_courses()
        {
            $catalog = self::get_catalog();
            $out     = [];

            foreach ($catalog['courses'] ?? [] as $slug => $course) {
                if (($course['visible'] ?? true) === false) {
                    continue;
                }

                $out[$slug] = array_merge(['slug' => $slug], $course);
            }

            return $out;
        }

        /**
         * Cursos com ranking != null, ordenados ASC. 'outros' é incluído sempre ao final
         * quando $include_outros = true (regra: home/header).
         */
        public static function get_ranked_courses($include_outros = true)
        {
            $courses = self::get_all_courses();
            $ranked  = [];
            $outros  = null;

            foreach ($courses as $slug => $course) {
                if ($slug === 'outros') {
                    $outros = $course;
                    continue;
                }

                if (isset($course['ranking']) && $course['ranking'] !== null) {
                    $ranked[] = $course;
                }
            }

            usort($ranked, static function ($a, $b) {
                return ((int) $a['ranking']) - ((int) $b['ranking']);
            });

            if ($include_outros && $outros !== null) {
                $ranked[] = $outros;
            }

            return $ranked;
        }

        public static function get_ranked_courses_top($n, $include_outros = true)
        {
            $ranked = self::get_ranked_courses(false);
            $top    = array_slice($ranked, 0, (int) $n);

            if ($include_outros) {
                $outros = self::get_course('outros');
                if ($outros !== null) {
                    $top[] = $outros;
                }
            }

            return $top;
        }

        public static function get_courses_by_category($categoria)
        {
            $courses = self::get_all_courses();
            $with    = [];
            $without = [];

            foreach ($courses as $course) {
                if (($course['categoria'] ?? null) !== $categoria) {
                    continue;
                }

                if (isset($course['ranking']) && $course['ranking'] !== null) {
                    $with[] = $course;
                } else {
                    $without[] = $course;
                }
            }

            usort($with, static function ($a, $b) {
                return ((int) $a['ranking']) - ((int) $b['ranking']);
            });

            return array_merge($with, $without);
        }

        /**
         * Estrutura para a página Comunidade:
         *   [ cat_key => ['heading_html' => '...', 'heading_text' => '...', 'entries' => [...] ] ]
         *
         * Ordem dos grupos = ordem em $catalog['comunidade_categorias'].
         */
        public static function get_grouped_courses_for_comunidade()
        {
            $catalog    = self::get_catalog();
            $categorias = $catalog['comunidade_categorias'] ?? [];
            $out        = [];

            foreach ($categorias as $cat_key => $cat_meta) {
                $entries = self::get_courses_by_category($cat_key);

                if (empty($entries)) {
                    continue;
                }

                $out[$cat_key] = [
                    'heading_html' => $cat_meta['heading_html'] ?? $cat_meta['heading_text'] ?? $cat_key,
                    'heading_text' => $cat_meta['heading_text'] ?? $cat_key,
                    'entries'      => $entries,
                ];
            }

            return $out;
        }

        /**
         * Cursos para o ItemList de schema. Todos com ranking, exceto 'outros'.
         */
        public static function get_schema_courses()
        {
            return self::get_ranked_courses(false);
        }

        /**
         * Constrói a URL final de um curso para um contexto específico (convenção Cap).
         *
         * 1) Se o curso declara um href EXATO em `urls[$context]` (ex.: header-links -> LP,
         *    footer-links -> ?curso=excel), devolve esse href (com $extra aplicado se houver).
         * 2) Senão, monta a partir de `link` no padrão Cap:
         *      {link}?fonte=lespera&utm_source=site&utm_medium=...&utm_content=...&utm_campaign=...
         *    (DIVERGE do hashtag: sem src=lesX-site, sem conversion=perpetuo-lesX).
         */
        public static function build_course_url($slug, $context, array $extra = [])
        {
            $course = self::get_course($slug);

            if ($course === null) {
                return '#';
            }

            // (1) href exato por contexto — reproduz a URL de prod byte-a-byte.
            $urls = $course['urls'] ?? [];
            if (is_array($urls) && !empty($urls[$context])) {
                return empty($extra)
                    ? $urls[$context]
                    : add_query_arg($extra, $urls[$context]);
            }

            $link = (string) ($course['link'] ?? '');

            if ($link === '') {
                return '#';
            }

            // (2) fallback no padrão Cap.
            $args = [
                'fonte'      => 'lespera',
                'utm_source' => 'site',
            ];

            $campaign = (string) ($course['utm_campaign'] ?? '');
            if ($campaign !== '') {
                $args['utm_campaign'] = $campaign;
            }

            $context_map = self::get_context_utm($context);
            if (!empty($context_map['utm_medium'])) {
                $args['utm_medium'] = $context_map['utm_medium'];
            }
            if (!empty($context_map['utm_content'])) {
                $args['utm_content'] = $context_map['utm_content'];
            }

            $args = array_merge($args, $extra);

            return add_query_arg($args, $link);
        }

        private static function get_context_utm($context)
        {
            $map = [
                'home-scroller'                => ['utm_medium' => 'home', 'utm_content' => 'home-scroller'],
                'home-cursos-cards'            => ['utm_medium' => 'home', 'utm_content' => 'home-cards'],
                'home-aeo-areas'               => ['utm_medium' => 'home', 'utm_content' => 'home-areas'],
                'comunidade-cards'             => ['utm_medium' => 'comunidade', 'utm_content' => 'comunidade-cards'],
                'header-links'                 => ['utm_medium' => 'header', 'utm_content' => 'header-links'],
                'footer-links'                 => ['utm_medium' => 'footer', 'utm_content' => 'footer-links'],
                'todos-cursos'                 => ['utm_medium' => 'todos-cursos', 'utm_content' => 'todos-cursos-cards'],
                'todos-cursos-scroller'        => ['utm_medium' => 'todos-cursos', 'utm_content' => 'scroller-todos-cursos'],
                'cursos-hashtag-treinamentos'  => ['utm_medium' => 'cursos-hashtag-treinamentos', 'utm_content' => 'cursos-hashtag-treinamentos'],
                'cursos-hashtag-programacao'   => ['utm_medium' => 'cursos-hashtag-programacao', 'utm_content' => 'cursos-hashtag-programacao'],
                'cursos-hashtag-nocode'        => ['utm_medium' => 'cursos-hashtag-nocode', 'utm_content' => 'cursos-hashtag-nocode'],
            ];

            return $map[$context] ?? ['utm_medium' => $context, 'utm_content' => $context];
        }

        /**
         * Retorna URL canônica do curso para uso em schema.org (sem querystring).
         */
        public static function get_course_schema_url($course)
        {
            if (!is_array($course)) {
                return '';
            }

            $raw = '';
            if (!empty($course['schema_url'])) {
                $raw = $course['schema_url'];
            } elseif (!empty($course['link'])) {
                $raw = $course['link'];
            }

            if ($raw === '') {
                return '';
            }

            $url = trim($raw);
            $fragment = '';
            $fragment_pos = strpos($url, '#');

            if ($fragment_pos !== false) {
                $fragment = substr($url, $fragment_pos);
                $url = substr($url, 0, $fragment_pos);
            }

            $query_pos = strpos($url, '?');
            if ($query_pos !== false) {
                $url = substr($url, 0, $query_pos);
            }

            return trim($url . $fragment);
        }

        // ===========================================================================
        // Renderers (DORMENTES na Cap — ver NOTA C6.3 no topo do arquivo)
        // ===========================================================================

        /**
         * Renderiza UM card (markup `course-card` unificado). Decide entre <a> ou <article>
         * conforme contexto (cursos sem link no contexto comunidade ainda viram <a> com #secao-oferta).
         */
        public static function render_course_card($slug, $context = 'home-cursos-cards')
        {
            $course = self::get_course($slug);
            if ($course === null) {
                return '';
            }

            $card_id    = 'curso-' . sanitize_title($slug);
            $card_class = (string) ($course['card_class'] ?? '');
            $titulo     = (string) ($course['titulo_curto'] ?? $course['name'] ?? '');
            $teacher    = (string) ($course['teacher'] ?? '');
            $alt        = (string) ($course['alt'] ?? ($teacher . ' - ' . $titulo));
            $card_image = (string) ($course['card_image'] ?? '');
            $icon       = (string) ($course['icon'] ?? '');

            $icon_dims  = self::get_image_dimensions($icon);
            $image_html = self::render_mockup_course_image($card_image, $alt);
            $stage_html = self::render_mockup_stage_markup();

            $is_static = false;

            $photo_html = sprintf(
                '<div class="course-card__photo">%1$s%2$s<span class="course-card__badge"><span class="course-card__badge-icon"><img loading="lazy" decoding="async" fetchpriority="low" src="%3$s" alt="" width="%4$d" height="%5$d" /></span><span class="course-card__badge-label">%6$s</span></span></div>',
                $stage_html,
                $image_html,
                esc_url($icon),
                (int) $icon_dims['width'],
                (int) $icon_dims['height'],
                esc_html($titulo)
            );

            if ($is_static) {
                $info_html = sprintf(
                    '<div class="course-card__info"><span class="course-card__nome">%s</span></div>',
                    esc_html($teacher)
                );

                return sprintf(
                    '<article id="%1$s" class="course-card course-card--static %2$s">%3$s%4$s</article>',
                    esc_attr($card_id),
                    esc_attr($card_class),
                    $photo_html,
                    $info_html
                );
            }

            // Comunidade: card sem link, sem nome do professor e sem botão "Saber mais" (mantém hover).
            if ($context === 'comunidade-cards') {
                return sprintf(
                    '<article id="%1$s" class="course-card course-card--sem-info %2$s">%3$s</article>',
                    esc_attr($card_id),
                    esc_attr($card_class),
                    $photo_html
                );
            }

            $url                = self::build_course_url($slug, $context);
            $is_internal_anchor = (strpos($url, '#') === 0);
            $target_attr        = $is_internal_anchor ? '' : ' target="_blank" rel="noopener"';
            $aria_label         = trim($titulo . ($teacher !== '' ? ' - ' . $teacher : ''));

            $info_html = sprintf(
                '<div class="course-card__info"><span class="course-card__nome">%s</span><span class="course-card__btn" aria-hidden="true">Saber mais<svg viewBox="0 0 14 14" fill="none" aria-hidden="true" focusable="false"><path d="M6.88.41 5.7 1.6l4.68 4.68H.17v1.68H10.38L5.7 12.65l1.18 1.18 6.71-6.71L6.88.41Z" fill="currentColor"/></svg></span></div>',
                esc_html($teacher)
            );

            return sprintf(
                '<a href="%1$s" class="course-card-link"%2$s aria-label="%3$s"><article id="%4$s" class="course-card %5$s">%6$s%7$s</article></a>',
                esc_url($url),
                $target_attr,
                esc_attr($aria_label),
                esc_attr($card_id),
                esc_attr($card_class),
                $photo_html,
                $info_html
            );
        }

        /**
         * Renderiza N cards numa única `cards-track`. $courses é array de cursos
         * (não slugs).
         */
        public static function render_course_cards_track(array $courses, $context = 'home-cursos-cards')
        {
            $html = '';
            foreach ($courses as $course) {
                $slug = $course['slug'] ?? '';
                if ($slug === '') {
                    continue;
                }
                $html .= self::render_course_card($slug, $context);
            }
            return $html;
        }

        /**
         * Renderiza os grupos da Comunidade. Cada grupo tem header + carrossel próprio
         * (cards-viewport / cards-track) com nav independente. JS deve detectar via
         * [data-cards-track] e instanciar carrossel por grupo.
         */
        public static function render_grouped_course_cards($context = 'comunidade-cards')
        {
            $groups = self::get_grouped_courses_for_comunidade();
            $html   = '';
            $idx    = 0;

            foreach ($groups as $cat_key => $group) {
                $idx++;
                $track_id = 'cards-track-' . sanitize_title($cat_key);
                $cards    = self::render_course_cards_track($group['entries'], $context);

                $html .= sprintf(
                    '<div class="carrossel-wrapper secao-cursos secao-cursos--grupo" data-grupo="%1$s" data-cards-no-auto="true">' .
                        '<div class="secao-cursos__group-heading">' .
                            '<h3 class="text-balance">%2$s</h3>' .
                        '</div>' .
                        '<div class="secao-cursos__group-carousel">' .
                            '<div class="cards-viewport">' .
                                '<div class="cards-track" id="%4$s" data-cards-track="true" data-cards-ready="true">%5$s</div>' .
                            '</div>' .
                            '<nav class="carrossel-nav" aria-label="Navegar entre cursos de %3$s" data-cards-target="%4$s">' .
                                '<button class="carrossel-nav__btn" type="button" aria-label="Anterior" data-direction="prev">' .
                                    '<svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M13.83 6.28H3.62L8.31 1.6 7.12.41.41 7.12l6.71 6.71 1.18-1.18-4.68-4.68H13.83V6.28Z" fill="currentColor" /></svg>' .
                                '</button>' .
                                '<button class="carrossel-nav__btn" type="button" aria-label="Próximo" data-direction="next">' .
                                    '<svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M6.88.41 5.7 1.6l4.68 4.68H.17v1.68H10.38L5.7 12.65l1.18 1.18 6.71-6.71L6.88.41Z" fill="currentColor" /></svg>' .
                                '</button>' .
                            '</nav>' .
                        '</div>' .
                    '</div>',
                    esc_attr($cat_key),
                    $group['heading_html'],
                    esc_attr($group['heading_text']),
                    esc_attr($track_id),
                    $cards
                );
            }

            return $html;
        }

        /**
         * Renderiza o scroller infinito (linha de ícones).
         *
         * @param array  $courses Cursos a incluir.
         * @param string $context Contexto de tracking (home-scroller, todos-cursos-scroller, etc.).
         */
        public static function render_scroller_for_courses(array $courses, $context = 'home-scroller')
        {
            $html = '';

            foreach ($courses as $course) {
                $slug = $course['slug'] ?? '';
                $scroller = $course['scroller'] ?? null;

                if ($slug === '' || !is_array($scroller) || empty($scroller['src'])) {
                    continue;
                }

                $href = self::build_course_url($slug, $context);
                $name = (string) ($course['name'] ?? '');
                $classe = (string) ($scroller['classe'] ?? '');

                $width_attr  = isset($scroller['width']) && isset($scroller['height'])
                    ? sprintf(' width="%d" height="%d"', (int) $scroller['width'], (int) $scroller['height'])
                    : '';

                $html .= sprintf(
                    '<a class="curso__item %1$s" href="%2$s"><img loading="lazy" decoding="async" fetchpriority="low" src="%3$s" alt="%4$s"%5$s /><p>%6$s</p></a>',
                    esc_attr($classe),
                    esc_url($href),
                    esc_url($scroller['src']),
                    esc_attr('Icone ' . $name),
                    $width_attr,
                    esc_html($name)
                );
            }

            return $html;
        }

        // ===========================================================================
        // Helpers de imagem (mockup card)
        // ===========================================================================

        private static function get_theme_asset_path_from_uri($uri)
        {
            $theme_uri = trailingslashit(get_template_directory_uri());

            if (strpos($uri, $theme_uri) !== 0) {
                return '';
            }

            $relative_path = rawurldecode(substr($uri, strlen($theme_uri)));

            return get_template_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relative_path);
        }

        private static function get_image_variant_uri($uri, $suffix, $extension = '')
        {
            $replacement = $suffix . ($extension !== '' ? '.' . ltrim($extension, '.') : '$1');

            return preg_replace('/(\.[a-z0-9]+)(?:\?.*)?$/i', $replacement, $uri);
        }

        private static function get_image_dimensions($uri, $fallback_width = 40, $fallback_height = 40)
        {
            $path = self::get_theme_asset_path_from_uri($uri);

            if ($path !== '' && file_exists($path)) {
                $size = @getimagesize($path);

                if (!empty($size[0]) && !empty($size[1])) {
                    return [
                        'width'  => (int) $size[0],
                        'height' => (int) $size[1],
                    ];
                }
            }

            return [
                'width'  => (int) $fallback_width,
                'height' => (int) $fallback_height,
            ];
        }

        private static function render_mockup_stage_markup()
        {
            return '<div class="course-card__placeholder" aria-hidden="true"><span class="stage__beam"></span><span class="stage__ring"></span><span class="stage__halo"></span><span class="stage__floor"></span><span class="stage__haze"></span></div>';
        }

        private static function render_mockup_course_image($uri, $alt)
        {
            if ($uri === '') {
                return '';
            }

            $sizes = '(max-width: 768px) 260px, 260px';
            $webp_260 = self::get_image_variant_uri($uri, '-mockup-260', 'webp');
            $avif_260 = self::get_image_variant_uri($uri, '-mockup-260', 'avif');
            $avif_520 = self::get_image_variant_uri($uri, '-mockup-520', 'avif');
            $webp_260_path = self::get_theme_asset_path_from_uri($webp_260);
            $avif_260_path = self::get_theme_asset_path_from_uri($avif_260);
            $avif_520_path = self::get_theme_asset_path_from_uri($avif_520);
            $webp_srcset = esc_url($uri) . ' 520w';
            $avif_srcset = '';

            if ($webp_260_path !== '' && file_exists($webp_260_path)) {
                $webp_srcset = esc_url($webp_260) . ' 260w, ' . $webp_srcset;
            }

            if ($avif_260_path !== '' && file_exists($avif_260_path)) {
                $avif_srcset = esc_url($avif_260) . ' 260w';
            }

            if ($avif_520_path !== '' && file_exists($avif_520_path)) {
                $avif_srcset .= ($avif_srcset !== '' ? ', ' : '') . esc_url($avif_520) . ' 520w';
            }

            $image_tag = sprintf(
                '<img loading="lazy" decoding="async" fetchpriority="low" src="%1$s" srcset="%2$s" sizes="%3$s" alt="%4$s" width="520" height="650" />',
                esc_url($uri),
                esc_attr($webp_srcset),
                esc_attr($sizes),
                esc_attr($alt)
            );

            if ($avif_srcset === '') {
                return $image_tag;
            }

            return sprintf(
                '<picture><source type="image/avif" srcset="%1$s" sizes="%2$s" />%3$s</picture>',
                esc_attr($avif_srcset),
                esc_attr($sizes),
                $image_tag
            );
        }

        // ===========================================================================
        // LEGACY API (mantida para retrocompat de templates ainda não migrados).
        //
        // Mapeia os antigos `order_key` para a nova API derivada de ranking.
        // ===========================================================================

        public static function get_entries_by_order($order_key, $type)
        {
            $entries = self::resolve_legacy_order($order_key);

            if ($type === 'card') {
                $out = [];
                foreach ($entries as $course) {
                    $out[] = self::legacy_card_payload($course);
                }
                return $out;
            }

            if ($type === 'scroller') {
                $out = [];
                foreach ($entries as $course) {
                    if (!is_array($course['scroller'] ?? null)) {
                        continue;
                    }
                    $out[] = self::legacy_scroller_payload($course);
                }
                return $out;
            }

            $out = [];
            foreach ($entries as $course) {
                $out[] = array_merge(['slug' => $course['slug']], $course);
            }
            return $out;
        }

        private static function resolve_legacy_order($order_key)
        {
            switch ($order_key) {
                case 'home':
                case 'home_cards':
                    return self::get_ranked_courses_top(11, true);

                case 'header':
                    return self::get_ranked_courses_top(11, true);

                case 'comunidade':
                    // Legacy: subset por categoria — devolve flatten do grouped.
                    $flat = [];
                    foreach (self::get_grouped_courses_for_comunidade() as $group) {
                        foreach ($group['entries'] as $entry) {
                            $flat[] = $entry;
                        }
                    }
                    return $flat;

                case 'todos':
                    // Lista flat de todos com ranking, sem outros (legacy comportamento).
                    return self::get_ranked_courses(false);

                case 'programacao':
                    return self::get_courses_by_category('programacao');

                case 'nocode':
                    return self::get_courses_by_category('agentes-ia-nocode');

                case 'hashtag':
                    // Subset legacy — cursos da "Hashtag Treinamentos" (negocios + alguns extras).
                    return self::get_courses_by_category('negocios');
            }

            return [];
        }

        private static function legacy_card_payload(array $course)
        {
            return [
                'slug'         => $course['slug'],
                'nome'         => $course['name'] ?? '',
                'classe'       => $course['card_class'] ?? '',
                'img_card'     => $course['card_image'] ?? '',
                'img_prof'     => $course['card_image'] ?? '',
                'icon'         => $course['icon'] ?? '',
                'titulo'       => $course['titulo_curto'] ?? ($course['name'] ?? ''),
                'subtitulo'    => $course['subtitulo'] ?? '',
                'link'         => $course['link'] ?? '',
                'conversion'   => ($course['sufixo'] ?? '') !== '' ? 'perpetuo-les' . $course['sufixo'] : '',
                'button_class' => '',
                'schema_url'   => $course['schema_url'] ?? '',
            ];
        }

        private static function legacy_scroller_payload(array $course)
        {
            $scroller = $course['scroller'] ?? [];
            return [
                'slug'   => $course['slug'],
                'nome'   => $course['name'] ?? '',
                'src'    => $scroller['src'] ?? '',
                'href'   => $course['link'] ?? '',
                'classe' => $scroller['classe'] ?? '',
                'width'  => $scroller['width'] ?? 40,
                'height' => $scroller['height'] ?? 40,
            ];
        }

        public static function render_scroller_items($order_key, $utm_medium = '', $utm_content = '')
        {
            $entries = self::resolve_legacy_order($order_key);
            $context = self::infer_scroller_context_from_legacy($order_key, $utm_medium, $utm_content);

            return self::render_scroller_for_courses($entries, $context);
        }

        private static function infer_scroller_context_from_legacy($order_key, $utm_medium, $utm_content)
        {
            // Map known UTM combinations to canonical contexts.
            if ($order_key === 'home' || $utm_medium === 'home') {
                return 'home-scroller';
            }
            if ($utm_medium === 'todos-cursos' || $order_key === 'todos') {
                return 'todos-cursos-scroller';
            }
            if ($utm_medium === 'todos-cursos-prog' || $order_key === 'programacao') {
                return 'cursos-hashtag-programacao';
            }
            if ($order_key === 'hashtag') {
                return 'cursos-hashtag-treinamentos';
            }
            if ($order_key === 'nocode') {
                return 'cursos-hashtag-nocode';
            }

            // Fallback: usa o utm_medium recebido.
            return $utm_medium !== '' ? $utm_medium : 'home-scroller';
        }

        public static function get_home_scroller_items()
        {
            return self::get_entries_by_order('home', 'scroller');
        }

        public static function render_home_scroller_items($utm_medium = '', $utm_content = '')
        {
            return self::render_scroller_items('home', $utm_medium, $utm_content);
        }

        public static function render_home_scroller_items_responsive($utm_medium = '', $utm_content = '')
        {
            return self::render_home_scroller_items($utm_medium, $utm_content);
        }

        public static function get_home_course_cards()
        {
            return self::get_entries_by_order('home_cards', 'card');
        }

        public static function render_home_course_cards()
        {
            $courses = self::get_ranked_courses_top(11, true);
            return self::render_course_cards_track($courses, 'home-cursos-cards');
        }

        public static function get_home_course_schema_courses()
        {
            $courses = self::get_schema_courses();
            $out = [];
            $seen_urls = [];

            foreach ($courses as $course) {
                $url = self::get_course_schema_url($course);
                if ($url !== '' && isset($seen_urls[$url])) {
                    continue;
                }
                if ($url !== '') {
                    $seen_urls[$url] = true;
                }

                $out[] = array_merge(
                    [
                        'slug'        => $course['slug'],
                        'titulo'      => $course['titulo_curto'] ?? ($course['name'] ?? ''),
                        'subtitulo'   => $course['subtitulo'] ?? '',
                        'classe'      => $course['card_class'] ?? '',
                        'img_card'    => $course['card_image'] ?? '',
                        'img_prof'    => $course['card_image'] ?? '',
                        'icon'        => $course['icon'] ?? '',
                        'link'        => $course['link'] ?? '',
                        'conversion'  => ($course['sufixo'] ?? '') !== '' ? 'perpetuo-les' . $course['sufixo'] : '',
                        'schema_url'  => $course['schema_url'] ?? '',
                        'nome'        => $course['name'] ?? '',
                    ],
                    $course
                );
            }

            return $out;
        }

        public static function get_home_course_schema_cards()
        {
            return self::get_home_course_schema_courses();
        }

        public static function get_home_card_teacher($slug)
        {
            $course = self::get_course($slug);
            return $course['teacher'] ?? '';
        }

        public static function get_home_course_workload_hours($slug)
        {
            $hours = [
                'excel' => 110,
                'ia'    => 57,
            ];

            return $hours[$slug] ?? 0;
        }
    }
}
