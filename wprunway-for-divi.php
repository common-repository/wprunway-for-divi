<?php
/*
 * Plugin Name: WPRunway for Divi
 * Plugin URI: https://www.wprunway.com
 * Description: Let your wordpress website take off !
 * Version: 1.1.0
 * Author: François Yerg
 * Author URI: https://www.francoisyerg.net
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wprunway-for-divi
 * Domain Path: /languages
 *
 * WP Runway for Divi is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WP Runway for Divi is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WP Runway for Divi. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

// Sécurité : empêcher un accès direct
if (! defined( 'ABSPATH' )) {
	exit();
}

define( 'WPFD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WPFD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPFD_PLUGIN_VERSION', '1.1.0' );
define( 'WPFD_PLUGIN_WEBSITE', 'https://www.wprunway.com' );
define( 'WPFD_PLUGIN_EMAIL', 'support@wprunway.com' );

require_once WPFD_PLUGIN_PATH . 'admin/functions.php';
require_once WPFD_PLUGIN_PATH . 'admin/admin.php';

if (! function_exists( 'wpfd_initialize_extension' )) {

	/**
	 * Creates the extension's main class instance.
	 *
	 * @since 1.0.0
	 */
	function wpfd_initialize_extension() {
		require_once WPFD_PLUGIN_PATH . 'includes/WprunwayForDivi.php';
	}
	add_action( 'divi_extensions_init', 'wpfd_initialize_extension' );
}