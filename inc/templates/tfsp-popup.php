<?php
$services_to_show = !empty( TFSP_Settings["tfsp_popup_products"]) ? $this->serialize_to_array(TFSP_Settings["tfsp_popup_products"]) : array();
$selected_ids = wp_list_pluck($services_to_show, 'tfsp_products_for_popup');

if($this->is_tourfic() && ( empty(TFSP_Settings["tfsp_disable_popup"]) || TFSP_Settings["tfsp_disable_popup"] != 1) ):
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
            <?php foreach($services_to_show as $key => $product_services): ?>
                <?php if(!empty($product_services["tfsp_popup_services"]) && is_array($product_services["tfsp_popup_services"])): ?>
                    <?php if( $product_services["tfsp_products_for_popup"] == $this->cart_item_id ): ?>
                        <?php foreach($product_services["tfsp_popup_services"] as $key => $service): ?>
                            <div class="tf-single-tour-extra tour-extra-single">
                                <label for="service<?php echo $key ?>">
                                    <div class="tf-extra-check-box">
                                        <input type="checkbox" value="<?php echo $key; ?>" data-title="Nam esse magnam nost" id="service<?php echo $key ?>" name="tf-tour-extra[]">
                                        <span class="checkmark"></span>
                                    </div>
                                    <div class="tf-extra-content">
                                        <h5><span class="tfsp-service-title"><?php echo !empty($service["tfsp_service_title"]) ? $service["tfsp_service_title"] : ''; ?></span>   -                                                         
                                            <span>
                                                <span class="woocommerce-Price-amount amount"><bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span><?php echo !empty($service["tfsp_service_price"]) ? $service["tfsp_service_price"] : ''; ?> 
                                                </bdi></span>
                                            </span>
                                        </h5>														
                                    </div>
                                </label>
                                <p><?php echo !empty($service["tfsp_service_desc"]) ? $service["tfsp_service_desc"] : ''; ?> </p>
                            </div>
                        <?php endforeach;?>
                    <? endif; ?>
                <?php endif; ?>  
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
<?php endif; ?>