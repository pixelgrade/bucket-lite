<?php while (have_posts()): the_post(); ?>

	<?php
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
				<div class="parallax-item">
					<?php if ( ! empty($html_title)): ?>
						<div class="featured-image-container">
							<div class="featured-image-container-wrapper content-bigger s-inverse">
								<div class="container">
									<?php wpgrade::display_content($html_title ); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<img src="<?php echo $featured_image[0] ?>"
						 class="featured-image"
						 data-imgwidth="'.$featured_image[1].'"
						 data-imgheight="<?php echo $featured_image[2] ?>"/>

				</div>
			</div>
		</div>

	<?php elseif ( ! empty($html_title)): ?>
		<div class="wrapper-featured-image">
			<div class="featured-image-container" style="background-color: <?php echo get_post_meta(get_the_ID(), wpgrade::prefix().'header_background_color', true); ?>">
				<div class="featured-image-container-wrapper content-bigger s-inverse">
					<div class="page-header-wrapper">
						<div class="container">
							<?php wpgrade::display_content($html_title ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php else: # empty html_title ?>
		<div class="wrapper-featured-image no-image"></div>
	<?php endif; ?>

	<div class="row wrapper-content">
		<div class="main main-content" role="main">
			<div class="block-inner block-inner_first">
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/Article">

					<?php $hide_title = get_post_meta(get_the_ID(), wpgrade::prefix().'page_display_title', true); ?>

					<?php if ($hide_title != "on"): ?>
						<h1 class="entry-title single-title" itemprop="name">
							<?php echo get_the_title(); ?>
						</h1>
					<?php endif; ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					</div>

					<?php comments_template(); ?>

				</article>
			</div>
		</div>

		<?php get_sidebar(); ?>
	</div>

<?php endwhile; ?>