<?php 
/**
 * The template for displaying Archive pages.
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
				<h1 class="entry__title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', wpgrade::textdomain() ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', wpgrade::textdomain() ), get_the_date( _x( 'F Y', 'monthly archives date format', wpgrade::textdomain() ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', wpgrade::textdomain() ), get_the_date( _x( 'Y', 'yearly archives date format', wpgrade::textdomain() ) ) );
					else :
						_e( 'Archives', wpgrade::textdomain() );
					endif;
				?></h1>
				<hr class="separator separator--dotted grow">
			</div>
			<div class="entry__content"><?php echo $current_excerpt; ?></div>
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