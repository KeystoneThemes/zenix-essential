<?php

add_filter( 'woocommerce_add_to_cart_fragments', 'zenix_woocommerce_header_add_to_cart_fragment' );

function zenix_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();

	?>
	 <span class="wdb-wc-cart-fragment-content">
    	 <?php 
    	     echo str_pad(WC()->cart->get_cart_contents_count(), 2, "0", STR_PAD_LEFT);
    	 ?>
	 </span>	
	<?php
	$fragments['.wdb-wc-cart-fragment-content'] = ob_get_clean();
	return $fragments;
}