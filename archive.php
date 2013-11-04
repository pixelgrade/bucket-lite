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
 */

get_header(); ?>

<div id="main" class="container container--main">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole">
            <?php if (have_posts()): ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php

						$var = get_query_var('post_format');
						// POST FORMATS
						if ($var == 'post-format-aside') :
							 _e('Aside Archives', wpgrade::textdomain());
						elseif ($var == 'post-format-image') : 
							 _e('Image Archives', wpgrade::textdomain());
						elseif ($var == 'post-format-link') : 
							 _e('Link Archives', wpgrade::textdomain());
						elseif ($var == 'post-format-quote') : 
							 _e('Quote Archives', wpgrade::textdomain());
						elseif ($var == 'post-format-status') : 
							 _e('Status Archives', wpgrade::textdomain());
						elseif ($var == 'post-format-gallery') : 
							 _e('Gallery Archives', wpgrade::textdomain());
						elseif ($var == 'post-format-video') : 
							 _e('Video Archives', wpgrade::textdomain());
						elseif ($var == 'post-format-audio') : 
							 _e('Audio Archives', wpgrade::textdomain());
						elseif ($var == 'post-format-chat') : 
							 _e('Chat Archives', wpgrade::textdomain());
 
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', wpgrade::textdomain() ), get_the_date() );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', wpgrade::textdomain() ), get_the_date( _x( 'F Y', 'monthly archives date format', wpgrade::textdomain() ) ) );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', wpgrade::textdomain() ), get_the_date( _x( 'Y', 'yearly archives date format', wpgrade::textdomain() ) ) );
						else :
							_e( 'Archives', wpgrade::textdomain() );
						endif;
					?></h2>
                </div>
                <div class="grid  masonry" data-columns>
                    <?php while (have_posts()): the_post(); ?><!--
                     --><div class="masonry__item"><?php get_template_part('theme-partials/post-templates/content-blog'); ?></div><!--
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