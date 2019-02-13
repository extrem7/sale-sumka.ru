<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

?>
<h1 class="title"><? the_title() ?></h1>
<div class="excerpt"><? the_excerpt() ?></div>
<div class="articulus">
    <b>Номер товара</b>
    <span><?= $product->get_sku() ?></span>
</div>
