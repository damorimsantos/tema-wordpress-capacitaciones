<?php
/**
 * Plugin Name: Hashtag Mailer (Capacitaciones)
 * Description: Transporte SMTP transacional proprio (porte do hashtag). Credencial FORA do banco
 *              (constantes no wp-config), remetente alinhado ao dominio autenticado, logging proprio
 *              e degradacao graciosa. Nao redefine wp_mail() — so configura o transporte do PHPMailer
 *              do core via phpmailer_init (reusa todo o MIME-building testado do WordPress).
 * Version:     1.0.0
 * Author:      Hashtag Treinamentos
 *
 * --- Configuracao (definir no wp-config.php de prod; NUNCA gravar no banco) ---
 *   define( 'HASHTAG_SMTP_HOST', 'smtp.gmail.com' );
 *   define( 'HASHTAG_SMTP_PORT', 587 );
 *   define( 'HASHTAG_SMTP_ENCRYPTION', 'tls' );                 // 'tls' (587) | 'ssl' (465) | '' (sem)
 *   define( 'HASHTAG_SMTP_USER', 'contato@hashtagcapacitaciones.com' );
 *   define( 'HASHTAG_SMTP_PASS', 'xxxx xxxx xxxx xxxx' );       // App Password do Google Workspace
 *   define( 'HASHTAG_MAIL_FROM', 'contato@hashtagcapacitaciones.com' );
 *   define( 'HASHTAG_MAIL_FROM_NAME', 'Hashtag Capacitaciones' );
 *   // Opcionais:
 *   define( 'HASHTAG_MAIL_REPLY_TO', 'contato@hashtagcapacitaciones.com' );
 *   define( 'HASHTAG_SMTP_AUTH', true );                        // default: true quando ha USER
 *   define( 'HASHTAG_SMTP_TIMEOUT', 15 );                       // segundos
 *   define( 'HASHTAG_MAIL_FORCE_FROM', true );                  // default: true
 *   define( 'HASHTAG_MAIL_LOG', true );                         // default: true
 *
 * DECISAO PENDENTE (Diego): qual conta SMTP/remetente p/ a Cap. Opcoes: (a) conta propria
 * `contato@hashtagcapacitaciones.com` com App Password proprio (melhor SPF/DKIM/branding), ou
 * (b) reusar a conta do hashtag (From sairia @hashtagtreinamentos.com — mismatch de dominio).
 *
 * Sem HASHTAG_SMTP_HOST definido o mailer fica INERTE (WP usa o transporte padrao; nada quebra) —
 * janela segura para deploy nao-atomico.
 *
 * Inspecao via wp-cli:
 *   wp eval 'print_r( Hashtag_Mailer::get_stats() );'
 *   wp eval 'foreach ( Hashtag_Mailer::get_log( 30 ) as $r ) { echo "$r[t] [$r[st]] $r[to] | $r[sub] $r[er]\n"; }'
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Hashtag_Mailer' ) ) {

	final class Hashtag_Mailer {

		const LOG_OPTION   = 'hashtag_mail_log';
		const STATS_OPTION = 'hashtag_mail_stats';
		const LOG_MAX      = 200;

		/** @var Hashtag_Mailer|null */
		private static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		private function __construct() {
			// Configura o transporte SMTP no PHPMailer do core (so quando ha host definido).
			add_action( 'phpmailer_init', array( $this, 'configure_smtp' ), 999 );

			// Remetente alinhado ao dominio autenticado (deliverability + exigencia do Gmail).
			add_filter( 'wp_mail_from', array( $this, 'filter_from' ), 999 );
			add_filter( 'wp_mail_from_name', array( $this, 'filter_from_name' ), 999 );

			// Logging proprio (sucesso + falha com erro real do PHPMailer).
			if ( $this->log_enabled() ) {
				add_action( 'wp_mail_failed', array( $this, 'log_failure' ) );
				add_action( 'wp_mail_succeeded', array( $this, 'log_success' ) );
			}
		}

		/* ----------------------------------------------------------------- *
		 * Estado / configuracao
		 * ----------------------------------------------------------------- */

		private function enabled() {
			return defined( 'HASHTAG_SMTP_HOST' ) && '' !== (string) constant( 'HASHTAG_SMTP_HOST' );
		}

		private function log_enabled() {
			return ! defined( 'HASHTAG_MAIL_LOG' ) || (bool) constant( 'HASHTAG_MAIL_LOG' );
		}

		private function from_address() {
			if ( defined( 'HASHTAG_MAIL_FROM' ) && is_email( constant( 'HASHTAG_MAIL_FROM' ) ) ) {
				return constant( 'HASHTAG_MAIL_FROM' );
			}
			if ( defined( 'HASHTAG_SMTP_USER' ) && is_email( constant( 'HASHTAG_SMTP_USER' ) ) ) {
				return constant( 'HASHTAG_SMTP_USER' );
			}
			return '';
		}

		/* ----------------------------------------------------------------- *
		 * Transporte
		 * ----------------------------------------------------------------- */

		/**
		 * @param PHPMailer\PHPMailer\PHPMailer $phpmailer
		 */
		public function configure_smtp( $phpmailer ) {
			if ( ! $this->enabled() ) {
				return;
			}

			$host       = (string) constant( 'HASHTAG_SMTP_HOST' );
			$port       = defined( 'HASHTAG_SMTP_PORT' ) ? (int) constant( 'HASHTAG_SMTP_PORT' ) : 587;
			$encryption = defined( 'HASHTAG_SMTP_ENCRYPTION' ) ? strtolower( (string) constant( 'HASHTAG_SMTP_ENCRYPTION' ) ) : 'tls';
			$timeout    = defined( 'HASHTAG_SMTP_TIMEOUT' ) ? (int) constant( 'HASHTAG_SMTP_TIMEOUT' ) : 15;

			$phpmailer->isSMTP();
			$phpmailer->Host    = $host;
			$phpmailer->Port    = $port;
			$phpmailer->Timeout = $timeout;

			if ( 'ssl' === $encryption || 'tls' === $encryption ) {
				$phpmailer->SMTPSecure  = $encryption;
				$phpmailer->SMTPAutoTLS = true;
			} else {
				$phpmailer->SMTPSecure  = '';
				$phpmailer->SMTPAutoTLS = false;
			}

			// Autenticacao: liga por padrao quando ha usuario configurado.
			$user = defined( 'HASHTAG_SMTP_USER' ) ? (string) constant( 'HASHTAG_SMTP_USER' ) : '';
			$pass = defined( 'HASHTAG_SMTP_PASS' ) ? (string) constant( 'HASHTAG_SMTP_PASS' ) : '';
			$auth = defined( 'HASHTAG_SMTP_AUTH' ) ? (bool) constant( 'HASHTAG_SMTP_AUTH' ) : ( '' !== $user );

			if ( $auth ) {
				$phpmailer->SMTPAuth = true;
				$phpmailer->Username = $user;
				$phpmailer->Password = $pass;
			} else {
				$phpmailer->SMTPAuth = false;
			}

			// Return-Path / envelope sender alinhado ao From (SPF alignment).
			$from = $this->from_address();
			if ( $from ) {
				$phpmailer->Sender = $from;
			}

			// EHLO/HELO estavel a partir do host do site (evita HELO generico do container).
			$site_host = wp_parse_url( home_url(), PHP_URL_HOST );
			if ( $site_host ) {
				$phpmailer->Hostname = $site_host;
			}

			// Reply-To global opcional — so adiciona se o remetente original nao definiu nenhum.
			if ( defined( 'HASHTAG_MAIL_REPLY_TO' ) && is_email( constant( 'HASHTAG_MAIL_REPLY_TO' ) ) ) {
				$existing = $phpmailer->getReplyToAddresses();
				if ( empty( $existing ) ) {
					$phpmailer->addReplyTo( constant( 'HASHTAG_MAIL_REPLY_TO' ) );
				}
			}
		}

		/* ----------------------------------------------------------------- *
		 * Remetente
		 * ----------------------------------------------------------------- */

		public function filter_from( $from ) {
			if ( ! $this->enabled() ) {
				return $from;
			}
			$forced = $this->from_address();
			if ( ! $forced ) {
				return $from;
			}
			$force = ! defined( 'HASHTAG_MAIL_FORCE_FROM' ) || (bool) constant( 'HASHTAG_MAIL_FORCE_FROM' );
			if ( $force || $this->is_default_wp_from( $from ) ) {
				return $forced;
			}
			return $from;
		}

		public function filter_from_name( $name ) {
			if ( ! $this->enabled() ) {
				return $name;
			}
			if ( defined( 'HASHTAG_MAIL_FROM_NAME' ) && '' !== (string) constant( 'HASHTAG_MAIL_FROM_NAME' ) ) {
				$force = ! defined( 'HASHTAG_MAIL_FORCE_FROM' ) || (bool) constant( 'HASHTAG_MAIL_FORCE_FROM' );
				if ( $force || 'WordPress' === $name ) {
					return (string) constant( 'HASHTAG_MAIL_FROM_NAME' );
				}
			}
			return $name;
		}

		/** Detecta o remetente default generico do WP (wordpress@dominio). */
		private function is_default_wp_from( $from ) {
			$sitename = wp_parse_url( network_home_url(), PHP_URL_HOST );
			if ( ! $sitename ) {
				return false;
			}
			$sitename = strtolower( $sitename );
			if ( str_starts_with( $sitename, 'www.' ) ) {
				$sitename = substr( $sitename, 4 );
			}
			return ( 'wordpress@' . $sitename ) === strtolower( (string) $from );
		}

		/* ----------------------------------------------------------------- *
		 * Logging
		 * ----------------------------------------------------------------- */

		public function log_failure( $wp_error ) {
			$data    = is_wp_error( $wp_error ) ? (array) $wp_error->get_error_data() : array();
			$to      = isset( $data['to'] ) ? $data['to'] : '';
			$subject = isset( $data['subject'] ) ? $data['subject'] : '';
			$msg     = is_wp_error( $wp_error ) ? $wp_error->get_error_message() : 'unknown error';

			$this->append_log( 'fail', $to, $subject, $msg );
			$this->bump_stats( false, $msg );
			error_log( '[hashtag-mailer] FAIL to=' . $this->flatten( $to ) . ' subject="' . $subject . '" error=' . $msg );
		}

		public function log_success( $atts ) {
			$to      = isset( $atts['to'] ) ? $atts['to'] : '';
			$subject = isset( $atts['subject'] ) ? $atts['subject'] : '';

			$this->append_log( 'ok', $to, $subject, '' );
			$this->bump_stats( true, '' );
		}

		private function append_log( $status, $to, $subject, $error ) {
			$log = get_option( self::LOG_OPTION, array() );
			if ( ! is_array( $log ) ) {
				$log = array();
			}
			$log[] = array(
				't'   => current_time( 'mysql' ),
				'st'  => $status, // 'ok' | 'fail'
				'to'  => $this->flatten( $to ),
				'sub' => mb_substr( (string) $subject, 0, 160 ),
				'er'  => mb_substr( (string) $error, 0, 300 ),
			);
			if ( count( $log ) > self::LOG_MAX ) {
				$log = array_slice( $log, -self::LOG_MAX );
			}
			update_option( self::LOG_OPTION, $log, false );
		}

		private function bump_stats( $ok, $error ) {
			$s = get_option( self::STATS_OPTION, array() );
			if ( ! is_array( $s ) ) {
				$s = array();
			}
			$s['sent']   = isset( $s['sent'] ) ? (int) $s['sent'] : 0;
			$s['failed'] = isset( $s['failed'] ) ? (int) $s['failed'] : 0;
			if ( $ok ) {
				$s['sent']++;
				$s['last_ok'] = current_time( 'mysql' );
			} else {
				$s['failed']++;
				$s['last_fail']  = current_time( 'mysql' );
				$s['last_error'] = mb_substr( (string) $error, 0, 300 );
			}
			update_option( self::STATS_OPTION, $s, false );
		}

		private function flatten( $to ) {
			if ( is_array( $to ) ) {
				return implode( ', ', array_map( 'strval', $to ) );
			}
			return (string) $to;
		}

		/* ----------------------------------------------------------------- *
		 * Inspecao (wp-cli)
		 * ----------------------------------------------------------------- */

		public static function get_log( $limit = 50 ) {
			$log = get_option( self::LOG_OPTION, array() );
			if ( ! is_array( $log ) ) {
				return array();
			}
			return array_slice( $log, -1 * (int) $limit );
		}

		public static function get_stats() {
			$s = get_option( self::STATS_OPTION, array() );
			return is_array( $s ) ? $s : array();
		}
	}

	Hashtag_Mailer::instance();
}
