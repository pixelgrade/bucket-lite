<?php
/**
 * Fields available:
 * @posts_source select (featured / latest / latest_by_cat / latest_by_format / latest_by_reviews)
 * @number_of_posts number
 * @read_more_label string
 */

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
$index = 0;
$closed_group = true;

if ($slides->have_posts()): ?>
	<div class="billboard pixslider js-pixslider">
	    <?php while($slides->have_posts()): $slides->the_post();
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-big');
      			if ($index++ % 3 == 0):
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-big');
                if (!$closed_group):
                    echo '</div><div>';
                else:
                    echo '<div>';
                    $closed_group = false;
                endif; ?>
                <article class="article article--billboard">
                    <div class="image-wrap">
                        <img src="<?php echo $image[0] ?>" />
                    </div>
                    <div class="article__header article--billboard__header">
                        <div class="billboard__category"><?php _e('Featured', wpgrade::textdomain()); ?></div>
                        <h2 class="article__title article--billboard__title">
                            <div class="hN"><?php the_title(); ?></div>
                        </h2>
                        <a class="small-link" href="<?php the_permalink(); ?>"><?php echo $read_more_label; ?> &raquo;</a>
                    </div>
                </article>
  	        <?php else: ?>
  	            <article class="article article--billboard-small">
  	                <div class="image-wrap">
  	                    <img src="<?php echo $image[0] ?>" />
  	                </div>
  	                <h2 class="article__title article--billboard-small__title">
  	                    <div class="hN"><?php the_title(); ?></div>
  	                </h2>
  	                <a class="small-link" href="<?php the_permalink(); ?>"><?php echo $read_more_label; ?> <em>+</em></a>
  	            </article>
  	        <?php endif;
		endwhile;
		wp_reset_postdata();
        if (!$closed_group):
            echo '</div>';
            $closed_group = false;
        endif; ?>
	</div>
<?php endif;
