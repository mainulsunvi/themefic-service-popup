<?php

namespace TFSP\Classes;

class Plugin_Filters {
	function init() {
		add_filter( 'auto_update_plugin', array($this, "add_autoupdate") );
	}
	
	function add_autoupdate(): bool {
		return true;
	}
}