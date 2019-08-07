<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
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
            <?php if ( have_posts() ){ ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php
                        /* translators: %s: Tag Archive Name */
                        printf( esc_html__( 'Tag Archives: %s', 'bucket-lite' ), single_tag_title( '', false ) );
                        ?></h2>
                </div>

	            <?php if ( get_the_archive_description() ){ // Show an optional tag description ?>
                    <div class="archive-meta"><?php the_archive_description(); ?></div>
	            <?php } ?>

                <div class="grid  masonry" data-columns>
		            <?php while ( have_posts() ){
		                the_post(); ?><!--
                        --><div class="masonry__item"><?php get_template_part('theme-partials/post-templates/content-masonry'); ?></div><!--
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
