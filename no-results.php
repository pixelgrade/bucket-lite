<?php
/**
 * The template for displaying the No Results message.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

    <p><?php
	    /* translators: %1$s: New post link */
        printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bucket-lite' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

<?php } elseif ( is_search() ) { ?>

    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'bucket-lite' ); ?></p>
    <div class="search-form">
		<?php get_search_form(); ?>
    </div>
<?php } else { ?>
    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bucket-lite' ); ?></p>
    <div class="search-form  search-form--404">
		<?php get_search_form(); ?>
    </div>
<?php }
