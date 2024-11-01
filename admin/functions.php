<?php

// Sécurité : empêcher un accès direct
if (! defined( 'ABSPATH' )) {
	exit();
}

/*
 * Liste des modules
 */
function wpfd_get_modules_list() {
	return array(
		'wpfd_alert' => array(
			'name' => esc_html__( "Alert", 'wprunway-for-divi' ),
			'description' => esc_html__( "Display a customisable alert message on your website.", 'wprunway-for-divi' ),
			'file' => 'modules/Alert/Alert.php',
			'badge' => '',
			'icon' => WPFD_PLUGIN_URL . 'includes/modules/Alert/icon.svg',
			'demo' => WPFD_PLUGIN_WEBSITE . 'module/alert/'
		),
		/**
		 * 'wpfd_flipbox' => array(
		 * 'name' => esc_html__( "Flipbox", 'wprunway-for-divi' ),
		 * 'description' => esc_html__( "Use flipbox to increase your visitors experience.", 'wprunway-for-divi' ),
		 * 'file' => 'modules/Flipbox/Flipbox.php',
		 * 'badge' => 'new',
		 * 'icon' => WPFD_PLUGIN_URL . 'includes/modules/Flipbox/icon.svg',
		 * 'demo' => WPFD_PLUGIN_WEBSITE . 'module/flipbox/'
		 * ),
		 */
		'wpfd_note' => array(
			'name' => esc_html__( "Note", 'wprunway-for-divi' ),
			'description' => esc_html__( "Display a note on your website.", 'wprunway-for-divi' ),
			'file' => 'modules/Note/Note.php',
			'badge' => '',
			'icon' => WPFD_PLUGIN_URL . 'includes/modules/Note/icon.svg',
			'demo' => WPFD_PLUGIN_WEBSITE . 'module/note/'
		),
		'wpfd_profile' => array(
			'name' => esc_html__( "Profile", 'wprunway-for-divi' ),
			'description' => esc_html__( "Show profiles on your website from current user, post author or custom user", 'wprunway-for-divi' ),
			'file' => 'modules/Profile/Profile.php',
			'badge' => 'new',
			'icon' => WPFD_PLUGIN_URL . 'includes/modules/Profile/icon.svg',
			'demo' => WPFD_PLUGIN_WEBSITE . 'module/profile/'
		),
		'wpfd_readingtime' => array(
			'name' => esc_html__( "Reading time", 'wprunway-for-divi' ),
			'description' => esc_html__( "Display an estimation of the time needed to read a post or page based on the number of words.", 'wprunway-for-divi' ),
			'file' => 'modules/ReadingTime/ReadingTime.php',
			'badge' => '',
			'icon' => WPFD_PLUGIN_URL . 'includes/modules/ReadingTime/icon.svg',
			'demo' => WPFD_PLUGIN_WEBSITE . 'module/reading-time/'
		),
		'wpfd_tag' => array(
			'name' => esc_html__( "Tag", 'wprunway-for-divi' ),
			'description' => esc_html__( "Display a tag in the begining, middle or end of a sentence.", 'wprunway-for-divi' ),
			'file' => 'modules/Tag/Tag.php',
			'badge' => '',
			'icon' => WPFD_PLUGIN_URL . 'includes/modules/Tag/icon.svg',
			'demo' => WPFD_PLUGIN_WEBSITE . 'module/tag/'
		)
	);
}

/**
 * Vérifie que Divi soit iinstallé et activé
 */
function wpfd_divi_is_activated() {
	$theme = wp_get_theme();

	// Vérifier si le thème est un thème enfant
	if ($theme->parent()) {
		// Obtenir les informations du thème parent
		$parent_theme = $theme->parent();

		// Vérifier si le thème parent est Divi
		if ($parent_theme->get( 'Name' ) === 'Divi') {
			return true;
		}
	}

	if ($theme->get( 'Name' ) == 'Divi') {
		return true;
	}

	// Vérifier si le plugin Divi Builder est actif
	include_once (ABSPATH . 'wp-admin/includes/plugin.php');
	if (is_plugin_active( 'divi-builder/divi-builder.php' )) {
		return true;
	}

	// Divi n'est pas installé
	return false;
}

/**
 * Vérifie si un module est activé
 */
function wpfd_module_is_activated($slug) {
	$modules_settings = get_option( 'wpfd_modules_settings' );

	if (isset( $modules_settings['enable_' . $slug] ) && $modules_settings['enable_' . $slug] != 1) {
		return false;
	}

	return true;
}