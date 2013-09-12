<?php
	$hps_query = new WP_Query
		(
			array
			(
				'post_type' => 'homepage_slide',
				'posts_per_page' => '-1',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			)
		);

	$slider_params = '';
	$slider_speed = wpgrade::option('homepage_slider_speed');
	if ( $slider_speed ) {
		$slider_params .= ' data-slideshow_speed="'. $slider_speed .'"';
	}

	if ( wpgrade::option('homepage_slider_animation_speed') ) {
		$slider_params .= ' data-animation_speed="'. wpgrade::option('homepage_slider_animation_speed') .'"';
	}

	if ( wpgrade::option('homepage_slider_fullscreen') ) {
		$slider_params .= ' data-fullscreen="'. wpgrade::option('homepage_slider_fullscreen') .'"';
	}

	if ( wpgrade::option('homepage_slider_height') ) {
		$slider_params .= ' data-height="'. wpgrade::option('homepage_slider_height') .'"';
	}

	if ( wpgrade::option('homepage_slider_directionnav') ) {
		$slider_params .= ' data-direction_nav="true"';
	} else{
		$slider_params .= ' data-direction_nav="false"';
	}

	if ( wpgrade::option('homepage_slider_directionnav_thumb') ) {
		$slider_params .= ' data-control_nav_thumb="false"';
	} else{
		$slider_params .= ' data-control_nav_thumb="true"';
	}

	$slider_control_nav_items = '';
	$slide_number = 0;
?>

<?php if ($hps_query->have_posts()): ?>
	<div class="flexslider homepage-slider loading" <?php if ( ! empty($slider_params)): echo $slider_params; endif; ?>>
		<div class="preloader"></div>
		<ul class="slides homepage-slider_slides">

			<?php get_template_part('theme-partials/posts', 'homepage-slides'); ?>

			<?php while ($hps_query->have_posts()): $hps_query->the_post(); ?>
				<li class="slide homepage-slider_slide s-hidden">
					<?php
						$image = get_post_meta(get_the_ID(), wpgrade::prefix().'homepage_slide_image', true);
						$video_poster = get_post_meta(get_the_ID(), wpgrade::prefix().'video_poster', true);
					?>

					<?php if ( ! empty($image)): ?>

						<?php
							$image = json_decode($image);
							$image_id = $image->id;
							$image_thumbnail = wp_get_attachment_image_src($image->id, 'homepage-portfolio');
							$slide_thumbnail = $image_thumbnail[0];
							$slide_background = $slide_thumbnail;
							if ( !empty($video_poster) ) {
								$slide_thumbnail = $video_poster;
							}
						?>

						<div class="homepage-slider_slide-image header-image"
							 style="background-image: url(<?php echo $image->link ?>);"
							 data-thumb="url(<?php echo $slide_thumbnail ?>)">
						</div>

					<?php endif; ?>

					<div class="homepage-slider_slide-wrap bigger-content">

						<?php
							$slider_control_nav_items[$slide_number] = get_the_title();
							$slide_number++;
							$slide_has_video = false;
							$the_video = '';

							$videos = wpgrade_post_videos_ids(get_the_ID());

							isset($videos['youtube']) ? $youtube_id = $videos['youtube'] : $youtube_id = '';
							isset($videos['vimeo']) ? $vimeo_id = $videos['vimeo'] : $vimeo_id = '';

							$video_width = $video_height = '';
							$video_width = get_post_meta(get_the_ID(), wpgrade::prefix().'video_width', true);

							if ( ! empty($video_width)) {
								$video_width = 'width="'.$video_width.'"';
							}

							$video_height = get_post_meta(get_the_ID(), wpgrade::prefix().'video_height', true);

							if ( ! empty($video_height)) {
								$video_height = 'height="'.$video_height.'"';
							}

							if ( ! empty($youtube_id)) {
								$the_video = '<div class="youtube_frame" id="ytplayer_'.get_the_ID().'" data-ytid="'.$youtube_id.'" '.$video_width.' '.$video_height.'></div>';
								$slide_has_video = true;
							} elseif ( ! empty($vimeo_id)) {
								$the_video = '<iframe class="vimeo_frame" id="video_'.get_the_ID().'" '.$video_width.' '.$video_height.' src="http://player.vimeo.com/video/'.$vimeo_id.'?api=1&player_id=video_'.get_the_ID().'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
								$slide_has_video = true;
							} elseif( ! empty( $video_embed)) {
								$slide_has_video = true;
								$the_video = '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
							} else {
								$video_m4v = get_post_meta(get_the_ID(), wpgrade::prefix().'video_m4v', true);
								$video_webm = get_post_meta(get_the_ID(), wpgrade::prefix().'video_webm', true);
								$video_ogv = get_post_meta(get_the_ID(), wpgrade::prefix().'video_ogv', true);

								if ( ! empty($video_m4v) || ! empty($video_webm) || !empty($video_ogv) || ! empty($video_poster) ) {
									$slide_has_video = true;
									ob_start();
									wpGrade_video_selfhosted(get_the_ID());
									$the_video = ob_get_clean();
								}
							}
						?>

						<div class="homepage-slider_slide-content <?php if ( $slide_has_video ) echo 's-video'?>">
							<div class="slide-content-wrapper wrapper">
								<div class="container">
									<?php if ($slide_has_video): ?>
											<div class="page-header-video-wrap">
												<?php echo $the_video ?>
											</div>
											<div class="page-header-videohtml-wrap">
									<?php endif; ?>

										<?php $caption = get_post_meta(get_the_ID(), wpgrade::prefix().'homepage_slide_caption', true); ?>
										<?php if (!empty($caption)): ?>
											<?php wpgrade::display_content($caption); ?>
										<?php endif; ?>

										<?php
											$label = get_post_meta(get_the_ID(), wpgrade::prefix().'homepage_slide_label', true);
											$link = get_post_meta(get_the_ID(), wpgrade::prefix().'homepage_slide_link', true);
										?>

										<?php if ( ! empty($label) && ! empty($link)): ?>
											<div>
												<a href="<?php echo $link ?>" class="btn btn-slider">
													<?php echo $label ?>
												</a>
											</div>
										<?php endif; ?>

									<?php if ($slide_has_video): ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>

		<?php if (wpgrade::option('homepage_slider_directionnav') && $slide_number > 1): ?>
			<ul class="flex-direction-nav">
				<li class="prev">
					<a class="flex-prev" href="#">
						<div class="slide-thumb">
							<div class="slide-thumb-img"></div>
						</div>
						<div class="slide-arrow-container">
							<div class="slide-arrow-bg"></div>
						</div>
					</a>
				</li>
				<li class="next">
					<a class="flex-next" href="#">
						<div class="slide-thumb">
							<div class="slide-thumb-img"></div>
						</div>
						<div class="slide-arrow-container">
							<div class="slide-arrow-bg"></div>
						</div>
					</a>
				</li>
			</ul>
		<?php endif; ?>
	</div>
<?php else: # no posts ?>
	<?php # empty ?>
<?php endif; ?>

<?php wp_reset_query(); ?>
