<?php

namespace TFSP\Classes;

// don't load directly
defined( 'ABSPATH' ) || exit;

class Public_Assets {
	private string $plugin_version;
	
	function __construct() {
		$this -> plugin_version = TFSP_DATA['Version'] . '.' . time();
	}
	
	function init(): void {
		add_action('wp_enqueue_scripts', array($this, 'public_assets'));
	}
	
	function public_assets(): void {
		wp_enqueue_style( SM_PREFIX. '-public-main', TFSP_ROOT_URL . 'assets/public/css/public.min.css', null, $this->plugin_version);
		
		wp_enqueue_script( SM_PREFIX. '-public-script', TFSP_ROOT_URL . 'assets/public/js/public.script.min.js', array('jquery'), $this->plugin_version, true);
		wp_localize_script(SM_PREFIX. '-public-script', SM_PREFIX .'_data', 
			array(
				'sm_prefix' => SM_PREFIX,
				'nonce' => wp_create_nonce( SM_PREFIX . '-nonce' ),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'tfsp_popup_delay' => !empty(TFSP_Settings["tfsp_popup_opening_delay"]) ? TFSP_Settings["tfsp_popup_opening_delay"] : 0,
			)
		);
	}
}