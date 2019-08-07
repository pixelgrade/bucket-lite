<?php 
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<div id="main" class="container container--main">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole  content content--404">
			<div class="heading  heading--main">
				<h2 class="hN"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bucket-lite' ); ?></h2>
			</div>
			<p><?php printf(
			        /* translators: %s: Homepage URL */
			        wp_kses_post( __( 'This may be because of a mistyped URL, faulty referral or out-of-date search engine listing.<br/>You should try the <a href="%s">homepage</a> instead or maybe do a search?', 'bucket-lite' ) ),
                    esc_url( home_url() ) ); ?>
            </p>
			<div class="search-form  search-form--404">
				<?php get_search_form(); ?>
			</div>
        </div><!--
        
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>
    
<?php get_footer();