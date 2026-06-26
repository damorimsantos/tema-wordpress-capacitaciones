<?php
/**
 * Painel admin "Opcoes do Site" — substituto NATIVO da options page do ACF (Capacitaciones).
 *
 * Mesmo slug do ACF (`opcoes-do-site`) para manter validos os links existentes. Le e grava
 * nas MESMAS chaves `options_<campo>` que o ACF usava — zero migracao (a pagina hoje esta
 * vazia; passa a ser editavel nativamente).
 *
 * head/footer guardam HTML/script cru (GTM) — NAO sanitizar (mesmo comportamento do ACF;
 * gravacao restrita a usuario logado com a capability `edit_posts` + nonce).
 *
 * @package hashtag
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Definicao dos campos editaveis. `type` controla render/sanitizacao:
 *  - textarea: HTML cru preservado (head/footer)
 *  - text:     sanitize_text_field (URLs)
 *
 * Conjunto = os campos de option referenciados nos templates da Cap
 * (head/footer vivos; youtube/instagram/whatsapp_alon em parts/* legados).
 *
 * @return array<string,array{label:string,type:string,rows?:int,desc?:string}>
 */
function hashtag_site_options_fields()
{
    return array(
        'head' => array(
            'label' => 'Head — scripts no &lt;head&gt;',
            'type'  => 'textarea',
            'rows'  => 14,
            'desc'  => 'Injetado no &lt;head&gt; de todas as paginas (GTM, google-site-verification, etc.). HTML/script cru.',
        ),
        'footer' => array(
            'label' => 'Footer — scripts antes de &lt;/body&gt;',
            'type'  => 'textarea',
            'rows'  => 14,
            'desc'  => 'Injetado antes de &lt;/body&gt; de todas as paginas (ex.: GTM noscript). HTML/script cru.',
        ),
        'youtube'       => array('label' => 'YouTube (URL)', 'type' => 'text'),
        'instagram'     => array('label' => 'Instagram (URL)', 'type' => 'text'),
        'whatsapp_alon' => array('label' => 'WhatsApp (URL)', 'type' => 'text'),
    );
}

/**
 * Registra a pagina de menu (top-level, mesma posicao do ACF).
 */
function hashtag_register_site_options_page()
{
    add_menu_page(
        'Opcoes do Site',
        'Opcoes do Site',
        'edit_posts',
        'opcoes-do-site',
        'hashtag_render_site_options_page',
        'dashicons-admin-settings',
        2
    );
}
add_action('admin_menu', 'hashtag_register_site_options_page');

/**
 * Processa o POST do formulario (nonce + capability) e grava nas chaves options_<campo>.
 *
 * @return bool True se salvou nesta request.
 */
function hashtag_maybe_save_site_options()
{
    if (!isset($_POST['hashtag_site_options_submit'])) {
        return false;
    }

    if (!current_user_can('edit_posts')) {
        wp_die('Permissao insuficiente.');
    }

    check_admin_referer('hashtag_save_site_options', 'hashtag_site_options_nonce');

    $posted = isset($_POST['hashtag_opt']) && is_array($_POST['hashtag_opt'])
        ? $_POST['hashtag_opt']
        : array();

    foreach (hashtag_site_options_fields() as $name => $field) {
        $raw = isset($posted[$name]) ? (string) $posted[$name] : '';

        if ($field['type'] === 'textarea') {
            // HTML/script cru (GTM): so remove as barras que o WP adiciona ao $_POST.
            $value = wp_unslash($raw);
        } else {
            $value = sanitize_text_field(wp_unslash($raw));
        }

        update_option(HASHTAG_OPTION_PREFIX . $name, $value);
    }

    // Gancho de extensao (ex.: invalidar cache no futuro). Sem efeito por padrao.
    do_action('hashtag_site_options_saved');

    return true;
}

/**
 * Renderiza a pagina de opcoes.
 */
function hashtag_render_site_options_page()
{
    if (!current_user_can('edit_posts')) {
        return;
    }

    $saved  = hashtag_maybe_save_site_options();
    $fields = hashtag_site_options_fields();
    ?>
    <div class="wrap">
        <h1>Opcoes do Site</h1>
        <?php if ($saved) : ?>
            <div class="notice notice-success is-dismissible"><p>Opcoes salvas.</p></div>
        <?php endif; ?>
        <p class="description">
            Substituto nativo da antiga pagina ACF. Os campos <code>head</code> e
            <code>footer</code> aceitam HTML/script cru e sao injetados em todas as paginas.
        </p>
        <form method="post" action="">
            <?php wp_nonce_field('hashtag_save_site_options', 'hashtag_site_options_nonce'); ?>
            <table class="form-table" role="presentation">
                <tbody>
                <?php foreach ($fields as $name => $field) : ?>
                    <?php $value = get_option(HASHTAG_OPTION_PREFIX . $name, ''); ?>
                    <tr>
                        <th scope="row">
                            <label for="hashtag-opt-<?php echo esc_attr($name); ?>">
                                <?php echo wp_kses($field['label'], array()); ?>
                            </label>
                        </th>
                        <td>
                            <?php if ($field['type'] === 'textarea') : ?>
                                <textarea
                                    id="hashtag-opt-<?php echo esc_attr($name); ?>"
                                    name="hashtag_opt[<?php echo esc_attr($name); ?>]"
                                    rows="<?php echo (int) ($field['rows'] ?? 8); ?>"
                                    class="large-text code"
                                    spellcheck="false"
                                ><?php echo esc_textarea((string) $value); ?></textarea>
                                <?php if (!empty($field['desc'])) : ?>
                                    <p class="description"><?php echo wp_kses($field['desc'], array()); ?></p>
                                <?php endif; ?>
                            <?php else : ?>
                                <input
                                    type="text"
                                    id="hashtag-opt-<?php echo esc_attr($name); ?>"
                                    name="hashtag_opt[<?php echo esc_attr($name); ?>]"
                                    value="<?php echo esc_attr((string) $value); ?>"
                                    class="regular-text"
                                />
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p class="submit">
                <button type="submit" name="hashtag_site_options_submit" value="1" class="button button-primary">
                    Salvar opcoes
                </button>
            </p>
        </form>
    </div>
    <?php
}
