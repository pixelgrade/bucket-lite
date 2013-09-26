<?php 
/*
Template Name: Journal (Blog) Page
*/

get_header(); ?>
    <?php 
		global $paged;
		global $wp_query;
		$paged = 1;
		if ( get_query_var('paged') ) $paged = get_query_var('paged');  
		if ( get_query_var('page') ) $paged = get_query_var('page');
		query_posts( array('post_type' => 'post', 'paged'=>$paged));
		
	    get_template_part('theme-partials/blog-archive');
		wp_reset_query();
	?>
<?php get_footer(); ?>