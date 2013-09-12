<?php

	#
	# This file also acts as home.php
	#

	// Calcualte Title & Description
	// -----------------------------

	$html_header = '';
	if (is_category()) {
		// translate title
		$translated_title = strtr
			(
				__('Category Archives: :title', wpgrade::textdomain()),
				array
				(
					':title' => '<span>'.single_cat_title('', false).'</span>'
				)
			);

		$html_header = '<h1 class="archive-title">'.$translated_title.'</h1>';

		// show description if available
		if (category_description()) {
			$html_header .= '<div class="archive-meta">'.category_description().'</div>';
		}
	}
	elseif (is_tag()) {
		// translate title
		$translated_title = strtr
			(
				__('Tag Archives: :title', wpgrade::textdomain()),
				array
				(
					':title' => '<span>'.single_tag_title('', false).'</span>'
				)
			);

		$html_header = '<h1 class="archive-title">'.$translated_title.'</h1>';

		// show description if available
		if (tag_description()) {
			$html_header .= '<div class="archive-meta">'.tag_description().'</div>';
		}
	}
	else { // ! is_tag() && ! is_category()
		if (wpgrade::option('blog_archive_title')) {
			$html_header = '<h1 class="archive-title">'.wpgrade::option('blog_archive_title').'</h1>';
		}
	}

	// Calculate Paralax Height
	// ------------------------

	$height = '';
	$header_height = absint(wpgrade::option('nocontent_header_height'));

	if ($header_height) {
		$height = 'data-height="'.$header_height.'"';
	}
?>

<?php get_header(); ?>

	<?php #### Page Header ################################################## ?>

	<?php if (wpgrade::option('blog_header_image')): ?>
		<?php
			$featured_id = wpgrade_get_attachment_id_from_src(wpgrade::option('blog_header_image'));
			$featured_image = wp_get_attachment_image_src($featured_id, 'full');
		?>
		<div class="wrapper-featured-image">
			<div class="parallax-container" <?php echo $height ?>>
				<div class="parallax-item header-image"
					 style="background-image: url(<?php echo $featured_image[0] ?>);">
				</div>
			</div>
			<div class="page-header s-inverse">
				<div class="page-header-wrapper">
					<div class="container">
						<?php if (!empty($html_header)): ?>
							<?php wpgrade::display_content($html_header) ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php elseif ( ! empty($html_header)): ?>
		<?php // we still need to display the title and description ?>
		<div class="wrapper-featured-image">
			<div class="featured-image-container-wrapper s-inverse">
				<div class="page-header">
					<div class="container">
						<?php wpgrade::display_content($html_header ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php else: # html_header is empty ?>
		<div class="wrapper-featured-image no-image"></div>
	<?php endif; ?>


	<?php #### Page Content ################################################# ?>

	<div class="wrapper">
		<div class="container container-content">
			<div class="main main-content main-content-archive" role="main">

				<div class="content-wrap">
					<?php wpgrade::pagination(); ?>
				</div>

				<?php if (have_posts()): ?>

					<?php get_template_part('theme-partials/posts', 'index'); ?>

					<?php wp_reset_postdata(); # restore original Post Data ?>

					<div class="content-wrap">
						<?php wpgrade::pagination(); ?>
					</div>

				<?php else: # no posts ?>
					<?php get_template_part('no-results', 'index'); ?>
				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
