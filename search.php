<?php
/**
 * The template for displaying Search Results pages.
 */

get_header(); ?>

<div id="main" class="container container--main">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole">
			<?php if ( have_posts() ) { ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php printf( esc_html__( 'Search Results for: %s', 'bucket-lite' ), get_search_query() ); ?></h2>
                </div>
                <div class="grid  masonry" data-columns>
					<?php while ( have_posts() ){
					the_post(); ?><!--
                        -->
                    <div class="masonry__item"><?php get_template_part( 'theme-partials/post-templates/content-masonry' ); ?></div><!--
                 --><?php } ?>
                </div>
				<?php echo wpgrade::pagination();
			} else {
				get_template_part( 'no-results', 'index' );
			} ?>
        </div><!--
        
     -->
        <div class="grid__item  one-third  palm-one-whole  sidebar">
			<?php get_sidebar(); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
