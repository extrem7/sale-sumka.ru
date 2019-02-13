<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );

	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start">
        <div class="fields">
            <label><span class="star-required">*</span> Имя <input type="text" name="billing_first_name"></label>
            <label><span class="star-required">*</span> Телефон <input type="tel" name="billing_phone"></label>
            <label><span class="star-required">*</span> Адрес <input type="text" name="billing_address_1"></label>
        </div>
        <button type="submit" class="submit">Оформить заказ</button>
    </div>
	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

        <div class="col2-set d-none" id="customer_details">
            <div class="col">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
            </div>

            <div class="col">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
            </div>
        </div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>


	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

    <div id="order_review" class="woocommerce-checkout-review-order d-none">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
    </div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
