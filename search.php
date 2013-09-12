<?php get_header(); ?>

<?php 

$html_title = '<h1 class="archive-title">'.__( 'Search Results:', wpgrade::textdomain() ).'</h1>';

if (wpgrade::option('blog_header_image')) {
	$featured_id = wpgrade_get_attachment_id_from_src( wpgrade::option('blog_header_image' ) );
	$featured_image = wp_get_attachment_image_src($featured_id, 'full');
?>
	<div class="wrapper-featured-image">
    <div class="parallax-container" <?php echo $height ?>>
      <?php echo '<div class="parallax-item header-image" style="background-image: url('.$featured_image[0].');"></div>'; ?>
    </div>
		<div class="page-header s-inverse">
	      <div class="page-header-wrapper">
	        <div class="container">
				<?php if (!empty($html_title)) {
				    wpgrade::display_content($html_title);
				} ?>
	        </div>
	      </div>
		</div>
	</div>
<?php } elseif (!empty($html_title)) { //we still need to display the title and description ?>
	<div class="wrapper-featured-image">
			<div class="featured-image-container-wrapper s-inverse">
				<div class="page-header">
					<div class="container">
						<?php wpgrade::display_content($html_title ); ?>
					</div>
				</div>
			</div>
	</div>
<?php } else {
	echo '<div class="wrapper-featured-image no-image"></div>';
} ?>
<div class="wrapper">
	<div class="container container-content">
		<div class="main main-content <?php //if (wpgrade::option('blog_archive_template') == 'l-sidebar-left') echo 'push4' ?>" role="main">
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
			    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if (get_post_format() != 'quote'): ?>
					<div class="content-wrap content-wrap-header">
						<header class="entry-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', wpgrade::textdomain() ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						</header>
						<div class="post-footer">
							<footer class="post-footer_meta">
								<div class="post-footer_meta-group">
									<h5 class="post-footer_meta-name"><?php echo __('Posted on', wpgrade::textdomain()); ?></h5>
									<div class="post-footer_meta-value">
										<?php wpgrade_posted_on(); ?>
									</div>
								</div>
							</footer>
						</div>
					</div>
					<?php endif; ?>
			        <?php get_template_part('theme-partials/post-templates/blog-head', get_post_format()); ?>
			        <?php if (get_post_format() != 'quote'): ?>
			            <div class="content-wrap">
			                <div class="entry-content">
			                    <?php echo wpgrade_better_excerpt(get_the_content()); ?>
			                </div><!-- .entry-content -->
			            </div>
			        <?php endif; ?>
			    </article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; ?>
			    <?php wp_reset_postdata(); ?>
			    <div class="content-wrap">
			        <?php wpgrade::pagination(); ?>
			    </div>
			<?php else:
				get_template_part( 'no-results', 'index' );
			endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
	wp_enqueue_script( 'isotope' );
	get_footer();
?>