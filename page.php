<?php 
/*
* Page default template
*/

get_header();

if (have_posts()): while (have_posts()): the_post();

	$html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'page_html_title', true);
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
				<?php echo '<div class="parallax-item header-image" style="background-image: url('.$featured_image[0].');"></div>'; ?>
			</div>
			<div class="page-header content-bigger s-inverse">

				<?php if (!empty($html_title)) { ?>
					<div class="container">
						<?php wpgrade::display_content($html_title ); ?>
					</div>
				<?php } ?>

			</div>
		</div>
	<?php } elseif (!empty($html_title)) { ?>
		<div class="wrapper-featured-image"  style="background-color: <?php echo get_post_meta(get_the_ID(), wpgrade::prefix().'header_background_color', true); ?>">
			<div class="featured-image-container">
				<div class="featured-image-container-wrapper content-bigger s-inverse">
					<?php wpgrade::display_content($html_title); ?>
				</div>
			</div>
		</div>
	<?php } else {
		echo '<div class="wrapper-featured-image no-image"></div>';
	} ?>
	<div class="wrapper wrapper-main">
		<div class="container container-content">
			<div class="main main-page" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/Article">
					<?php $hide_title = get_post_meta(get_the_ID(), wpgrade::prefix().'page_display_title', true);
					if ( $hide_title != "on" ):  ?>
						<h1 class="entry-title single-title" itemprop="name"><?php echo get_the_title(); ?></h1>
					<?php endif; ?>
					<div class="entry-content">
						<?php the_content();
						wp_link_pages(); ?>
					</div>

					<?php // if ( comments_open()) { comments_template(); } ?>
				</article>
			</div>
		</div>
	</div>
<?php endwhile;
else: ?>
	<div class="row wrapper wrapper-content">
		<div class="main main-content" role="main">
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
<?php endif;
get_footer(); ?>