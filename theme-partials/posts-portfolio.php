<?php while (have_posts()) : the_post(); ?>

	<?php
		$html_title = wpgrade::option('portfolio_title');

		$header_height = absint(wpgrade::option('nocontent_header_height'));
		$height = '';
		// if ($header_height && empty($html_title)) {
		if ($header_height) {
		  $height = 'data-height="'.$header_height.'"';
		}
	?>

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
						<?php endif; ?>
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

	<div class="wrapper wrapper-main">
		<div class="container">
			<div class="main main-page">
				<div class="portfolio-container">

					<div class="filter-container">
						<h2 class="featuredworks-title">
							<?php _e('Filter projects by', wpgrade::textdomain()); ?>
						</h2>
						<div class="filter-by-container">
							<a href="#" class="filter-by-toggle">
								<span class="filter-by-text">
									<?php _e( 'Show All', wpgrade::textdomain() ); ?>
								</span>
								<i class="icon-chevron-down"></i>
							</a>
							<ul class="filter-by_list">

								<li class="filter-by_list-item">
									<a href="<?php echo get_post_type_archive_link('portfolio') ?>"
									   data-filter="*"
									   title="<?php _e('View all projects',wpgrade::textdomain()) ?>">

										   <?php _e('Show All', wpgrade::textdomain()); ?>

									</a>
								</li>

								<?php $terms = get_terms(array('portfolio_cat')); ?>
								<?php foreach ($terms as $term): ?>
									<li class="filter-by_list-item">
										<a class="filter-by_link"
										   data-filter="<?php echo '.'.$term->slug; ?>"
										   href="<?php echo get_term_link($term) ?>"
										   title="<?php sprintf( __( "View all projects in %s" ,wpgrade::textdomain() ), $term->name ); ?>">

											<?php echo $term->name ?>
										</a>
									</li>
								<?php endforeach; ?>

							</ul>
						</div>
					</div>

					<ul class="portfolio-items-list portfolio-items-list-full-width"
						id="portpage-portfolio-items-list">

						<?php get_template_part('theme-partials/posts', 'portfolio-item'); ?>

					</ul>
				</div>
			</div>
		</div>
	</div>

<?php endwhile; ?>