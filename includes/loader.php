<?php

// Sécurité : empêcher un accès direct
if (! defined( 'ABSPATH' )) {
	exit();
}

if (! class_exists( 'ET_Builder_Element' )) {
	return;
}

$modules_list = wpfd_get_modules_list();
foreach ( (array) $modules_list as $slug => $module ) {
	if (wpfd_module_is_activated( $slug ) === true) {
		require_once ($module['file']);
	}
}