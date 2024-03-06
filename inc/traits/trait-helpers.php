<?php

namespace TFSP\Traits;

// don't load directly
defined( 'ABSPATH' ) || exit;

trait Helpers {

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