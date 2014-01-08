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

$paged = (get_query_var('paged')) ? get_query_var('paged') : '';
if( empty($paged)){
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

if( empty($paged)){
	$paged = 1;
}

$number_of_posts = get_sub_field('number_of_posts');

$args = array(
	'paged' => $paged,
	'posts_per_page' => $number_of_posts,
	'order' => 'DESC',
	'orderby' => 'date',
	'ignore_sticky_posts' => true,
);

$offset = get_sub_field('offset');

if ( is_numeric($offset) && $offset > 0 ) {
	$args['offset'] = $offset;
}

/** Return posts from selected categories */
$categories = get_sub_field('posts_source_category');

if (!empty($categories)) {
	$catarr = array();
	foreach ($categories as $key => $value) {
		$catarr[] = (int) $value;
	}

	$args['category__in'] = $catarr;
}

$latest_query = new WP_Query( $args );

if ( get_sub_field('sidebar') == 'enable' ) {
	$has_sidebar = true;
} else {
	$has_sidebar = false;
}

$blog_layout = get_sub_field('posts_format');

if ( $blog_layout == 'masonry' ) {
	$grid_class = 'class="grid masonry ' . ($has_sidebar ? '' : 'fullwidth') . '" data-columns';
} else {
	$grid_class = 'class="classic"';
}

if ($latest_query->have_posts()):


    if ( $has_sidebar ): ?>
        <div class="grid">
            <div class="grid__item  two-thirds  palm-one-whole">
    <?php endif; ?>
		<div class="heading  heading--main">
			<h2 class="hN"><?php the_sub_field('section_title'); ?></h2>
		</div>
        <div <?php echo $grid_class ?>><!--
            <?php while($latest_query->have_posts()): $latest_query->the_post();  ?>
                --><div><?php get_template_part('theme-partials/post-templates/content-'. $blog_layout); ?></div><!--
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
