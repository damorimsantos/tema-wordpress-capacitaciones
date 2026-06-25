<?php

function hashOfertaIa()
{
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';

    if (!$email || !is_email($email)) {
        wp_send_json_error(array('message' => 'E-mail invalido.'), 400);
    }

    // Token da API hash-core: constante no wp-config (NUNCA hardcoded — vazou no git, rotacionar).
    //   define('HASHTAG_OFERTA_IA_TOKEN', '<token>');
    $oferta_ia_token = defined('HASHTAG_OFERTA_IA_TOKEN') ? HASHTAG_OFERTA_IA_TOKEN : '';
    if ('' === $oferta_ia_token) {
        error_log('[hash-oferta-ia] HASHTAG_OFERTA_IA_TOKEN ausente no wp-config.');
        wp_send_json_error(array('message' => 'Servicio no disponible en este momento.'), 503);
    }

    $response = wp_remote_post(
        'https://hash-core-production-68f512f989bd.herokuapp.com/rest/v1/hash-oferta-users/',
        array(
            'timeout' => 15,
            'headers' => array(
                'Authorization' => 'Token ' . $oferta_ia_token,
                'Content-Type' => 'application/json',
            ),
            'body' => wp_json_encode(
                array(
                    'email' => $email,
                    'src' => 'capacitaciones-offer',
                    'metadata' => array(
                        'name' => $name,
                        'phone' => $phone,
                    ),
                )
            ),
        )
    );

    if (is_wp_error($response)) {
        wp_send_json_error(array('message' => $response->get_error_message()), 500);
    }

    $status_code = wp_remote_retrieve_response_code($response);
    $body = wp_remote_retrieve_body($response);

    if ($status_code < 200 || $status_code >= 300) {
        wp_send_json_error(
            array(
                'message' => 'Erro ao registrar os dados da oferta.',
                'status' => $status_code,
                'body' => $body,
            ),
            $status_code
        );
    }

    wp_send_json_success(array('status' => $status_code));
}

add_action('wp_ajax_hashOfertaIa', 'hashOfertaIa');
add_action('wp_ajax_nopriv_hashOfertaIa', 'hashOfertaIa');
