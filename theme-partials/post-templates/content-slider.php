<?php
global $showed_posts_ids;
/**
 * Fields available:
 * @posts_source select (featured / latest / latest_by_cat / latest_by_format / latest_by_reviews)
 * @number_of_posts number
 * @read_more_label string
 */

$number_of_posts = 999;
$read_more_label = 'Read More';
if ( empty($read_more_label) ) {
	$read_more_label = esc_html__('Read Full Story', 'bucket-lite');
}

$query_args = array(
	'posts_per_page' => $number_of_posts,
	'ignore_sticky_posts' => true,
    'meta_query' => array(
	    'relation' => 'AND',
	    array(
		    'key' => wpgrade::prefix() . 'featured_post',
		    'value' => 'on',
		    'compare' => '='
	    )
    )
);


if (get_post_meta(wpgrade::lang_post_id( get_the_ID() ), '_bucket_prevent_duplicate_posts', true) == 'on') {
	//exclude the already showed posts from the current block loop
	if (!empty($showed_posts_ids)) {
		$query_args['post__not_in'] = $showed_posts_ids;
	}
}

$posts_source = 'featured';

$slider_transition = 'fade';

$slider_height = 625;

$slides = new WP_Query( $query_args );
$index = 0;
$closed_group = true;

if ($slides->have_posts()): ?>
	<div class="billboard pixslider js-pixslider arrows--outside"
	     data-arrows="true"
	     data-autoScaleSliderWidth="1050"
	     data-autoScaleSliderHeight="<?php echo $slider_height; ?>"
	     data-slidertransition="<?php echo $slider_transition; ?>"
	>
		<?php while($slides->have_posts()): $slides->the_post();

			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-big');
			if ( ! empty( $image ) ) {
				//Let's remember the post id
				$showed_posts_ids[] = wpgrade::lang_post_id(get_the_ID());

				$image_ratio = bucket::get_image_aspect_ratio( $image );


					if ( $index ++ % 3 == 0 ):

						if ( isset( $image[1] ) && isset( $image[2] ) && $image[1] > 0 ) {
							$image_ratio = $image[2] * 100 / $image[1];
						}

						if ( ! $closed_group ):
							echo '</div><div class="billboard--article-group">';
						else:
							echo '<div class="billboard--article-group">';
							$closed_group = false;
						endif; ?>
						<article class="article  article--billboard">

							<div>
								<div class="rsImg"><?php echo $image[0]; ?></div>
							</div>

							<a href="<?php the_permalink(); ?>">
								<div class="article__header  article--billboard__header">
									<span class="billboard__category"><?php esc_html_e( 'Featured', 'bucket-lite' ); ?></span>
									<h2 class="article__title article--billboard__title">
										<span class="hN"><?php the_title(); ?></span>
									</h2>
									<span class="small-link read-more-label"><?php echo $read_more_label; ?> &raquo;</span>
								</div>
							</a>
						</article>
					<?php else: /* for this: if ($index++ % 3 == 0): */ ?>
						<article class="rsABlock  article article--billboard-small"
						         data-move-effect="right"
						         data-speed="400"
						         data-easing="easeOutCirc"

							<?php //Second Slide
							if ( $index % 3 == 2 ) { ?>
								data-delay="350"
								data-move-offset="170"
								<?php //Third Slide
							} else { ?>
								data-delay="300"
								data-move-offset="100"
							<?php } ?>
						>
							<?php
							$image_post_small = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-small' );
							$image_post_big   = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-big' );
							?>
							<a href="<?php the_permalink(); ?>">
								<div class="article__thumb">
									<img class="riloadr-slider" data-src-big="<?php echo $image_post_big[0]; ?>"
									     data-src-small="<?php echo $image_post_small[0]; ?>" alt="img"/>
								</div>
								<div class="article__content">
									<h2 class="article__title article--billboard-small__title">
										<span class="hN"><?php the_title(); ?></span>
									</h2>
									<span class="article__description">
                                    <?php
                                    //we need to differentiate here for mb strings
                                    if ( wpgrade_contains_any_multibyte( get_the_excerpt() ) ) {
	                                    echo short_text( get_the_excerpt(), 50, 55 );
                                    } else {
	                                    echo short_text( get_the_excerpt(), 75, 80 );
                                    }
                                    ?>
                                </span>
									<span class="small-link"><?php esc_html_e( 'Read More', 'bucket-lite' ); ?><em>+</em></span>
								</div>
							</a>
						</article>
					<?php endif; /* if ($index++ % 3 == 0): */
			}
		endwhile;
		wp_reset_postdata();
		if (!$closed_group):
			echo '</div>';
			$closed_group = false;
		endif; ?>
	</div>
<?php endif;
