<?php 
/*
Template Name: Sidebar Right
*/

get_header();
if (have_posts()): while (have_posts()): the_post();

	$header_height = absint(wpgrade::option('nocontent_header_height'));
	$height = '';
	if ($header_height && empty($html_title)) {
		$height = 'data-height="'.$header_height.'"';
	}

	if (has_post_thumbnail()) {
		$featured_id = get_post_thumbnail_id();
		$featured_image = wp_get_attachment_image_src($featured_id, 'full');
		if (empty($height) && empty($html_title)) {
			$height = 'data-width="'. $featured_image[1] .'" data-height="'. $featured_image[2] .'"';
		} ?>
	<div class="wrapper-featured-image">
		<div class="parallax-container" <?php echo $height ?>>
			<div class="parallax-item">
				<?php if (!empty($html_title)) { ?>
					<div class="featured-image-container">
						<div class="featured-image-container-wrapper content-bigger s-inverse">
							<div class="container">
								<?php wpgrade::display_content($html_title ); ?>
							</div>
						</div>
					</div>
				<?php }
				echo '<img src="'.$featured_image[0].'" class="featured-image" data-imgwidth="'.$featured_image[1].'" data-imgheight="'.$featured_image[2].'">' ?>
			</div>
		</div>
	</div>
	<?php } elseif (!empty($html_title)) { ?>
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
	<?php } else {
		echo '<div class="wrapper-featured-image no-image"></div>';
	} ?>
	<div class="row wrapper-content">
		<div class="main main-content" role="main">
			<div class="block-inner block-inner_first">
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/Article">
					<?php $hide_title = get_post_meta(get_the_ID(), wpgrade::prefix().'page_display_title', true);
						if ( $hide_title != "on" ):  ?>
					<h1 class="entry-title single-title" itemprop="name"><?php echo get_the_title(); ?></h1>
					<?php endif; ?>
					<div class="entry-content">
						<?php the_content();
						wp_link_pages(); ?>
					</div>

					<?php comments_template(); ?>
				</article>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php endwhile;
else: ?>
	<div class="row wrapper-content">
		<div class="main main-content" role="main">
			<div class="block-inner block-inner_first">
				<article id="post-not-found" class="hentry clearfix">
					<header class="article-header">
						<h1><?php _e("Oops, Page Not Found!", wpgrade::textdomain()); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e("Uh Oh. Something is missing. Try double checking things.", wpgrade::textdomain()); ?></p>
					</section>
					<footer class="article-footer">
						<p><?php _e("This is the error message in the page.php template.", wpgrade::textdomain()); ?></p>
					</footer>
				</article>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php endif;
get_footer(); ?>