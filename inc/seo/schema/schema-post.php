<?php
/**
 * Provider de schema dos POSTS de blog (Capacitaciones): BlogPosting + Person no grafo.
 * Porte adaptado do hashtag (sem articleBody, sem video-chain; a Cap nao tem author-eeat,
 * o Person degrada gracioso). Liga por @id ao WebPage/Organization do grafo.
 *
 * @package Hashtag\Schema
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('hashtag_schema_author_id')) {
    function hashtag_schema_author_id(int $user_id): string
    {
        return untrailingslashit(get_author_posts_url($user_id)) . '#person';
    }
}

if (!function_exists('hashtag_schema_person_node')) {
    /**
     * No Person de um autor. Degrada gracioso (so campo que existe).
     *
     * @param int $user_id
     * @return array<string,mixed>
     */
    function hashtag_schema_person_node(int $user_id): array
    {
        $node = [
            '@type' => 'Person',
            '@id'   => hashtag_schema_author_id($user_id),
            'name'  => get_the_author_meta('display_name', $user_id),
            'url'   => untrailingslashit(get_author_posts_url($user_id)),
        ];

        $avatar = get_avatar_url($user_id, ['size' => 512]);
        if ($avatar) {
            $node['image'] = ['@type' => 'ImageObject', 'url' => $avatar];
        }

        $bio = trim((string) get_the_author_meta('description', $user_id));
        if ($bio !== '') {
            $node['description'] = $bio;
        }

        if (function_exists('hashtag_schema_org_ref')) {
            $node['worksFor'] = hashtag_schema_org_ref();
        }

        return $node;
    }
}

if (!function_exists('hashtag_schema_post_image_url')) {
    /**
     * Imagem do post (BlogPosting.image e EXIGIDO pelo Google). Chain de fallback:
     * destacada -> 1a <img> do conteudo -> logo.
     */
    function hashtag_schema_post_image_url(int $post_id): ?string
    {
        if (has_post_thumbnail($post_id)) {
            $src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
            if (is_array($src) && !empty($src[0])) {
                return $src[0];
            }
        }
        $content = (string) get_post_field('post_content', $post_id);
        if ($content !== '' && preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $m)) {
            return $m[1];
        }
        return null;
    }
}

if (!function_exists('hashtag_schema_post_nodes')) {
    /**
     * BlogPosting (#article) + Person (#person) do post atual.
     *
     * @return array<int,array<string,mixed>>
     */
    function hashtag_schema_post_nodes(): array
    {
        if (!is_singular('post')) {
            return [];
        }

        $post = get_queried_object();
        if (!($post instanceof WP_Post)) {
            return [];
        }

        $url        = hashtag_schema_current_url();
        $author_id  = (int) $post->post_author;
        $headline   = wp_strip_all_tags(get_the_title($post));
        $published  = get_the_date('c', $post);
        $modified   = get_the_modified_date('c', $post);

        $article = [
            '@type'            => 'BlogPosting',
            '@id'              => $url . '#article',
            'isPartOf'         => ['@id' => hashtag_schema_webpage_id()],
            'mainEntityOfPage' => ['@id' => hashtag_schema_webpage_id()],
            'headline'         => $headline,
            'datePublished'    => $published ?: null,
            'dateModified'     => $modified ?: $published ?: null,
            'author'           => ['@id' => hashtag_schema_author_id($author_id)],
            'publisher'        => hashtag_schema_org_ref(),
            'inLanguage'       => function_exists('hashtag_schema_org_in_language') ? hashtag_schema_org_in_language() : 'es',
        ];

        // Descricao = excerpt/meta (sem articleBody — Google nao usa p/ rich result).
        $excerpt = trim(wp_strip_all_tags(get_the_excerpt($post)));
        if ($excerpt !== '') {
            $article['description'] = $excerpt;
        }

        $img = hashtag_schema_post_image_url((int) $post->ID);
        if ($img) {
            $article['image'] = ['@type' => 'ImageObject', 'url' => $img];
        } else {
            $article['image'] = ['@id' => hashtag_schema_logo_id()];
        }

        // articleSection = categorias.
        $cats = get_the_category($post->ID);
        if ($cats) {
            $names = array_values(array_filter(array_map(static function ($c) {
                return isset($c->name) ? $c->name : '';
            }, $cats)));
            if ($names) {
                $article['articleSection'] = $names;
            }
        }

        // Limpa nulos.
        $article = array_filter($article, static function ($v) {
            return $v !== null;
        });

        return [
            $article,
            hashtag_schema_person_node($author_id),
        ];
    }
}

if (function_exists('hashtag_schema_register')) {
    hashtag_schema_register('hashtag_schema_post_nodes', 20);
}
