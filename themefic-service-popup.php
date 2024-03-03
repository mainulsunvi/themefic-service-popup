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
	$services_to_show = array(
		array(
			"title" => "Service 1",
			"desc" => "Start and end in Tokio! With the In-depth Cultural tour Classic Tokio Mini Adventure, lorem ipsum dolor sit amet consectetuer adipiscing elit sed diam. ",
			"price" => 110
		),
		array(
			"title" => "Service 2",
			"desc" => "Start and end in Tokio! With the In-depth Cultural tour Classic Tokio Mini Adventure, lorem ipsum dolor sit amet consectetuer adipiscing elit sed diam. ",
			"price" => 120
		),
	);
	?>
	<div class="tfsp-checkout-container">
		<div class="tfsp-checkout-popup">
			<div class="tfsp-before-popup-section">
				<div class="tfsb-popup-title">
					<h3>Services You May Like to Add</h3>
				</div>
				<div class="tfsp-checkout-popup-cross">
					<span>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect x="0.5" y="0.5" width="23" height="23" rx="3.5" fill="#fdf9f3"></rect>
							<path d="M12 11.1111L15.1111 8L16 8.88889L12.8889 12L16 15.1111L15.1111 16L12 12.8889L8.88889 16L8 15.1111L11.1111 12L8 8.88889L8.88889 8L12 11.1111Z" fill="#000"></path>
							<rect x="0.5" y="0.5" width="23" height="23" rx="3.5" stroke="#fdf9f3"></rect>
						</svg>
					</span>
				</div>
			</div>
			<div class="tfsp-checkout-popup-content">
				<!-- Popup Start -->
				<?php foreach($services_to_show as $key => $service): ?>
					<div class="tf-single-tour-extra tour-extra-single">
						<label for="service<?php echo $key ?>">
							<div class="tf-extra-check-box">
								<input type="checkbox" value="<?php echo $key; ?>" data-title="Nam esse magnam nost" id="service<?php echo $key ?>" name="tf-tour-extra">
								<span class="checkmark"></span>
							</div>
							<div class="tf-extra-content">
								<h5><span class="tfsp-service-title"><?php echo $service["title"]; ?></span>   -                                                         
									<span>
										<span class="woocommerce-Price-amount amount"><bdi>
											<span class="woocommerce-Price-currencySymbol">$</span><?php echo $service["price"]; ?> 
										</bdi></span>
									</span>
								</h5>														
							</div>
						</label>
						<p><?php echo $service["desc"]; ?> </p>
					</div>
				<?php endforeach;?>
				<div class="tf-single-tour-extra tour-extra-single">
						<label for="tfsp-other-textarea">
							<div class="tf-extra-check-box">
								<input type="checkbox" value="<?php echo $key; ?>" data-title="Nam esse magnam nost" id="tfsp-other-textarea" name="tfsp-other-textarea">
								<span class="checkmark"></span>
							</div>
							<div class="tf-extra-content">
								<h5>
									<span class="tfsp-service-title">Other Service</span>
								</h5>														
							</div>
						</label>
						<textarea class="tfsb-popup-textarea" placeholder="Describe the Service You need"></textarea>
					</div>
				<!-- Popup End -->
				<div class="popup-submit-button">Submit</div>
			</div>
		</div>
	</div>
	<?php
}


// add_action( 'woocommerce_checkout_order_processed', 'tf_aprtment_set_order_price', 10, 4 );
// function tf_aprtment_set_order_price($order_id, $posted_data, $order ) {
// 	foreach ( $order->get_items() as $item_id => $item ) {

// 		$order_type = $item->get_meta();

// 		var_dump($order_type);
// 	}
// }

add_action( 'woocommerce_review_order_after_cart_contents', 'review_order_after_order_total_callback' );
function review_order_after_order_total_callback(){
    $text = __('Prices for grocery items may vary at store. Final bill will be based on store receipt.');

    ?>
		<tr class="order-total">
			<td class="service-title"><strong>Services</strong></td>
			<td class="services">
				Prices for grocery items may vary at store. Final bill will be based on store receipt. Prices for grocery items may vary at store. Final bill will be based on store receipt.
			</td>
		</tr>
	<?php
}
add_action( 'woocommerce_order_details_after_order_table_items', 'review_order_after_order_total_callback2' );
function review_order_after_order_total_callback2($order){
    $text = __('Prices for grocery items may vary at store. Final bill will be based on store receipt.');

	var_dump($order->get_meta());
	// exit();
}


( function () {
	if ( ! class_exists( 'Dependencies' ) ) {
		$container    = new DependencyContainer();
		$dependencies = $container -> get( Dependencies::class );
		$dependencies -> loader();
	}
} )();