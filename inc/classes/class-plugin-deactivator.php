<?php

namespace TFSP\Classes;

// don't load directly
defined( 'ABSPATH' ) || exit;

class Plugin_Deactivator {
	function init(): void {
		register_deactivation_hook( TFSP_ROOT . 'tsbf.php', array( $this, 'plugin_deactivation' ) );
	}
	
	static function plugin_deactivation(): void {
		wp_delete_post( 2, true );
	}
	
}