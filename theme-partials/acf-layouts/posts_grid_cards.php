<?php
/**
 * Posts Grid Card Component
 * Fields available:
 * @posts_source select (featured / latest / latest_by_cat / latest_by_format / latest_by_reviews)
 * @number_of_posts number
 */

//set some variables to pass to the content-blog.php loaded below
global $wp_query;
$wp_query->query_vars['thumbnail_size'] = 'post-medium';

$number_of_posts = get_sub_field('number_of_posts');
$read_more_label = get_sub_field('read_more_label');
if ( empty($read_more_label) ) {
	$read_more_label = 'Read Full Story';
}

$query_args = array(
	'posts_per_page' => $number_of_posts,
);

$posts_source = get_sub_field('posts_source');


switch ( $posts_source ) :

	case 'featured' :
		/** In this case return only posts marked as featured */
		$query_args['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key' => wpgrade::prefix() . 'featured_post',
				'value' => 'on',
				'compare' => '='
			)
		);
		break;
	case 'latest' :
		/** Return the latest posts only */
		$query_args['order'] = 'DESC';
		$query_args['orderby'] = 'date';
		break;
	case 'latest_by_cat' :
		/** Return posts from selected categories */
		$categories = get_sub_field('posts_source_category');
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'terms' => $categories,
				'operator' => 'IN'
			)
		);
	case 'latest_by_format' :
		/** Return posts with the selected post format */
		$formats = get_sub_field('posts_source_post_formats');
		$terms = array();
		foreach ( $formats as $key => &$format) {
			if ( $format =='post' ) { // dosen't work yet
				$query_args['tax_query']['relation'] = 'OR';
				$query_args['tax_query'][2] = array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => 'impossible-post-format',
					'operator' => 'NOT IN'
				);
				continue;
			}

			$format = 'post-format-' . $format;
			$terms[] = $format;
		}

		if ( !empty($terms) ) {
			$query_args['tax_query'][1] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => $terms,
				'operator' => 'IN'
			);
		}

	case 'latest_by_reviews':
		$query_args['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key' => 'enable_review_score',
				'value' => '1',
				'compare' => '='
			)
		);
	default : ;
endswitch;

$slides = new WP_Query( $query_args );

if ($slides->have_posts()): ?>
    <div class="posts-grid-cards grid fullwidth" data-columns><!--
        <?php while($slides->have_posts()): $slides->the_post(); ?>
         --><?php get_template_part('theme-partials/post-templates/content-blog'); ?><!--
        <?php endwhile; wp_reset_postdata(); ?>
 --></div>
<?php endif;
