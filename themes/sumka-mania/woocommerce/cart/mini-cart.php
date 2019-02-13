<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="mini-cart d-flex <?= WC()->cart->is_empty() ? 'justify-content-center' : '' ?> align-items-center">
    <a href="<?= wc_get_cart_url() ?>" class="cart-link <?= WC()->cart->is_empty() ? 'disabled mr-0 ml-0' : '' ?>"><i
                class="fal fa-shopping-cart"></i></a>
	<? if ( WC()->cart->is_empty() ): ?>
        <a href="<?= tinv_url_wishlist_default() ?>"
           class="cart-link mr-0 ml-3"><i
                    class="fal fa-heart"></i></a>
	<? endif; ?>
	<?php if ( ! WC()->cart->is_empty() ) : ?>
        <div class="cart-details">
            Товаров в корзине: <b><?= WC()->cart->get_cart_contents_count(); ?></b><br>
            На сумму: <b><?= WC()->cart->get_cart_total() ?></b><br>
            <a href="<?= wc_get_cart_url() ?>">В корзину<span class="cart-arrow"></span></a>
        </div>
	<?php endif; ?>
</div>