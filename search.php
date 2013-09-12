<?php
	$html_title =
		'
			<h1 class="archive-title">'
				.__( 'Search Results:', wpgrade::textdomain() ).'
			</h1>
		';

	wp_enqueue_script('isotope');
?>

<?php get_header(); ?>

	<?php #### Page Header ################################################## ?>

	<?php if (wpgrade::option('blog_header_image')): ?>

		<?php
			$featured_id = wpgrade_get_attachment_id_from_src( wpgrade::option('blog_header_image' ) );
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
						<?php if ( ! empty($html_title)): ?>
							<?php wpgrade::display_content($html_title); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php elseif ( ! empty($html_title)): ?>
		<div class="wrapper-featured-image">
			<div class="featured-image-container-wrapper s-inverse">
				<div class="page-header">
					<div class="container">
						<?php wpgrade::display_content($html_title ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php else: # empty html_title  ?>
		<div class="wrapper-featured-image no-image"></div>
	<?php endif; ?>


	<?php #### Page Content ################################################# ?>

	<div class="wrapper">
		<div class="container container-content">

			<div class="main main-content" role="main">
				<?php if (have_posts()): ?>

					<?php get_template_part('theme-partials/posts', 'search'); ?>

					<?php wp_reset_postdata(); ?>

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