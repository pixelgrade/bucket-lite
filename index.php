<?php get_header(); ?>

<div id="main" class="content djax-updatable">

<?php if ( have_posts() ) :	?>
	
    <div class="masonry" data-columns>
        <?php while ( have_posts() ) : the_post();
			get_template_part('theme-partials/post-templates/blog-content');
        endwhile; ?>
    </div><!-- .masonry -->

<?php else : ?>

    <?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>

</div>

<?php get_footer(); ?>