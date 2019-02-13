<? /* Template Name: Главная */
get_header(); ?>
    <div class="container notices-area">
		<? wc_print_notices() ?>
    </div>
    <div class="banner">
        <div class="container">
			<? the_field( 'баннер' ) ?>
        </div>
    </div>
<? get_template_part( 'views/advantages' ) ?>
    <div class="container">
        <h2 class="section-title">Сумки со скидкой</h2>
        <ul class="nav nav-tabs">
			<?
			$categories = get_field( 'категории_вкладок' );
			$active     = 'active';
			foreach ( $categories as $category ):
				?>
                <li class="nav-item">
                    <a class="<?= $active ?>" data-toggle="tab"
                       href="#tab-<?= $category->slug ?>"><?= $category->name ?></a>
                </li>
				<? $active = ''; endforeach; ?>
        </ul>
        <div class="tab-content" id="myTabContent">
			<? $active = 'show active';
			foreach ( $categories as $category ):
				$products = get_posts( [
					'post_type'     => 'product',
					'posts_per_page' => 3,
					'post_status'   => 'publish',
					'orderby'       => 'meta_value_num',
					'meta_key'      => '_price',
					'order'         => 'asc',
					'tax_query'     => [
						[
							'taxonomy' => 'product_cat',
							'terms'    => $category->slug,
							'field'    => 'slug',
						]
					]
				] );
				?>
                <div class="tab-pane fade <?= $active ?>" id="tab-<?= $category->slug ?>">
                    <ul class="products justify-content-around justify-content-lg-start">
						<? foreach ( $products as $post ):
							global $product;
							$product = wc_get_product( $post->ID ); ?>
                            <li <?php wc_product_class( 'product-card product-card-sale col-lg-4 col-sm-6' ); ?>>
								<? wc_get_template_part( 'content', 'product' ); ?>
                            </li>
						<? endforeach; ?>
                    </ul>
                </div>
				<? $active = ''; endforeach;
			wp_reset_query(); ?>
        </div>
        <div class="banner-sale">
			<? the_field( 'баннер_скидки' ) ?>
        </div>
		<? get_template_part( 'views/trand' ) ?>
    </div>
<? get_footer() ?>