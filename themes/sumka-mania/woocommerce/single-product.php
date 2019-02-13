<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$product = wc_get_product( $post );

get_header( 'shop' ); ?>
    <div class="advantages-background">
		<? get_template_part( 'views/advantages' ) ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="notices-area w-100"><? wc_print_notices() ?></div>
        </div>
        <div class="row align-items-start">
			<? get_sidebar() ?>
            <div class="d-flex flex-column align-items-center col-lg-4 col-md-5">
                <div class="gallery">
					<? wc_get_template( 'single-product/product-image.php' ) ?>
                    <div class="thumbnails">
						<? wc_get_template( 'single-product/product-thumbnails.php' ) ?>
                    </div>
                </div>
				<? if ( get_field( 'блок_заголовок' ) || get_field( 'блок_текст' ) ): ?>
                    <div class="warning-block">
						<? if ( get_field( 'блок_заголовок' ) ): ?>
                            <p class="title"><i class="fal fa-info-circle"></i><? the_field( 'блок_заголовок' ) ?></p>
						<? endif; ?>
                        <p class="text"><? the_field( 'блок_текст' ) ?></p>
                    </div>
				<? endif; ?>
            </div>
            <div class="product-info col-lg-5 col-md-7">
				<? wc_get_template( 'single-product/title.php' ) ?>
				<? wc_get_template( 'single-product/price.php' ) ?>
                <p class="rate-title">Рейтинг</p>
                <div class="rate">
                    <div class="star-rate">
						<? wc_get_template( 'single-product/rating.php' ) ?>
                    </div>
                    <div class="actions">
						<?= do_shortcode( '[ti_wishlists_addtowishlist]' ); ?>
                        <a class="add-to-cart" data-id="<? the_ID() ?>" href="<?= $product->add_to_cart_url() ?>"><i
                                    class="fal fa-shopping-cart"></i></a>
                    </div>
                </div>
                <div class="additional-info">
					<? if ( get_field( 'доставка' ) ): ?>
                        <div class="delivery">
                            <p>Способ доставки</p>
                            <i class="fal fa-question-circle" data-toggle="tooltip" data-placement="left"
                               title="<? the_field( 'доставка' ) ?>"></i>
                        </div>
					<?endif;
					if ( get_field( 'условия' ) ):
						?>
                        <div class="conditions">
                            <p>Условия доставки</p>
                            <i class="fal fa-question-circle" data-toggle="tooltip" data-placement="left"
                               title="<? the_field( 'условия' ) ?>"></i>
                        </div>
					<? endif; ?>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="active" id="home-tab" data-toggle="tab" href="#tab-1">Описание</a>
            </li>
			<?
			$commentsCount = $product->get_review_count();
			?>
            <li class="nav-item">
                <a class="" id="profile-tab" data-toggle="tab"
                   href="#tab-2">Комментарии <?= $commentsCount ? "($commentsCount)" : '' ?></a>
            </li>
            <!--<li class="nav-item">
                <a class="" id="contact-tab" data-toggle="tab" href="#tab-3">Гарантии продавца</a>
            </li>-->
        </ul>
        <div class="tab-content">
            <div class="tab-pane typography fade show active" id="tab-1" role="tabpanel">
				<?= apply_filters( 'the_content', wpautop( get_post_field( 'post_content', $id ), true ) ); ?>
            </div>
            <div class="tab-pane comments fade" id="tab-2" role="tabpanel">
				<? wc_get_template( 'single-product-reviews.php' ) ?>
            </div>
            <div class="tab-pane typography fade" id="tab-3" role="tabpanel">
                <h2>Гарантийные гарантии заголовок (Н2)</h2><br>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                    accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et
                    quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                    aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi
                    nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                    velit,
                    sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat
                    voluptatem.</p><br>
                <h3>Примерный заголовок (Н3)</h3><br>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                    accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et
                    quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                    aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi
                    nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                    velit,
                    sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat
                    voluptatem.</p>
            </div>
        </div>
		<? get_template_part( 'views/trand' ) ?>
    </div>
<? get_footer( 'shop' );
