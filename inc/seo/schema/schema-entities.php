<?php
/**
 * Entidades canonicas do grafo (Capacitaciones): Organization (EducationalOrganization),
 * WebSite (SearchAction), WebPage, BreadcrumbList. FONTE UNICA da Organization.
 * Porte adaptado do hashtag — a Cap e mais simples: SEM endereco/telefone (NAP), so
 * name/url/logo/sameAs (Instagram + YouTube reais) + knowsAbout curado.
 *
 * Estes nos saem em TODA pagina HTML: WebPage -> isPartOf -> WebSite -> publisher ->
 * Organization, ligados por @id. Conteudo (Article/Course) referencia #Organization/#webpage.
 *
 * @package Hashtag\Schema
 */

if (!defined('ABSPATH')) {
    exit;
}

/* === IDs canonicos ===================================================== */

if (!function_exists('hashtag_schema_site_base')) {
    function hashtag_schema_site_base(): string
    {
        return untrailingslashit(home_url('/'));
    }
}
if (!function_exists('hashtag_schema_org_id')) {
    function hashtag_schema_org_id(): string
    {
        return hashtag_schema_site_base() . '#Organization';
    }
}
if (!function_exists('hashtag_home_org_id')) {
    function hashtag_home_org_id(): string
    {
        return hashtag_schema_org_id();
    }
}
if (!function_exists('hashtag_schema_website_id')) {
    function hashtag_schema_website_id(): string
    {
        return hashtag_schema_site_base() . '#website';
    }
}
if (!function_exists('hashtag_schema_logo_id')) {
    function hashtag_schema_logo_id(): string
    {
        return hashtag_schema_site_base() . '#logo';
    }
}
if (!function_exists('hashtag_schema_org_ref')) {
    function hashtag_schema_org_ref(): array
    {
        return ['@id' => hashtag_schema_org_id()];
    }
}
if (!function_exists('hashtag_schema_website_ref')) {
    function hashtag_schema_website_ref(): array
    {
        return ['@id' => hashtag_schema_website_id()];
    }
}
if (!function_exists('hashtag_schema_webpage_id')) {
    function hashtag_schema_webpage_id(): string
    {
        return hashtag_schema_current_url() . '#webpage';
    }
}

/* === URL canonica da pagina atual (sem barra, sem query) =============== */

if (!function_exists('hashtag_schema_current_url')) {
    function hashtag_schema_current_url(): string
    {
        if (is_front_page()) {
            return hashtag_schema_site_base() . '/';
        }
        if (is_singular()) {
            $permalink = get_permalink();
            if (is_string($permalink) && $permalink !== '') {
                return untrailingslashit(strtok($permalink, '?'));
            }
        }
        if (is_author()) {
            $author = get_queried_object();
            if ($author instanceof WP_User) {
                return untrailingslashit(get_author_posts_url($author->ID));
            }
        }
        if (is_home()) {
            $blog_id = (int) get_option('page_for_posts');
            if ($blog_id) {
                return untrailingslashit(get_permalink($blog_id));
            }
        }
        if (is_category() || is_tag() || is_tax()) {
            $link = get_term_link(get_queried_object());
            if (is_string($link)) {
                return untrailingslashit($link);
            }
        }
        $req  = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] : '/';
        $path = '/' . ltrim((string) strtok($req, '?'), '/');
        return untrailingslashit(home_url($path));
    }
}

/* === Dados canonicos da Organization (editar SO aqui) ================== */

if (!function_exists('hashtag_schema_org_same_as')) {
    /** Perfis oficiais da Capacitaciones (sameAs). */
    function hashtag_schema_org_same_as(): array
    {
        return apply_filters('hashtag_schema_org_same_as', [
            'https://www.instagram.com/hashtagcapacitaciones',
            'https://www.youtube.com/channel/UCX0YWZfjcj31zllHDhmmlQw',
        ]);
    }
}

if (!function_exists('hashtag_schema_org_knows_about')) {
    /** Topicos de expertise (knowsAbout) — curado (a Cap ainda nao tem catalogo). */
    function hashtag_schema_org_knows_about(): array
    {
        // So as areas REAIS hoje (Diego 2026-06-25): a Cap vende Excel e IA.
        // Adicionar outras (Power BI/Python/SQL...) so quando houver curso/landing real.
        return apply_filters('hashtag_schema_org_knows_about', [
            'Excel',
            'Inteligencia Artificial',
        ]);
    }
}

if (!function_exists('hashtag_schema_org_logo_node')) {
    /** Logo canonico (ImageObject #logo). Cap-hosted (era cross-domain no schema do RM). */
    function hashtag_schema_org_logo_node(): array
    {
        return [
            '@type'   => 'ImageObject',
            '@id'     => hashtag_schema_logo_id(),
            'url'     => get_template_directory_uri() . '/desenvolvimento_hashtag/assets/imgs/Global/logo-hashtag.webp',
            'caption' => 'Hashtag Capacitaciones',
        ];
    }
}

if (!function_exists('hashtag_schema_org_in_language')) {
    /** Idioma do conteudo da Cap = espanhol (LatAm), apesar do WPLANG pt_BR. */
    function hashtag_schema_org_in_language(): string
    {
        return apply_filters('hashtag_schema_in_language', 'es');
    }
}

if (!function_exists('hashtag_schema_organization_node')) {
    function hashtag_schema_organization_node(): array
    {
        $node = [
            '@type'         => ['Organization', 'EducationalOrganization'],
            '@id'           => hashtag_schema_org_id(),
            'name'          => 'Hashtag Capacitaciones',
            'alternateName' => 'Hashtag',
            'url'           => trailingslashit(home_url('/')),
            'logo'          => ['@id' => hashtag_schema_logo_id()],
            'image'         => ['@id' => hashtag_schema_logo_id()],
            'description'   => 'Escuela online de tecnologia y productividad para America Latina: cursos de Excel e Inteligencia Artificial enfocados en la aplicacion practica en el mercado laboral.',
            'areaServed'    => ['Latin America', 'CO', 'CL', 'MX', 'PE', 'AR', 'EC'],
            'sameAs'        => hashtag_schema_org_same_as(),
        ];

        $knows = hashtag_schema_org_knows_about();
        if ($knows) {
            $node['knowsAbout'] = $knows;
        }

        return $node;
    }
}

/* === WebSite =========================================================== */

if (!function_exists('hashtag_schema_website_node')) {
    function hashtag_schema_website_node(): array
    {
        $home = trailingslashit(home_url('/'));

        return [
            '@type'           => 'WebSite',
            '@id'             => hashtag_schema_website_id(),
            'url'             => $home,
            'name'            => 'Hashtag Capacitaciones',
            'alternateName'   => 'Hashtag',
            'inLanguage'      => hashtag_schema_org_in_language(),
            'publisher'       => hashtag_schema_org_ref(),
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => [
                    '@type'       => 'EntryPoint',
                    'urlTemplate' => $home . '?s={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }
}

/* === BreadcrumbList ==================================================== */

if (!function_exists('hashtag_schema_breadcrumb_items')) {
    /**
     * @return array<int,array{name:string,item:string}>|null
     */
    function hashtag_schema_breadcrumb_items(): ?array
    {
        $home  = trailingslashit(home_url('/'));
        $items = [['name' => 'Inicio', 'item' => $home]];

        $blog_id  = (int) get_option('page_for_posts');
        $blog_url = $blog_id ? trailingslashit(get_permalink($blog_id)) : trailingslashit(home_url('/blog'));

        if (is_front_page()) {
            return null;
        }

        if (is_singular('post')) {
            $items[] = ['name' => 'Blog', 'item' => $blog_url];
            $items[] = ['name' => wp_strip_all_tags(get_the_title()), 'item' => hashtag_schema_current_url()];
            return $items;
        }

        if (is_home()) {
            $items[] = ['name' => 'Blog', 'item' => $blog_url];
            return $items;
        }

        if (is_category() || is_tag() || is_tax()) {
            $term = get_queried_object();
            $items[] = ['name' => 'Blog', 'item' => $blog_url];
            if ($term && isset($term->name)) {
                $items[] = ['name' => $term->name, 'item' => hashtag_schema_current_url()];
            }
            return $items;
        }

        if (is_page()) {
            $items[] = ['name' => wp_strip_all_tags(get_the_title()), 'item' => hashtag_schema_current_url()];
            return $items;
        }

        if (is_author()) {
            $author = get_queried_object();
            $items[] = ['name' => 'Blog', 'item' => $blog_url];
            if ($author instanceof WP_User) {
                $items[] = ['name' => $author->display_name, 'item' => hashtag_schema_current_url()];
            }
            return $items;
        }

        return null;
    }
}

if (!function_exists('hashtag_schema_breadcrumb_node')) {
    function hashtag_schema_breadcrumb_node(): ?array
    {
        $items = hashtag_schema_breadcrumb_items();
        if (!$items) {
            return null;
        }

        $list = [];
        $pos  = 1;
        foreach ($items as $it) {
            $list[] = [
                '@type'    => 'ListItem',
                'position' => $pos++,
                'name'     => $it['name'],
                'item'     => $it['item'],
            ];
        }

        return [
            '@type'           => 'BreadcrumbList',
            '@id'             => hashtag_schema_current_url() . '#breadcrumb',
            'itemListElement' => $list,
        ];
    }
}

/* === WebPage =========================================================== */

if (!function_exists('hashtag_schema_webpage_node')) {
    function hashtag_schema_webpage_node(): array
    {
        $node = [
            '@type'      => is_author() ? 'ProfilePage' : 'WebPage',
            '@id'        => hashtag_schema_webpage_id(),
            'url'        => hashtag_schema_current_url(),
            'name'       => wp_get_document_title(),
            'isPartOf'   => hashtag_schema_website_ref(),
            'inLanguage' => hashtag_schema_org_in_language(),
        ];

        if (is_front_page()) {
            $node['about'] = hashtag_schema_org_ref();
        }

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

        $bc = hashtag_schema_breadcrumb_node();
        if ($bc) {
            $node['breadcrumb'] = ['@id' => $bc['@id']];
        }

        return $node;
    }
}

/* === Providers (entidades-base saem em TODA pagina; prioridades baixas) === */

if (function_exists('hashtag_schema_register')) {
    hashtag_schema_register('hashtag_schema_organization_node', 1);
    hashtag_schema_register('hashtag_schema_org_logo_node', 1); // no top-level #logo (ref por Org.logo/.image)
    hashtag_schema_register('hashtag_schema_website_node', 2);
    hashtag_schema_register('hashtag_schema_webpage_node', 3);
    hashtag_schema_register('hashtag_schema_breadcrumb_node', 4);
}
