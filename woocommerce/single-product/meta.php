<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'n/a', 'woocommerce' ); ?></span>.</span>

	<?php endif; ?>

	<?php
	if ( function_exists('wc_get_product_category_list') ) {
		echo wc_get_product_category_list( $product->get_id(), '', '<div class="btn-list">' . _n( '<div class="btn  btn--small  btn--secondary">Category:</div>', '<div class="btn  btn--small  btn--secondary">Categories:</div>', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</div>' );
	} else {
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ' ', '<div class="btn-list">' . _n( '<div class="btn  btn--small  btn--secondary">Category</div>', '<div class="btn  btn--small  btn--secondary">Categories</div>', $size, 'bucket' ) . ' ', '</div>' );
	}

	if ( function_exists('wc_get_product_tag_list') ) {
		echo wc_get_product_tag_list( $product->get_id(), '', '<div class="btn-list">' . _n( '<div class="btn  btn--small  btn--secondary">Tag:</div>', '<div class="btn  btn--small  btn--secondary">Tags:</div>', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</div>' );
	} else {
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ' ', '<div class="btn-list">' . _n( '<div class="btn  btn--small  btn--secondary">Tag:</div>', '<div class="btn  btn--small  btn--secondary">Tags:</div>', $size, 'bucket' ) . ' ', '</div>' );
	}

	do_action( 'woocommerce_product_meta_end' ); ?>

</div>