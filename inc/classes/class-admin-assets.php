<?php

namespace TFSP\Classes;

// don't load directly
defined( 'ABSPATH' ) || exit;


class Admin_Assets {
	private string $plugin_version;
	
	function __construct() {
		$this -> plugin_version = TFSP_DATA['Version'] . '.' . time();
	}
	
	function init(): void {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
	}
	
	function admin_assets(): void {
		wp_enqueue_style( SM_PREFIX . '-admin', TFSP_ROOT_URL . 'assets/admin/css/admin.min.css', null, $this -> plugin_version );
		
		wp_enqueue_script( SM_PREFIX . '-admin-script', TFSP_ROOT_URL . 'assets/admin/js/admin.script.min.js', array( 'jquery' ), $this -> plugin_version, true );
	}
}