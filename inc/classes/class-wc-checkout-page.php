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
        if($this->is_tourfic()) :
        ?>
        <div class="tfsp-checkout-container" style="display: none;">
            <div class="tfsp-checkout-popup">
                <div class="tfsp-before-popup-section">
                    <div class="tfsb-popup-title">
                        <h3><?php echo !empty(TFSP_Settings["tfsp_popup_main_title"]) ? TFSP_Settings["tfsp_popup_main_title"] : __("Services You May Like to Add") ?></h3>
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
                                    <input type="checkbox" value="<?php echo $key; ?>" data-title="Nam esse magnam nost" id="service<?php echo $key ?>" name="tf-tour-extra[]">
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
                    <?php if(!empty(TFSP_Settings["tfsp_other_service_box"]) && TFSP_Settings["tfsp_other_service_box"] == 1): ?>
                        <div class="tf-single-tour-extra tour-extra-single">
                            <label for="tfsp-other-textarea">
                                <div class="tf-extra-check-box">
                                    <input type="checkbox" value="<?php echo $key; ?>" data-title="Nam esse magnam nost" id="tfsp-other-textarea" name="tfsp-other-textarea">
                                    <span class="checkmark"></span>
                                </div>
                                <div class="tf-extra-content">
                                    <h5>
                                        <span class="tfsp-service-title"><?php echo __("Other Service", SM_PREFIX) ?></span>
                                    </h5>														
                                </div>
                            </label>
                            <textarea class="tfsb-popup-textarea" placeholder="Describe the Service You need"></textarea>
                        </div>
                    <?php endif; ?>
                    <!-- Popup End -->
                    <?php if(!empty(TFSP_Settings["tfsp_popup_button_text"])): ?>
                        <div class="popup-submit-button"><?php echo __(TFSP_Settings["tfsp_popup_button_text"], SM_PREFIX) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        endif;
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