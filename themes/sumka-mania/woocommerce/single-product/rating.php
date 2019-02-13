<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
	return;
}

$rate = floor($product->get_average_rating());
?>
<div class="star-rate">
	<?
	for ( $i = 1; $i <= $rate; $i ++ ):
		?>
        <i class="fas fa-star"></i>
	<? endfor;
	for ( $i = 1; $i <= 5 - $rate; $i ++ ):
		?>
        <i class="fal fa-star"></i>
	<? endfor; ?>
</div>
