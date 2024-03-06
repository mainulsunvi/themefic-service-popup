<?php

namespace TFSP\Classes;

// don't load directly
defined( 'ABSPATH' ) || exit;

use TFSP\Traits\Helpers;

class Wc_Checkout_Page {

    use Helpers;

    function init() {
        add_action( 'woocommerce_checkout_before_customer_details', array($this, 'tfsp_checkout_before_customer_details_popup'), 10 );
        // add_action( 'woocommerce_store_api_cart_update_customer_from_request', array($this, 'ts_checkout_before_customer_details'), 10 );
        add_action( 'woocommerce_review_order_after_cart_contents', array( $this, 'tfsp_review_order_after_cart_contents_callback') );
        add_action( 'wp_ajax_tfsp_wc_cart_meta', array( $this, 'tsfp_wc_cart_meta_callback'));
        add_action( 'wp_ajax_nopriv_tfsp_wc_cart_meta', array( $this, 'tsfp_wc_cart_meta_callback'));
        add_filter( 'woocommerce_checkout_create_order_line_item', array( $this, 'tfsp_checkout_create_order_line_item_callback'), 10, 4 );
        
    }

    function tfsp_checkout_before_customer_details_popup(){
        
       if(file_exists(TFSP_ROOT . 'inc/templates/tfsp-popup.php')) {
        require TFSP_ROOT . 'inc/templates/tfsp-popup.php';
       }
    }

    function tfsp_review_order_after_cart_contents_callback($order){
        $text = __('Prices for grocery items may vary at store. Final bill will be based on store receipt.');
        if($this->is_tourfic()):
        ?>
            <tr class="order-total" style="display: none;">
                
                <td class="service-title"><strong><?php echo __("Services", SM_PREFIX) ?></strong></td>
                <td class="services"></td>
            </tr>
        <?php
        endif;
    }

    function tsfp_wc_cart_meta_callback() {

        $services = !empty($_POST["tfsp_services"]) ? sanitize_text_field($_POST["tfsp_services"]): "";
       
        $services = explode('^', $services);

        if(is_array($services)) {
            $cart = WC()->cart->cart_contents;
            foreach( $cart as $cart_item_id=>$cart_item) {
                foreach($services as $key => $service) {
                    $cart_item["tfsp_service"][$key] = $service;
                    WC()->cart->cart_contents[ $cart_item_id ] = $cart_item;
                }
                WC()->cart->set_session();
                break;
            }
        }

        wp_send_json_success(array(
            "data" => $cart_item,
            "success" => true
        ));

       wp_die();
    }

    function tfsp_checkout_create_order_line_item_callback($item, $cart_item_key, $values, $order) {
        $tfsp_service = ! empty( $values['tfsp_service'] ) ? $values['tfsp_service'] : '';

        if ( $tfsp_service ) {
            // foreach($tfsp_service as $service) {
                $item->update_meta_data( '_tfsp_service', $tfsp_service );
            // }
        }
    }
}