<?php

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
		$output .= '<span class="c-footer__credits">' . sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'bucket-lite' ), 'Bucket Lite', '<a href="https://pixelgrade.com/?utm_source=bucket-lite-clients&utm_medium=footer&utm_campaign=bucket-lite" title="' . esc_html__( 'The Pixelgrade Website', 'bucket-lite' ) . '" rel="nofollow">Pixelgrade</a>' ) . '</span>' . "\n";

		echo apply_filters( 'pixelgrade_footer_the_copyright', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
