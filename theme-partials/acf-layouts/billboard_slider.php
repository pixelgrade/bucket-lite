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
	$read_more_label = __('Read Full Story', wpgrade::textdomain());
}

$query_args = array(
	'posts_per_page' => $number_of_posts,
	'ignore_sticky_posts' => true,
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
		$catarr = array();
		foreach ($categories as $key => $value) {
			$catarr[] = (int) $value;
		}
		
		$query_args['category__in'] = $catarr;
		break;
		
	case 'latest_by_format' :
		/** Return posts with the selected post format */
		$formats = get_sub_field('posts_source_post_formats');
		$terms = array();
		if (!isset($query_args['tax_query'])) {
			$query_args['tax_query'] = array();
		}
		foreach ( $formats as $key => &$format) {
			if ($format == 'standard') {
				//if we need to include the standard post formats
				//then we need to include the posts that don't have a post format set
				$all_post_formats = get_theme_support('post-formats');
				if (!empty($all_post_formats[0]) && count($all_post_formats[0])) {
					$allterms = array();
					foreach ($all_post_formats[0] as $format2) {
						$allterms[] = 'post-format-'.$format2;
					}
					
					$query_args['tax_query']['relation'] = 'AND';
					$query_args['tax_query'][] = array(
						'taxonomy' => 'post_format',
						'terms' => $allterms,
						'field' => 'slug',
						'operator' => 'NOT IN'
					);
				}
			} else {
				$terms[] = 'post-format-' . $format;
			}
		}
		
		if ( !empty($terms) ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => $terms,
				'operator' => 'IN'
			);
		}
		break;

	case 'latest_by_reviews':
		$query_args['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key' => 'enable_review_score',
				'value' => '1',
				'compare' => '='
			)
		);
		break;
	default : ;
endswitch;

$big_articles_only = get_sub_field('billboard_only_big_articles');

$slider_transition = get_sub_field('billboard_slider_transition');
$slider_autoplay = get_sub_field('billboard_slider_autoplay');
if($slider_autoplay)
    $slider_delay = get_sub_field('billboard_slider_autoplay_delay');

$slides = new WP_Query( $query_args );
$index = 0;
$closed_group = true;

if ($slides->have_posts()): ?>
	<div class="billboard pixslider js-pixslider arrows--outside" 
			data-arrows="true"
			data-autoScaleSliderWidth="1050"
			data-autoScaleSliderHeight="625"
            data-slidertransition="<?php echo $slider_transition; ?>"
            <?php if ($slider_autoplay) {
                echo 'data-sliderautoplay="" ';
                echo 'data-sliderdelay='. $slider_delay;
            } ?>
			>
	    <?php while($slides->have_posts()): $slides->the_post();
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-small');
            $image_big = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-big');
            $image_ratio = 70; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
            
            if (isset($image[1]) && isset($image[2]) && $image[1] > 0) {
              $image_ratio = $image[2] * 100/$image[1];
            }

            if($big_articles_only) :
                $image = $image_big;
                if (isset($image[1]) && isset($image[2]) && $image[1] > 0) {
                  $image_ratio = $image[2] * 100/$image[1];
                }

                if (!$closed_group):
                    echo '</div><div class="billboard--article-group">';
                else:
                    echo '<div class="billboard--article-group">';
                    $closed_group = false;
                endif; ?>
                    <article class="article  article--billboard  article--billboard-big">
                        <div>
                            <div class="rsImg"><?php echo $image[0] ?></div>
                        </div>
                        <a href="<?php the_permalink(); ?>">
                            <div class="article__header  article--billboard__header">
                                <span class="billboard__category"><?php _e('Featured', wpgrade::textdomain()); ?></span>
                                <h2 class="article__title article--billboard__title">
                                    <span class="hN"><?php the_title(); ?></span>
                                </h2>
                                <span class="small-link read-more-label"><?php echo $read_more_label; ?> &raquo;</span>
                            </div>
                        </a>
                    </article>

            <?php else :

                if ($index++ % 3 == 0):
                $image = $image_big;
                if (isset($image[1]) && isset($image[2]) && $image[1] > 0) {
                  $image_ratio = $image[2] * 100/$image[1];
                }

                if (!$closed_group):
                    echo '</div><div class="billboard--article-group">';
                else:
                    echo '<div class="billboard--article-group">';
                    $closed_group = false;
                endif; ?>
                    <article class="article  article--billboard">
                        <div>
                            <div class="rsImg"><?php echo $image[0] ?></div>
                        </div>
                        <a href="<?php the_permalink(); ?>">
                            <div class="article__header  article--billboard__header">
                                <span class="billboard__category"><?php _e('Featured', wpgrade::textdomain()); ?></span>
                                <h2 class="article__title article--billboard__title">
                                    <span class="hN"><?php the_title(); ?></span>
                                </h2>
                                <span class="small-link read-more-label"><?php echo $read_more_label; ?> &raquo;</span>
                            </div>
                        </a>
                    </article>
                <?php else: /* for this: if ($index++ % 3 == 0): */?>
                    <article class="rsABlock  article article--billboard-small"
                              data-move-effect="right"
                              data-speed="400" 
                              data-easing="easeOutCirc"
                              
                              <?php //Second Slide
                              if ($index % 3 == 2) { ?>
                              data-delay="350" 
                              data-move-offset="170"
                              <?php //Third Slide
                              } else { ?>
                              data-delay="300" 
                              data-move-offset="100"
                              <?php } ?>
                              >
                        
                        <a href="<?php the_permalink(); ?>">
                            <div class="article__thumb">
                                <img src="<?php echo $image[0] ?>" data-src-big="<?php echo $image_big[0] ?>" alt="<?php the_title(); ?>" />
                            </div>
                            <div class="article__content">
                                <h2 class="article__title article--billboard-small__title">
                                    <span class="hN"><?php the_title(); ?></span>
                                </h2>
                                <span class="article__description">
                                    <?php  echo substr(get_the_excerpt(), 0, 75).'..'; ?>
                                </span>
                                <span class="small-link"><?php _e('Read More', wpgrade::textdomain()); ?><em>+</em></span>
                            </div> 
                        </a>
                    </article>
                <?php endif; /* if ($index++ % 3 == 0): */
            endif;
		endwhile;
		wp_reset_postdata();
        if (!$closed_group):
            echo '</div>';
            $closed_group = false;
        endif; ?>
	</div>
<?php endif;