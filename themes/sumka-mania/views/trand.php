<h2 class="section-title">Сумки в тренде</h2>
<ul class="products">
	<? $trand = get_field( 'тренд', get_option( 'page_on_front' ) );
	foreach ( $trand as $post ):
		global $product;
		$product = wc_get_product( $post->ID );
		?>
        <li <?php wc_product_class( 'product-card col-lg-3 col-md-4 col-sm-6' ); ?>>
			<? wc_get_template_part( 'content', 'product' ); ?>
        </li>
	<? endforeach; ?>
</ul>