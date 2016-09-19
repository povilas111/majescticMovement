<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
$price = 10;
if(get_post_meta( get_the_ID(), '_sale_price', true) != null){
	$price = get_post_meta( get_the_ID(), '_sale_price', true);
}
$regular_price = get_post_meta( get_the_ID(), '_regular_price', true );
$symbol = get_woocommerce_currency_symbol();
?>
<?php 

	if((int)$price == 10){
		echo '<div class="col-xs-6"><span class="price">'; echo $regular_price . " " . $symbol; echo '</span></div>';
	}else{
		echo '<div class="col-xs-6"><span class="price">'; echo $price . " " . $symbol; echo '</span></div>';
	}
?>
