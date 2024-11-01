<?php
/*
 * Plugin Name: wprunway-for-divi
 * Description: Admin page
 * Version: 1.0.0
 * Author: François Yerg
 */

// Sécurité : empêcher un accès direct
if (! defined( 'ABSPATH' )) {
	exit();
}
class WPFD_Admin {

	/**
	 * Initialisation
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', array(
			$this,
			'load_textdomain'
		) );
		add_action( 'admin_menu', array(
			$this,
			'add_admin_menu'
		) );
		add_action( 'admin_enqueue_scripts', array(
			$this,
			'add_admin_scripts'
		) );
		add_action( 'admin_init', array(
			$this,
			'register_settings'
		) );
	}

	/**
	 * Chargement des traductions.
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'wprunway-for-divi', false, WPFD_PLUGIN_PATH . 'languages' );
	}

	/**
	 * Création de la page d'administration.
	 *
	 * @since 1.0.0
	 */
	public function add_admin_menu() {
		add_menu_page( esc_html__( 'WPRunway for Divi', 'wprunway-for-divi' ), esc_html__( 'WPRunway', 'wprunway-for-divi' ), 'manage_options', 'wprunway-for-divi', array(
			$this,
			'render_admin_page'
		), WPFD_PLUGIN_URL . 'assets/img/plugin-icone.svg', 99 );
	}

	/**
	 * Insertion des scripts de la page d'administration.
	 *
	 * @since 1.0.0
	 */
	public function add_admin_scripts() {
		if (get_current_screen()->id == 'toplevel_page_wprunway-for-divi') {
			wp_enqueue_style( 'wpfd-admin-style', WPFD_PLUGIN_URL . 'assets/css/admin.css', array(), WPFD_PLUGIN_VERSION );
			wp_enqueue_script( 'wpfd-admin-script', WPFD_PLUGIN_URL . 'assets/js/admin.js', array(
				'jquery'
			), WPFD_PLUGIN_VERSION, array(
				'in_footer' => true
			) );
		}
	}

	/**
	 * Configuration des options
	 *
	 * @since 1.0.0
	 */
	public function register_settings() {
		$args = array(
			'sanitize_callback' => array(
				$this,
				'sanitize_modules'
			),
			'default' => array()
		);

		foreach ( wpfd_get_modules_list() as $slug => $module ) {
			$args['default']['enable_' . $slug] = 1;
		}

		register_setting( 'wpfd_settings_group', 'wpfd_modules_settings', $args );

		add_settings_section( 'wpfd_modules_settings_section', esc_html__( 'Manage modules', 'wprunway-for-divi' ), array(
			$this,
			'wpfd_modules_section_callback'
		), 'wpfd_modules_settings_section' );

		foreach ( wpfd_get_modules_list() as $slug => $module ) {
			add_settings_field( 'enable_' . $slug, $module['name'], array(
				$this,
				'render_field'
			), 'wpfd_modules_settings_section', 'wpfd_modules_settings_section', array(
				'field_id' => 'wpfd_modules_settings[enable_' . $slug . ']',
				'field_type' => 'switch',
				'field_value' => wpfd_module_is_activated( $slug ) ? 1 : 0,
				'field_help' => $module['description']
			) );
		}
	}

	// Callback pour la section de réglages
	public function wpfd_modules_section_callback() {
		esc_html_e( 'Disable the modules you do not use to enance your website performences.', 'wprunway-for-divi' );
	}

	public function sanitize_modules($inputs) {
		$values = array();
		foreach ( wpfd_get_modules_list() as $slug => $module ) {
			$values['enable_' . $slug] = isset( $inputs['enable_' . $slug] ) ? (int) $inputs['enable_' . $slug] : 0;
		}

		return $values;
	}

	/**
	 * Fonction permettant de générer les champs des formulaires.
	 *
	 * @since 1.0.0
	 */
	public function render_field($args) {
		ob_start();
		if ($args['field_type'] == 'switch') {
			// Vérifier si la case est cochée ou non
			$checked = (isset( $args['field_value'] ) && $args['field_value'] == 1) ? ' checked ' : '';
			$disabled = (isset( $args['field_enabled'] ) && ! $args['field_enabled']) ? ' disabled' : '';

			echo '
				<label class="wpfd_admin_switch">
					<input type="checkbox" id="' . esc_attr( $args['field_id'] ) . '" name="' . esc_attr( $args['field_id'] ) . '" value="1"' . esc_attr( $checked ) . esc_attr( $disabled ) . ' />
					<span class="wpfd_admin_slider"></span>
				</label>
			';

			if (isset( $args['field_help'] ) && ! empty( $args['field_help'] )) {
				echo '<span class="wpfd_admin_help">' . esc_html( $args['field_help'] ) . '</span>';
			}
		}

		ob_end_flush();
		return;
	}

	/**
	 * Rendu de la page d'administration.
	 *
	 * @since 1.0.0
	 */
	public function render_admin_page() {
		include WPFD_PLUGIN_PATH . 'templates/admin-main.php';
	}
}

new WPFD_Admin();