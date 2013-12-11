<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();
?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post" class="cart-form">

<?php do_action( 'woocommerce_before_cart_table' ); ?>
<div class="grid">
	<div class="grid__item  one-whole">
		<table class="shop_table cart" cellspacing="0">
			<thead>
				<tr>
					<!-- <th class="product-thumbnail">&nbsp;</th> -->
					<th class="product-name" colspan="2"><?php _e( 'Product', 'woocommerce' ); ?></th>
					<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php _e( 'Price', 'woocommerce' ); ?></th>
					<th class="product-remove">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
					foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
						$_product = $values['data'];
						if ( $_product->exists() && $values['quantity'] > 0 ) {
							?>
							<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">

								<!-- The thumbnail -->
								<td class="product-thumbnail">
									<?php
										$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

										if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
											echo $thumbnail;
										else
											printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
									?>
								</td>

								<!-- Product Name -->
								<td class="product-name">
									<?php
										if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
											echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
										else
											printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

										// Meta data
										echo $woocommerce->cart->get_item_data( $values );

		                   				// Backorder notification
		                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
		                   					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
									?>
								</td>

								<!-- Quantity inputs -->
								<td class="product-quantity">
									<?php
										if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
										} else {

											$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
											$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
											$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );

											$product_quantity = sprintf( '<div class="pix-quantity"><input type="text" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" maxlength="12" data-item_key="%s" /></div>', $cart_item_key, $step, $min, $max, esc_attr( $values['quantity'] ), $cart_item_key );
										}

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
									?>
								</td>

								<!-- Product subtotal -->
								<td class="product-subtotal">
									<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
									?>
								</td>

								<!-- Remove from cart link -->
								<td class="product-remove">
									<?php
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove no_djax" title="%s" data-item_key="%s", data-remove_nonce="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ), $cart_item_key, wp_create_nonce("woo_remove_".$cart_item_key) ), $cart_item_key );
									?>
								</td>
							</tr>
							<?php
						}
					}
				}

				do_action( 'woocommerce_cart_contents' );
				?>
				
				<!-- Totals -->
				<?php woocommerce_cart_totals(); ?>
				
				<tr class="cart-buttons">
					<td colspan="4" class="actions">

						<?php if ( $woocommerce->cart->coupons_enabled() ) { ?>
							<div class="coupon"  style="display:none;">

								<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input name="coupon_code" class="input-text" id="coupon_code" value="" /> <input type="submit" class="btn btn--medium" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

								<?php do_action('woocommerce_cart_coupon'); ?>

							</div>
						<?php } ?>

						<?php if ( !wpgrade::option('use_ajax_loading') ) { ?>
							<input type="submit" class="btn btn--medium" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />
						<?php } ?>
						<input type="submit" class="btn  btn--medium  btn--primary" name="proceed" value="<?php _e( 'Checkout', 'woocommerce' ); ?>" />

						<?php do_action('woocommerce_proceed_to_checkout'); ?>

						<?php $woocommerce->nonce_field('cart') ?>
					</td>
					<td class="product-remove"></td>

				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>
	</div><!--
	--><div class="grid__item  one-whole  lap-and-up-one-half  float--right">
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</div>
</form>
<div class="grid">
	<div class="grid__item  one-whole  lap-and-up-one-half  float--right">
		<?php woocommerce_shipping_calculator(); ?>
	</div>
</div>

<div class="cart-collaterals">

	<?php //do_action('woocommerce_cart_collaterals'); ?>

	<?php //woocommerce_cart_totals(); ?>


</div>

<?php do_action( 'woocommerce_after_cart' ); ?>