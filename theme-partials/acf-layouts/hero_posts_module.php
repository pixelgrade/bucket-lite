<?php
/**
 * Hero Posts Module
 * Fields available:
 * @posts_source select (featured / latest / latest_by_cat / latest_by_format / latest_by_reviews)
 * @number_of_posts number
 */

$number_of_posts = get_sub_field('number_of_posts');
$more = $number_of_posts - 1;
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

    <div class="featured-area">
        <?php while($slides->have_posts()): $slides->the_post(); ?>
            <div class="featured-area__article  article--big">
                <?php
                if (has_post_thumbnail()):
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-big');
                    $image_ratio = $image[2] * 100/$image[1]; ?>
                    <a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
                        <img src="<?php echo $image[0] ?>" />
                        <div class="article__title">
                            <h3 class="hN"><?php the_title(); ?></h3>
                        </div>
                    </a>
                <?php endif;
	            post_format_icon('post-format-icon--featured'); ?>
            </div><!--
        <?php endwhile; wp_reset_postdata(); ?>
     --><div class="featured-area__aside">
            <ul class="block-list  block-list--alt">
                <?php
                $args = array(
                    'posts_per_page' => $more,
                    // 'post__not_in' => get_option('sticky_posts'),
                    'ignore_sticky_posts' => true,
                    'offset' => 1
                );

                if ($more > 0):
                    $myquery = new WP_Query( $args );
                    while($myquery->have_posts()): $myquery->the_post(); ?>
	                    <li class="hard--sides">
	                        <article class="article  article--thumb  media  flush--bottom">
	                            <div class="media__img--rev  four-twelfths">
	                                <?php
                                    if (has_post_thumbnail()):
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-small');
                                        $image_ratio = $image[2] * 100/$image[1]; ?>
                                        <a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
                                            <img src="<?php echo $image[0] ?>" />
                                        </a>
	                                <?php endif; ?>
	                            </div>
	                            <div class="media__body">
	                                <?php
                                    $categories = get_the_category();
                                    if ($categories) {
                                        $category = $categories[0];
                                        echo '<div class="article__category">
                                                <a class="small-link" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s"), $category->name)) .'">'. $category->cat_name.'</a>
                                              </div>';
                                    } ?>
	                                <div class="article__title  article--thumb__title">
	                                      <a href="<?php the_permalink(); ?>"><h3 class="hN"><?php the_title(); ?></h3></a>
	                                </div>
	                                <ul class="nav  article__meta-links">
	                                    <li><i class="icon-time"></i> <?php the_time('j M') ?></li>
	                                    <li><i class="icon-comment"></i>  <?php comments_number('0', '1', '%'); ?></li>
	                                    <li><i class="icon-heart"></i> 12</li>
	                                </ul>
	                            </div>
	                        </article>
	                    </li>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </ul>
        </div>
    </div>
<?php endif;
