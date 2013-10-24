<?php 
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

<div id="main" class="container container--main">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole">
            <?php if (have_posts()): ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php printf( __( 'Category Archives: %s', wpgrade::textdomain() ), single_cat_title( '', false ) ); ?></h2>
					
					<?php if ( category_description() ) : // Show an optional category description ?>
					<div class="archive-meta"><?php echo category_description(); ?></div>
					<?php endif; ?>
                </div>
                <div class="grid" data-columns>
                    <?php while (have_posts()): the_post(); ?><!--
                     --><div><?php get_template_part('theme-partials/post-templates/content-blog'); ?></div><!--
                 --><?php endwhile; ?>
                    <?php wpgrade::pagination(); ?>
                </div>
            <?php else: get_template_part( 'no-results', 'index' ); endif; ?>
        </div><!--
        
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>
    
<?php get_footer(); ?>