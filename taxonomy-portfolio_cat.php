<?php
/**
 * The template for displaying Archive Portfolio Categories.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpGrade
 * @since wpGrade 1.0
 */

get_header();
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

if (wpgrade::option('portfolio_header_image')) {
	$featured_id = wpgrade_get_attachment_id_from_src( wpgrade::option('portfolio_header_image' ) );
	$featured_image = wp_get_attachment_image_src($featured_id, 'full');
	if (empty($height) && empty($html_title)) {
		$height = 'data-width="'. $featured_image[1] .'" data-height="'. $featured_image[2] .'"';
	} ?>
	<div class="wrapper-featured-image">
		<div class="parallax-container" <?php echo $height ?>>
		  <?php echo '<div class="parallax-item header-image" style="background-image: url('.$featured_image[0].');"></div>'; ?>
		</div>
		<div class="page-header content-bigger s-inverse">
			<div class="page-header-wrapper">
				<div class="container">
					<?php if (!empty($html_title)) { ?>
						<?php wpgrade::display_content($html_title ); ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } elseif (!empty($html_title)) { ?>
	<div class="wrapper-featured-image">
		<div class="featured-image-container" style="background-color: <?php echo wpgrade::option('portfolio_header_bg_color'); ?>">
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
	<div class="wrapper wrapper-main">
		<div class="container">
			<div class="main main-page">
				<div class="portfolio-container">
					<ul class="portfolio-items-list portfolio-items-list-full-width" id="portpage-portfolio-items-list">
						<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							$categories = get_the_terms($post->ID, 'portfolio_cat'); ?>

							<li class="portfolio-item <?php foreach($categories as $cat) { echo strtolower($cat->name) . ' '; }?>">
								<a class="portfolio-item-link" href="<?php the_permalink(); ?>">
									<div class="portfolio-item-featured-image">
										<?php the_post_thumbnail('homepage-portfolio'); ?>
									</div>
									<div class="portfolio-item-info">
										<div class="portfolio-item-table">
											<div class="portfolio-item-cell">
												<h3 class="portfolio-item-title"><?php echo get_the_title(); ?></h3>
												<hr class="separator light">
												<ul class="portfolio-item-categories-list">
													<?php foreach($categories as $cat){ ?>
														<li class="portfolio-item-category">
															<span class="portfolio-item-category-link"><?php echo $cat->name; ?></span>
														</li>
													<?php } ?>
												</ul>
											</div>
										</div>
									</div>
								</a>
							</li>
						<?php
						endwhile; endif;
						/* Restore original Post Data */
						wp_reset_postdata();
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>