<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<div id="main" class="container container--main">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole">
            <?php if ( have_posts() ) { ?>

	            <?php
	            /* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
	            the_post();
	            ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php printf( esc_html__( 'All posts by %s', 'bucket-lite' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h2>
                </div>

	            <?php
	            /* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
	            rewind_posts();
	            ?>

	            <?php if ( get_the_author_meta( 'description' ) ) { ?>
		            <?php get_template_part( 'author-bio' ); ?>
	            <?php } ?>
                <div class="grid  masonry" data-columns>
		            <?php while ( have_posts() ){
		            the_post(); ?><!--
                        -->
                    <div class="masonry__item"><?php get_template_part( 'theme-partials/post-templates/content-masonry' ); ?></div><!--
                 --><?php } ?>
                </div>
	            <?php echo wpgrade::pagination();
            }else{ get_template_part( 'no-results', 'index' );
	        } ?>
        </div><!--
        
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>
    
<?php get_footer();
