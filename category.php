<?php
/**
 * The template for displaying Category pages.
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
			<?php get_template_part( 'theme-partials/post-templates/header-category' ); ?>
			<?php if ( have_posts() ) { ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php the_archive_title( '' ); ?></h2><span
                            class="archive__side-title beta"><?php esc_html_e( 'Articles', 'bucket-lite' ); ?></span>
                </div>

				<?php if ( get_the_archive_description() ) { // Show an optional category description ?>
                    <div class="archive-meta"><?php the_archive_description(); ?></div>
				<?php } ?>
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
