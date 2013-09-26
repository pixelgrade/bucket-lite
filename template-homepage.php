<?php 
/*
Template Name: Custom Home Page
*/

get_header('homepage');
//now this is a template that simply reads the meta data of the page with this template and delivers the output
//let's get cranking

//get the option the user choosed in the page metaboxes
$source = get_post_meta(lens::lang_page_id(get_the_ID()), wpgrade::prefix() . 'custom_homepage', true);

if (!empty($source)) {
	switch ($source) {
		case 'lens_portfolio':
			get_template_part('theme-partials/portfolio-archive-loop');
			break;
		case 'lens_gallery':
			//get the gallery id
			$galleryID = get_post_meta(lens::lang_post_id(get_the_ID()), wpgrade::prefix() . 'homepage_gallery', true);
			
			if (is_numeric($galleryID)) {
				global $wp_query;
				query_posts('post_type=lens_gallery&p='.$galleryID);
				get_template_part('theme-partials/single-lens_gallery-loop');
				wp_reset_query();
			}
			break;
	}
}
get_footer();