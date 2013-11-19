<?php

$post_args = array( 
		'numberposts' => -1,
		'offset'=> 0,
		'post_type'     => 'post',
		'post_status'   => 'publish',
	);
$post_args['category'] = get_query_var('cat');

$post_args['meta_query'] = 
	array(
		array(
			'key' => wpgrade::prefix() . 'category_slide',
			'value' => 'on'
		)
	);

$slideposts = get_posts( $post_args );

$slider_transition = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_transition', true);
$slider_autoplay = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_autoplay', true);
if ($slider_autoplay) {
	$slider_delay = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_delay', true);
}

$slider_height = '400';

//hold the post slides ids so we exclude them from the rest of the posts
$slideposts_ids = array();

if (count($slideposts)): ?>
<div class="category__featured-posts">
	<div class="pixslider js-pixslider"
		data-arrows
		data-fullscreen
		data-imagealigncenter
		data-autoscalesliderwidth="692"
		data-autoscalesliderheight="<?php echo $slider_height; ?>"
		data-imagescale="fill"
		data-slidertransition="<?php echo $slider_transition; ?>"
		<?php if ($slider_autoplay) {
			echo 'data-sliderautoplay="" ';
			echo 'data-sliderdelay='. $slider_delay;
		} ?> >
		<?php
		foreach( $slideposts as $post ) : setup_postdata( $post );
			//add the id to the array
            $slideposts_ids[] = $post->ID;
			
			$post_title = get_the_title();
			$post_link = get_permalink();
			$thumb_id = get_post_thumbnail_id( $post->ID );
			$thumb_img = wp_get_attachment_image_src( $thumb_id, "post-big" );			
			?>
			<article class="featured-area__article article--big">
				<a href="<?php echo $post_link; ?>" class="image-wrap">
					<div class="gallery__item" itemscope itemtype="http://schema.org/ImageObject" >
						<img src="<?php echo $thumb_img[0]; ?>" class="attachment-blog-big  rsImg  invisible" alt="" itemprop="contentURL" />
					</div>
					<div class="article__title">
						 <h2 class="hN"><?php echo $post_title; ?></h2>
					</div>
				</a>
            </article>
		<?php 
		endforeach; 
		wp_reset_query(); ?>
	</div>
</div>
<?php endif; ?>