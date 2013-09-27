<?php
/**
 * The template for displaying Tag pages.
 *
 */

get_header(); ?>

<div id="main" class="content djax-updatable">

<?php if ( have_posts() ) :
	//lets handle the title display
	//we will use the page title
	?>
	<div class="masonry" data-columns>
		<div class="masonry__item archive-title">
			<div class="entry__header">
				<h1 class="entry__title"><?php printf( __( 'Tag Archives: %s', wpgrade::textdomain() ), single_tag_title( '', false ) ); ?></h1>
				<hr class="separator separator--dotted grow">
			</div>
			<div class="entry__content"><?php echo tag_description(); ?></div>
		</div><!-- .masonry__item -->
        <?php while ( have_posts() ) : the_post();
			get_template_part('theme-partials/post-templates/blog-content');
        endwhile; ?>
    </div><!-- .masonry -->

<?php else : ?>

    <?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>

</div>

<?php get_footer(); ?>