<?php
/**
 * Provider de schema da LANDING DE CURSO (Capacitaciones) — C3.4.
 * Emite UM no Course no grafo unico, ligado por @id, para o curso VISIVEL cuja
 * URL canonica casa com a pagina atual.
 *
 * Porte adaptado do hashtag (inc/seo/schema/schema-course.php). Diferencas da Cap:
 *   - A Cap NAO tem inc/seo/curso-seo.php nem curso-landing-config.php -> os dados vem
 *     SO do catalogo (inc/cursos/, C6.2): nome, descricao (campo schema_description),
 *     instrutor, carga horaria, URL canonica (schema_url/link).
 *   - SO cursos visiveis recebem Course. get_all_courses() ja exclui visible=false ->
 *     o IA (oculto, e com landing no dominio BR) NUNCA recebe Course aqui.
 *   - A oferta do Excel e a HOME (catalogo: link/schema_url = home) -> o Course do Excel
 *     sai na front-page. O matcher compara so o PATH (funciona igual em DDEV e prod) e,
 *     ao contrario do hashtag, ACEITA a raiz '/' (la nenhum curso e a home; aqui o Excel e).
 *   - SEM offers e SEM aggregateRating/review por padrao: a Cap nao tem preco estavel
 *     confirmado nem base de avaliacao (NPS) -> nao fabricar dado. Ambos sao injetaveis
 *     por filtro quando houver dado real (hashtag_schema_course_offers / _aggregate_rating).
 *
 * provider/publisher/author e image referenciam as entidades canonicas por @id
 * (#Organization / #logo de schema-entities.php), nao repetem inline.
 *
 * @package Hashtag\Schema
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('hashtag_schema_course_path')) {
    /** Path normalizado de uma URL ('/' para a raiz). Compara so o path -> host-agnostico. */
    function hashtag_schema_course_path(string $url): string
    {
        $path = (string) parse_url($url, PHP_URL_PATH);

        return '/' . trim($path, '/');
    }
}

if (!function_exists('hashtag_schema_course_current_slug')) {
    /**
     * Slug do curso VISIVEL cuja URL canonica (schema_url/link) casa com a pagina atual
     * (so o path). '' se nenhum casar. get_all_courses() ja exclui visible=false.
     */
    function hashtag_schema_course_current_slug(): string
    {
        if (is_admin() || !class_exists('Hashtag_Course_Catalog')) {
            return '';
        }
        // Paginas de curso na Cap = a home (oferta do Excel) ou paginas singulares.
        if (!is_front_page() && !is_singular()) {
            return '';
        }

        $current_path = hashtag_schema_course_path(hashtag_schema_current_url());

        foreach (Hashtag_Course_Catalog::get_all_courses() as $slug => $course) {
            $schema_url = Hashtag_Course_Catalog::get_course_schema_url($course);
            if ($schema_url === '') {
                continue;
            }
            if (hashtag_schema_course_path($schema_url) === $current_path) {
                return (string) $slug;
            }
        }

        return '';
    }
}

if (!function_exists('hashtag_schema_course_description')) {
    /** Descricao do Course: campo schema_description do catalogo; fallback generico ES. */
    function hashtag_schema_course_description(string $slug, array $course): string
    {
        $desc = trim((string) ($course['schema_description'] ?? ''));
        if ($desc !== '') {
            return $desc;
        }

        $name = trim((string) ($course['curso_de'] ?? $course['name'] ?? $slug));

        return sprintf(
            'Curso online de %s de Hashtag Capacitaciones, con un enfoque practico aplicado al mercado laboral.',
            $name
        );
    }
}

if (!function_exists('hashtag_schema_course_instance')) {
    /** CourseInstance (modo online + carga horaria + instrutor) a partir do catalogo. */
    function hashtag_schema_course_instance(string $slug, array $course): array
    {
        $instance = [
            '@type'      => 'CourseInstance',
            'courseMode' => 'online',
        ];

        if (class_exists('Hashtag_Course_Catalog')) {
            $hours = (int) Hashtag_Course_Catalog::get_home_course_workload_hours($slug);
            if ($hours > 0) {
                $instance['courseWorkload'] = sprintf('PT%dH', $hours);
            }
        }

        $teacher = trim((string) ($course['teacher'] ?? ''));
        if ($teacher !== '') {
            $instance['instructor'] = ['@type' => 'Person', 'name' => $teacher];
        }

        return $instance;
    }
}

if (!function_exists('hashtag_schema_course_nodes')) {
    /**
     * No da landing de curso: [Course] ou []. Gate: curso visivel cuja URL casa com a pagina.
     *
     * @return array<int,array<string,mixed>>
     */
    function hashtag_schema_course_nodes(): array
    {
        $slug = hashtag_schema_course_current_slug();
        if ($slug === '') {
            return [];
        }

        $course = Hashtag_Course_Catalog::get_course($slug);
        if (!is_array($course)) {
            return [];
        }

        $url  = hashtag_schema_current_url();
        $name = trim((string) ($course['curso_de'] ?? ''))
            ?: (trim((string) ($course['name'] ?? '')) ?: wp_strip_all_tags(get_the_title()));

        $node = [
            '@type'             => 'Course',
            '@id'               => $url . '#course',
            'name'              => $name,
            'description'       => hashtag_schema_course_description($slug, $course),
            'url'               => $url,
            'inLanguage'        => function_exists('hashtag_schema_org_in_language') ? hashtag_schema_org_in_language() : 'es',
            'isPartOf'          => ['@id' => $url . '#webpage'],
            'provider'          => hashtag_schema_org_ref(),
            'publisher'         => hashtag_schema_org_ref(),
            'author'            => hashtag_schema_org_ref(),
            'hasCourseInstance' => hashtag_schema_course_instance($slug, $course),
        ];

        // Imagem: a Cap nao tem foto de curso (card_image vazio) -> cai no logo da Org (#logo).
        if (function_exists('hashtag_schema_logo_id')) {
            $node['image'] = ['@id' => hashtag_schema_logo_id()];
        }

        // Datas da pagina (parity com o hashtag; validas p/ CreativeWork).
        if (is_singular()) {
            $published = get_the_date('c');
            $modified  = get_the_modified_date('c');
            if ($published) {
                $node['datePublished'] = $published;
            }
            if ($modified) {
                $node['dateModified'] = $modified;
            }
        }

        // Offer: sem preco estavel confirmado na Cap -> omitido (nao fabricar). Injetar via
        // filtro quando houver preco+moeda reais (retornar array AggregateOffer/Offer).
        $offers = apply_filters('hashtag_schema_course_offers', null, $slug, $course, $url);
        if (is_array($offers) && $offers) {
            $node['offers'] = $offers;
        }

        // aggregateRating/review: a Cap nao tem base de NPS -> omitido (nao fabricar / evitar
        // self-serving review). Injetar via filtro quando houver dado real.
        $rating = apply_filters('hashtag_schema_course_aggregate_rating', null, $slug, $course);
        if (is_array($rating) && $rating) {
            $node['aggregateRating'] = $rating;
        }
        $review = apply_filters('hashtag_schema_course_review', null, $slug, $course);
        if (is_array($review) && $review) {
            $node['review'] = $review;
        }

        // Remove so chaves null (nunca falsy: description/inLanguage etc. sao sempre validos).
        $node = array_filter($node, static function ($v) {
            return $v !== null;
        });

        return [$node];
    }
}

if (function_exists('hashtag_schema_register')) {
    hashtag_schema_register('hashtag_schema_course_nodes', 20);
}
