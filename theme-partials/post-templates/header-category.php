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

$image_scale_mode = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_image_scale', true);
$slider_transition = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_transition', true);
$slider_autoplay = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_autoplay', true);
if ($slider_autoplay) {
	$slider_delay = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_delay', true);
}
$slider_height = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_height', true);
if($slider_height == '') $slider_height = '525';

// let's get to know this post a little better
$full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_full_width_featured_image', true);
$disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_disable_sidebar', true);

// let's use what we know
$content_width = $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds';
$featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds  palm-one-whole';

$arrows_class= '';

if($full_width_featured_image == 'on' || $disable_sidebar == 'on') $arrows_class = '  arrows--outside';

//hold the post slides ids so we exclude them from the rest of the posts
$slideposts_ids = array();

if (count($slideposts)): ?>
<div class="grid__item  float--left  <?php echo $featured_image_width; ?>  article__featured-image">
	<div class="pixslider js-pixslider<?php echo $arrows_class; ?>"
		data-arrows
		data-fullscreen
		data-imagealigncenter
		data-autoscalesliderwidth="1050"
		data-autoscalesliderheight="<?php echo $slider_height; ?>"
		data-imagescale="<?php echo $image_scale_mode; ?>"
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
			$thumb_img = wp_get_attachment_image_src( $thumb_id, "blog-big" );
			
			$class = "post-attachment";
			$thumb_fields = get_post_custom( $thumb_id );

			// check if this attachment has a video url
			$video_url = ( isset($thumb_fields['_video_url'][0] ) && !empty( $thumb_fields['_video_url'][0]) ) ? esc_url( $thumb_fields['_video_url'][0] ) : '';

			//  if there is a video let royal slider know about it
			if ( !empty($video_url) ) { ?>
				<div class="gallery__item video">
					<img src="<?php echo $thumb_img[0]; ?>" class="rsImg  invisible" data-rsVideo="<?php echo $video_url; ?>" />
				</div>
			<?php } else { ?>
				<div class="gallery__item" itemscope itemtype="http://schema.org/ImageObject" >
					<img src="<?php echo $thumb_img[0]; ?>" class="attachment-blog-big  rsImg  invisible" alt="" itemprop="contentURL" />
				</div>
			<?php }
		endforeach; 
		wp_reset_query(); ?>
	</div>
</div>
<?php endif; ?>