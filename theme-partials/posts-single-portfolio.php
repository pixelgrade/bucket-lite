<?php while (have_posts()) : the_post(); ?>

	<?php
		$html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'project_html_title', true);
		$header_height = absint(wpgrade::option('nocontent_header_height'));
		$height = '';
		if ($header_height && empty($html_title)) {
			$height = 'data-height="'.$header_height.'"';
		}
	?>

	<?php if (has_post_thumbnail()): ?>

		<?php
			$featured_id = get_post_thumbnail_id();
			$featured_image = wp_get_attachment_image_src($featured_id, 'full');
			if (empty($height) && empty($html_title)) {
				$height = 'data-width="'. $featured_image[1] .'" data-height="'. $featured_image[2] .'"';
			}
		?>

		<div class="wrapper-featured-image">
			<div class="parallax-container" <?php echo $height ?>>
				<?php echo '<div class="parallax-item header-image" style="background-image: url('.$featured_image[0].');"></div>'; ?>
			</div>
			<div class="page-header content-bigger s-inverse">
				<?php if (!empty($html_title)) { ?>
					<?php wpgrade::display_content($html_title ); ?>
				<?php } ?>
			</div>
		</div>

	<?php elseif ( ! empty($html_title)): ?>
		<div class="wrapper-featured-image">
			<div class="featured-image-container" style="background-color: <?php echo get_post_meta(get_the_ID(), wpgrade::prefix().'header_background_color', true); ?>">
				<div class="featured-image-container-wrapper content-bigger s-inverse">
					<div class="page-header-wrapper">
						<?php wpgrade::display_content($html_title ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php else: # empty html_title ?>
		<div class="wrapper-featured-image no-image"></div>
	<?php endif; ?>

	<div class="wrapper wrapper-main">
		<div class="container">
			<div class="main main-page" role="main">

				<div class="project-control-container">
					<?php wpgrade_content_nav('single-nav');?>
				</div>

				<article id="post-<?php the_ID(); ?>"
						 <?php post_class('clearfix content-wrap'); ?>
						 role="article"
						 itemscope itemtype="http://schema.org/Article">

					<h1 class="project-title">
						<?php echo get_the_title(); ?>
					</h1>

					<div class="row">
						<?php
							$attachments = get_posts
								(
									array
									(
										'post_type' => 'attachment',
										'posts_per_page' => -1,
										'post_parent' => $post->ID,
										'exclude'     => get_post_thumbnail_id()
									)
								);
						?>

						<?php if ($attachments): ?>
							<div class="project-images-container flexslider">
								<ul class="project-images-list slides">

									<?php foreach ($attachments as $attachment): ?>

										<?php
											$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
											$thumbimg = wp_get_attachment_image_src( $attachment->ID, 'thumbnail-size', true );
										?>

										<li class="<?php echo $class ?> data-design-thumbnail">
											<img alt="" src="<?php echo $thumbimg[0] ?>"/>
										</li>

									<?php endforeach; ?>

								</ul>
							</div>
						<?php endif ?>

						<div class="project-entry-content <?php if ($attachments) echo 'lap-span4'; ?>">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</div>
					</div>

				</article>
			</div>
		</div>
	</div>

<?php endwhile; ?>