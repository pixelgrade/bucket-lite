<?php
	global $post;

	$this_term = get_queried_object();
	$html_title = '<h2>'. $this_term->name .' <span>projects</span> </h2>';
	$html_title .= '';

	if ( wpgrade::option('portfolio_category_description') ) {
		$html_title .= '<p>'. $this_term->description .'</p>';
	}

	$header_height = absint(wpgrade::option('nocontent_header_height'));
	$height = '';
	// if ($header_height && empty($html_title)) {
	if ($header_height) {
		$height = 'data-height="'.$header_height.'"';
	}
?>

<?php get_header(); ?>

	<?php #### Page Header ################################################## ?>

	<?php if (wpgrade::option('portfolio_header_image')): ?>

		<?php
			$featured_id = wpgrade_get_attachment_id_from_src( wpgrade::option('portfolio_header_image' ) );
			$featured_image = wp_get_attachment_image_src($featured_id, 'full');
			if (empty($height) && empty($html_title)) {
				$height = 'data-width="'. $featured_image[1] .'" data-height="'. $featured_image[2] .'"';
			}
		?>

		<div class="wrapper-featured-image">
			<div class="parallax-container" <?php echo $height ?>>
				<div class="parallax-item header-image"
					 style="background-image: url(<?php echo $featured_image[0] ?>);">
				</div>
			</div>
			<div class="page-header content-bigger s-inverse">
				<div class="page-header-wrapper">
					<div class="container">
						<?php if ( ! empty($html_title)): ?>
							<?php wpgrade::display_content($html_title); ?>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	<?php elseif ( ! empty($html_title)): ?>
		<div class="wrapper-featured-image">
			<div class="featured-image-container"
				 style="background-color: <?php echo wpgrade::option('portfolio_header_bg_color'); ?>">

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

	<?php #### Page Content ################################################# ?>

	<div class="wrapper wrapper-main">
		<div class="container">
			<div class="main main-page">
				<div class="portfolio-container">
					<ul class="portfolio-items-list portfolio-items-list-full-width"
						id="portpage-portfolio-items-list">

						<?php if (have_posts()): ?>
							<?php get_template_part('theme-partials/posts', 'portfolio-cat'); ?>
						<?php else: # no posts ?>
							<?php # empty ?>
						<?php endif; ?>

						<?php wp_reset_postdata(); # restore original Post Data ?>

					</ul>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>