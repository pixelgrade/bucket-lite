<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Bucket
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

        <div class="grid__item  two-thirds  palm-one-whole">
			<?php if ( have_posts() ) { ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php

						$var = get_query_var( 'post_format' );
						// POST FORMATS
						if ( $var == 'post-format-aside' ) {
							esc_html_e( 'Aside Archives', 'bucket-lite' );
						} elseif ( $var == 'post-format-image' ) {
							esc_html_e( 'Image Archives', 'bucket-lite' );
						} elseif ( $var == 'post-format-link' ) {
							esc_html_e( 'Link Archives', 'bucket-lite' );
						} elseif ( $var == 'post-format-quote' ) {
							esc_html_e( 'Quote Archives', 'bucket-lite' );
						} elseif ( $var == 'post-format-status' ) {
							esc_html_e( 'Status Archives', 'bucket-lite' );
						} elseif ( $var == 'post-format-gallery' ) {
							esc_html_e( 'Gallery Archives', 'bucket-lite' );
						} elseif ( $var == 'post-format-video' ) {
							esc_html_e( 'Video Archives', 'bucket-lite' );
						} elseif ( $var == 'post-format-audio' ) {
							esc_html_e( 'Audio Archives', 'bucket-lite' );
						} elseif ( $var == 'post-format-chat' ) {
							esc_html_e( 'Chat Archives', 'bucket-lite' );
						}

						if ( is_day() ) {
							/* translators: %s: The day in which the posts from the archive were made. */
							printf( esc_html__( 'Daily Archives: %s', 'bucket-lite' ), get_the_date() );
						} elseif ( is_month() ) {
							/* translators: %s: The month in which the posts from the archive were made. */
							printf( esc_html__( 'Monthly Archives: %s', 'bucket-lite' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'bucket-lite' ) ) );
						} elseif ( is_year() ) {
							/* translators: %s: The year in which the posts from the archive were made. */
							printf( esc_html__( 'Yearly Archives: %s', 'bucket-lite' ), get_the_date( _x( 'Y', 'yearly archives date format', 'bucket-lite' ) ) );
						} else {
							esc_html_e( 'Archives', 'bucket-lite' );
						}
						?></h2>
                </div>

                <div class="grid  masonry" data-columns>
					<?php while ( have_posts() ){
					            the_post(); ?><!--
                        --><div class="masonry__item"><?php get_template_part( 'theme-partials/post-templates/content-masonry' ); ?></div><!--
                 --><?php } ?>
                </div>
				<?php echo wpgrade::pagination();
			} else {
				get_template_part( 'no-results', 'index' );
			} ?>
        </div><!--

     --><div class="grid__item  one-third  palm-one-whole  sidebar">
			<?php get_sidebar(); ?>
        </div>

    </div>
</div>

<?php get_footer();
