<?php

namespace TFSP\Traits;

// don't load directly
defined( 'ABSPATH' ) || exit;

trait Helpers {

   public $cart_item_id;

    function serialize_to_array( $var ) {
		if ( ! empty( $var ) && gettype( $var ) == "string" ) {
			$tf_serialize_date = preg_replace_callback( '!s:(\d+):"(.*?)";!', function ( $match ) {
				return ( $match[1] == strlen( $match[2] ) ) ? $match[0] : 's:' . strlen( $match[2] ) . ':"' . $match[2] . '";';
			}, $var );

			return unserialize( $tf_serialize_date );
		} else {
			return $var;
		}
	}

    function is_tourfic() {
        $popup_datas = !empty( TFSP_Settings["tfsp_popup_products"]) ? $this->serialize_to_array(TFSP_Settings["tfsp_popup_products"]) : array();
        $selected_ids = wp_list_pluck($popup_datas, 'tfsp_products_for_popup');

        foreach(WC()->cart->get_cart() as $cart_item) {
            $item_id = $cart_item['data']->get_id();
            $this->cart_item_id = $item_id;
            if(in_array($item_id, $selected_ids)){
                return true;
            }
        }
        return false;
    }
}