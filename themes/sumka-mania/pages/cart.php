<? /* Template Name: Корзина */
get_header(); ?>
    <div class="advantages-background">
		<? get_template_part( 'views/advantages' ) ?>
    </div>
    <div class="container">
		<?= do_shortcode( '[woocommerce_cart]' ) ?>
		<? if ( ! WC()->cart->is_empty() ): ?>
            <h2 class="section-title">Доставка</h2>
			<?= do_shortcode( '[woocommerce_checkout]' );
		endif;
		?>
    </div>
<? get_footer() ?>