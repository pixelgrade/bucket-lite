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
			<?php get_template_part('theme-partials/post-templates/header-category'); ?>
            <?php if (have_posts()): ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php echo single_cat_title( '', false ); ?></h2><span class="archive__side-title beta"><?php _e( 'Articles', 'bucket-lite' ); ?></span>
                </div>
				
				<?php if ( category_description() ) : // Show an optional category description ?>
				    <div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
                <div class="grid  masonry" data-columns>
		            <?php while (have_posts()): the_post(); ?><!--
                        --><div class="masonry__item"><?php get_template_part('theme-partials/post-templates/content-masonry'); ?></div><!--
                 --><?php endwhile; ?>
                </div>
                <?php echo wpgrade::pagination();
	        else: get_template_part( 'no-results', 'index' ); endif; ?>
        </div><!--
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>
    
<?php get_footer(); ?>
