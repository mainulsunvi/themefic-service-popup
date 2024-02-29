<?php

namespace TFSP\Classes;

class Plugin_Activator {
    function init(): void {
        register_activation_hook( TFSP_ROOT . 'tsbf.php', array( $this, 'plugin_activation' ) );
    }

    static function plugin_activation(): void {
	   
    }

}