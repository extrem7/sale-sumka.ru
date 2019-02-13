<?php

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>
    <div class="advantages-background">
		<? get_template_part( 'views/advantages' ) ?>
    </div>
    <div class="container">
        <div class="row align-items-start flex-column-reverse flex-md-row">
			<? get_sidebar() ?>
            <div class="col-lg-9 col-md-8">
                <div class="row d-block notices-area">
					<? wc_print_notices() ?>
                </div>
                <h2 class="section-title">Сумки в тренде</h2>
                <ul class="products justify-content-start">
					<?php
					if ( woocommerce_product_loop() ) {
						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();
								?>
                                <li <?php wc_product_class( 'product-card col-lg-4 col-md-6 col-sm-6' ); ?>>
									<? wc_get_template_part( 'content', 'product' ); ?>
                                </li>
								<?
							}
						}
					} else {
						do_action( 'woocommerce_no_products_found' );
					} ?>
                </ul>
				<? woocommerce_pagination() ?>
            </div>
        </div>
    </div>
<?
get_footer( 'shop' );
