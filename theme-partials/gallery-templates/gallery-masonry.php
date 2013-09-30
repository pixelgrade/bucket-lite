<div id="main" class="content djax-updatable">
	<?php
	$gallery_ids = array();
	$gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'main_gallery', true );
	if (!empty($gallery_ids)) {
		$gallery_ids = explode(',',$gallery_ids);
	}

	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'orderby' => "post__in",
		'post__in'     => $gallery_ids
	) );

	$show_gallery_title = get_post_meta( $post->ID, wpgrade::prefix() . 'show_gallery_title', true );

	$has_post_thumbnail = has_post_thumbnail();
	if ($has_post_thumbnail) {
		$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big', true);
		$featured_image = $featured_image[0];
	} 

	$index = 0;
	if ( $attachments ) : ?>
		<div class="mosaic gallery js-gallery">
			<div class="mosaic__item  mosaic__item--page-title-mobile">
				<div class="image__item-link">
					<div class="image__item-wrapper">
					<?php if ($has_post_thumbnail) : ?>
					<img
						class="js-lazy-load"
						src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
						data-src="<?php echo $featured_image; ?>"
						alt=""
						/>
					<?php endif; ?>								
					</div>
					<div class="image__item-meta">
						<div class="image_item-table">
							<div class="image_item-cell">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			foreach ( $attachments as $attachment ) :
				$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
				$img['full'] = wp_get_attachment_image_src($attachment->ID, 'full');
				$img['big'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-big', true);
				$img['medium'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-medium', true);
				$img['small'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-medium', true); ?>
				<div class="mosaic__item">
					<a href="<?php echo $img['full'][0]; ?>" class="image__item-link" title="" data-effect="mfp-zoom-in">
						<div class="image__item-wrapper">
							<img
								class="js-lazy-load"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								data-src="<?php echo $img['big'][0]; ?>"
								data-big="<?php echo $img['big'][0]; ?>"
								data-medium="<?php echo $img['medium'][0]; ?>"
								data-small="<?php echo $img['small'][0]; ?>"
								alt=""
								/>
						</div>
						<div class="image__item-meta">
							<div class="image_item-table">
								<div class="image_item-cell">
									<div class="image__plus-icon">+</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<?php

				// if we added 3 it's now time to add the gallery title box

				if (++$index == 3 && $show_gallery_title) : ?>
					<div class="mosaic__item  mosaic__item--page-title">
						<div class="image__item-link">
							<div class="image__item-wrapper">
							<?php if ($has_post_thumbnail) : ?>
							<img
								class="js-lazy-load"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								data-src="<?php echo $featured_image; ?>"
								alt=""
								/>
							<?php endif; ?>								
							</div>
							<div class="image__item-meta">
								<div class="image_item-table">
									<div class="image_item-cell">
										<h1><?php the_title(); ?></h1>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif;
			endforeach;
			// if there were less than 3, still add the title
			if ($index < 3 && $show_gallery_title) : ?>
				<div class="mosaic__item  mosaic__item--page-title">
					<div class="image__item-link">
						<div class="image__item-wrapper">
							<?php if ($has_post_thumbnail) : ?>
							<img
								class="js-lazy-load"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								data-src="<?php echo $featured_image; ?>"
								alt=""
								/>
							<?php endif; ?>					
						</div>
						<div class="image__item-meta">
							<div class="image_item-table">
								<div class="image_item-cell">
									<h1><?php the_title(); ?></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>