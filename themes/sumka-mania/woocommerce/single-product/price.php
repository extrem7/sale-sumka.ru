<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$price    = null;
$discount = null;

$regularPrice = $product->get_regular_price();
$salePrice    = $product->get_sale_price();
if ( $salePrice ) {
	$price    = $salePrice;
	$discount = $regularPrice - $salePrice;
} else {
	$price = $regularPrice;
}
?>
    <div class="prices">
        <div class="actual">
            <div class="price-name">Цена</div>
            <p class="price"><?= wc_price( $regularPrice ) ?></p>
        </div>
		<? if ( $salePrice ): ?>
            <div class="sale">
                <div class="price-name">Цена со скидкой</div>
                <p class="price"><?= wc_price( $price ) ?></p>
            </div>
		<? endif; ?>
    </div>
<? if ( $discount ): ?>
    <div class="discount">
        <p class="discount-name">Скидка</p>
        <p class="price"><?= wc_price( $discount ) ?></p>
    </div>
<? endif; ?>