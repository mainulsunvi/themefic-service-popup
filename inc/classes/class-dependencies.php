<?php

namespace TFSP\Classes;

// don't load directly
defined( 'ABSPATH' ) || exit;

class Dependencies {
	private object $admin_loader;
	private object $public_loader;
	private object $plugin_activator;
	private object $plugin_translator;
	private object $plugin_deactivator;
	private object $plugin_filters;
	private object $admin_menu;
	private object $wc_checkout_page;
	
	function __construct(
		Admin_Assets $admin_loader,
		Public_Assets $public_loader,
		Plugin_Activator $plugin_activator,
		Plugin_Deactivator $plugin_deactivator,
		Plugin_Translator $plugin_translator,
		Plugin_Filters $plugin_filters,
		Admin_Menu $admin_menu,
		Wc_Checkout_Page $wc_checkout_page
	) {
		$this -> admin_loader       = $admin_loader;
		$this -> public_loader      = $public_loader;
		$this -> plugin_activator   = $plugin_activator;
		$this -> plugin_deactivator = $plugin_deactivator;
		$this -> plugin_translator  = $plugin_translator;
		$this -> plugin_filters     = $plugin_filters;
		$this -> admin_menu 		= $admin_menu;
		$this->wc_checkout_page 	= $wc_checkout_page;
	}
	
	function loader(): void {
		$this -> admin_loader -> init();
		$this -> public_loader -> init();
		$this -> plugin_activator -> init();
		$this -> plugin_deactivator -> init();
		$this -> plugin_translator -> init();
		$this -> plugin_filters -> init();
		$this -> admin_menu -> init();
		$this -> wc_checkout_page -> init();
	}
}