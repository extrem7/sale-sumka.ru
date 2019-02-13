<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
wp_enqueue_script( 'tinvwl' );
?>
<div class="tinv-wishlist woocommerce tinv-wishlist-clear">
	<?php do_action( 'tinvwl_before_wishlist', $wishlist ); ?>
    <div class="notices-area">
	<?php if ( function_exists( 'wc_print_notices' ) ) {
		wc_print_notices();
	} ?>
    </div>
	<form action="<?php echo esc_url( tinv_url_wishlist() ); ?>" class="woocommerce-cart-form" method="post" autocomplete="off">
		<?php do_action( 'tinvwl_before_wishlist_table', $wishlist ); ?>
		<table class="tinvwl-table-manage-list">
			<thead>
			<tr>
				<th class="product-remove"></th>
				<th class="product-name"><span
						class="tinvwl-full"><?php esc_html_e( 'Product Name', 'ti-woocommerce-wishlist' ); ?></span><span
						class="tinvwl-mobile"><?php esc_html_e( 'Product', 'ti-woocommerce-wishlist' ); ?></span></th>
				<?php if ( isset( $wishlist_table_row['colm_price'] ) && $wishlist_table_row['colm_price'] ) { ?>
					<th class=""><?php esc_html_e( 'Unit Price', 'ti-woocommerce-wishlist' ); ?></th>
				<?php } ?>
				<?php if ( isset( $wishlist_table_row['add_to_cart'] ) && $wishlist_table_row['add_to_cart'] ) { ?>
					<th class="product-action">&nbsp;</th>
				<?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php do_action( 'tinvwl_wishlist_contents_before' ); ?>

			<?php
			foreach ( $products as $wl_product ) {
				$product = apply_filters( 'tinvwl_wishlist_item', $wl_product['data'] );
				unset( $wl_product['data'] );
				if ( $wl_product['quantity'] > 0 && apply_filters( 'tinvwl_wishlist_item_visible', true, $wl_product, $product ) ) {
					$product_url = apply_filters( 'tinvwl_wishlist_item_url', $product->get_permalink(), $wl_product, $product );
					do_action( 'tinvwl_wishlist_row_before', $wl_product, $product );
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'tinvwl_wishlist_item_class', 'wishlist_item', $wl_product, $product ) ); ?>">
						<td class="product-remove">
							<button type="submit" name="tinvwl-remove"
							        value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
							        title="<?php _e( 'Remove', 'ti-woocommerce-wishlist' ) ?>"><i
									class="fal fa-times"></i>
							</button>
						</td>
                        <td class="product-thumbnail">
							<?php
							$post_thumbnail_id = $product->get_image_id();
							$img               = wp_prepare_attachment_for_js( $post_thumbnail_id );
							?>
                            <a href="<?= $product_url ?>" class="d-flex">
                                <img src="<?= $img['url'] ?>" alt="<? ?>">
                                <div class="product-name">
                                    <p class="title"><?= $product->get_name() ?></p>
                                    <p class="excerpt"><?= get_the_excerpt( $product->get_id() ) ?></p>
                                    <p class="articulus">Артикул: <?= $product->get_sku() ?></p>
                                </div>
                            </a>
                        </td>
						<?php if ( isset( $wishlist_table_row['colm_price'] ) && $wishlist_table_row['colm_price'] ) { ?>
							<td class="product-price">
								<?php
								echo apply_filters( 'tinvwl_wishlist_item_price', $product->get_price_html(), $wl_product, $product ); // WPCS: xss ok.
								?>
							</td>
						<?php } ?>
						<?php if ( isset( $wishlist_table_row['add_to_cart'] ) && $wishlist_table_row['add_to_cart'] ) { ?>
							<td class="product-action">
								<?php
								if ( apply_filters( 'tinvwl_wishlist_item_action_add_to_cart', $wishlist_table_row['add_to_cart'], $wl_product, $product ) ) {
									?>
									<a href="<?= $product->add_to_cart_url() ?>" class="button add-to-cart alt" data-id="<?= $product->get_id(); ?>" name="tinvwl-add-to-cart"
									        value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
									        title="<?php echo esc_html( apply_filters( 'tinvwl_wishlist_item_add_to_cart', $wishlist_table_row['text_add_to_cart'], $wl_product, $product ) ); ?>">
										Купить
									</a>
								<?php } ?>
							</td>
						<?php } ?>
					</tr>
					<?php
					do_action( 'tinvwl_wishlist_row_after', $wl_product, $product );
				} // End if().
			} // End foreach().
			?>
			<?php do_action( 'tinvwl_wishlist_contents_after' ); ?>
			</tbody>
            <tfoot class="d-none">
            <tr>
                <td colspan="100">
					<?php do_action( 'tinvwl_after_wishlist_table', $wishlist ); ?>
					<?php wp_nonce_field( 'tinvwl_wishlist_owner', 'wishlist_nonce' ); ?>
                </td>
            </tr>
            </tfoot>
		</table>
	</form>
	<?php do_action( 'tinvwl_after_wishlist', $wishlist ); ?>
	<div class="tinv-lists-nav tinv-wishlist-clear">
		<?php do_action( 'tinvwl_pagenation_wishlist', $wishlist ); ?>
	</div>
</div>
