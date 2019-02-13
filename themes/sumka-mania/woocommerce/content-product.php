<?php

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$post_thumbnail_id = $product->get_image_id();
$img = wp_prepare_attachment_for_js($post_thumbnail_id);
?>
<a href="<? the_permalink() ?>" class="photo">
    <img src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>">
</a>
<div class="product-block">
    <div class="product-actions">
        <?= do_shortcode( '[ti_wishlists_addtowishlist]' ); ?>
        <a class="add-to-cart" data-id="<? the_ID() ?>" href="<?= $product->add_to_cart_url() ?>"><i class="fal fa-shopping-cart"></i></a>
    </div>
    <p class="title"><? the_title() ?></p>
    <div class="excerpt"><? the_excerpt() ?></div>
    <p class="price"><?= wc_price($product->get_price()) ?></p>
</div>
