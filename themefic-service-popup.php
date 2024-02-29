<?php

/**
 *
 * @package           Themefic Service Popup
 * @author            Themefic Team
 * @description       Themefic Service Popup for Inhouse Products
 * @license           GPL-3.0-or-later
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name: Themefic Service Popup
 * URI: https://wordpress.org/plugins/
 * Description: Themefic Service Popup for Inhouse Products
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * Author: Mainul Sunvi
 * Author URI: https://profiles.wordpress.org/mainulsunvi/
 * Text Domain: tfsp
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Update URI: https://msunvi.com
 * Domain Path: /languages
 */

use TFSP\Classes\Dependencies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TFSP_ROOT', plugin_dir_path( __FILE__ ) );
define( 'TFSP_ROOT_URL', plugin_dir_url( __FILE__ ) );

require TFSP_ROOT . 'loader/autoload.php';
require_once TFSP_ROOT . 'inc/container/DependencyContainer.php';

if ( ! function_exists( 'get_plugin_data' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

define( 'TFSP_DATA', get_plugin_data( __FILE__ ) );
define('CAP_PREFIX', strtoupper(TFSP_DATA["TextDomain"]));
define('SM_PREFIX', TFSP_DATA["TextDomain"]);

if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	return;
}

add_action( 'woocommerce_checkout_before_customer_details', 'ts_checkout_before_customer_details', 10 );

function ts_checkout_before_customer_details(){
	echo <<<EOD
		<div style="background: rgba(0, 0, 0, .5); height: 100%; width: 100%;position: fixed; top:0; left:0; z-index: 999; display: flex; justify-content: center; align-items: center;">
			<div style="">
				<div style="background: azure; height: 300px; width: 500px; margin: auto">
				Hello World
				</div>
			</div>
		</div>
	EOD;
}


( function () {
	if ( ! class_exists( 'Dependencies' ) ) {
		$container    = new DependencyContainer();
		$dependencies = $container -> get( Dependencies::class );
		$dependencies -> loader();
	}
} )();