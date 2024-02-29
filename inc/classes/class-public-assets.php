<?php

namespace TFSP\Classes;

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
	}
}