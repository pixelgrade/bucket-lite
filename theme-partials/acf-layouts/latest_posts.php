<?php
/**
 * Latest Posts Component
 * Fields :
 * @number_of_posts number
 * @pagination radio (enable / disable)
 * @section_title string
 * @sidebar radio (enable / disable)
 */


//set some variables to pass to the content-blog.php loaded below
global $wp_query;
$wp_query->query_vars['thumbnail_size'] = 'blog-medium';

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$number_of_posts = get_sub_field('number_of_posts');

$args = array(
	'paged' => $paged,
	'posts_per_page' => $number_of_posts,
	'order' => 'DESC',
	'orderby' => 'date',
	'ignore_sticky_posts' => true,
);

$latest_query = new WP_Query( $args );

if ( get_sub_field('sidebar') == 'enable' ) {
	$has_sidebar = true;
} else {
	$has_sidebar = false;
}

if ($latest_query->have_posts()):
    if ( $has_sidebar ): ?>
        <div class="grid">
            <div class="grid__item  two-thirds  palm-one-whole">
    <?php endif; ?>
		<div class="heading  heading--main">
			<h2 class="hN"><?php the_sub_field('section_title'); ?></h2>
		</div>
        <div class="grid <?php echo $has_sidebar ? '' : 'fullwidth' ?>" data-columns><!--
            <?php while($latest_query->have_posts()): $latest_query->the_post(); ?>
             --><div><?php get_template_part('theme-partials/post-templates/content-blog'); ?></div><!--
            <?php endwhile; wp_reset_postdata(); ?>
     --></div>
    <?php



	if ( get_sub_field('pagination') == 'enable' ){
		echo wpgrade::pagination($latest_query);
	}

	if ( $has_sidebar ): ?>
            </div><!--
         --><div class="grid__item  one-third  palm-one-whole  sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php endif;

endif;
