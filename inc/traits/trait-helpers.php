<?php
namespace TFSP\Traits;

trait Helpers {

    function is_tourfic() {
        $option_id = !empty(get_option("tfsp_service_post_select")) ? get_option("tfsp_service_post_select") : null;
        foreach(WC()->cart->get_cart() as $cart_item) {
            $item_id = $cart_item['data']->get_id();
            if($item_id == $option_id){
                return true;
            }
        }
        return false;
    }
}