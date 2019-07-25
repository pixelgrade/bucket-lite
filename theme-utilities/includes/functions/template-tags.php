<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package wpGrade
 * @since wpGrade 1.0
 */

/**
 * Returns true if a blog has more than 1 category
 *
 * @since wpGrade 1.0
 */
function wpgrade_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so wpgrade_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so wpgrade_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in wpgrade_categorized_blog
 *
 * @since wpGrade 1.0
 */
function wpgrade_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'wpgrade_category_transient_flusher' );
add_action( 'save_post', 'wpgrade_category_transient_flusher' );

if ( ! function_exists( 'bucket_lite_footer_the_copyright' ) ) {
	/**
	 * Display the footer copyright.
	 */
	function bucket_lite_footer_the_copyright() {
		$output = '';
		/* translators: %s: WordPress. */
		$output .= '<a href="' . esc_url( __( 'https://wordpress.org/', 'bucket-lite' ) ) . '">' . sprintf( esc_html__( 'Proudly powered by %s', 'bucket-lite' ), 'WordPress' ) . '</a>' . "\n";
		$output .= '<span class="sep"> | </span>';
		/* translators: %1$s: The theme name, %2$s: The theme author name. */
		$output .= '<span class="c-footer__credits">' . sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'bucket-lite' ), 'Bucket Lite', '<a href="https://pixelgrade.com/?utm_source=rosa-lite-clients&utm_medium=footer&utm_campaign=rosa-lite" title="' . esc_html__( 'The Pixelgrade Website', 'bucket-lite' ) . '" rel="nofollow">Pixelgrade</a>' ) . '</span>' . "\n";

		echo apply_filters( 'pixelgrade_footer_the_copyright', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
