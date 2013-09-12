<?php

	// Translation template cache
	// --------------------------

	// it makes sense to do this since we're in a loop which may extend for
	// several posts; we also gain a readability benefit
	$permalink_tr = __('Permalink to :title', wpgrade::textdomain());
	$published_tr = __('Published', wpgrade::textdomain());
?>

<?php while (have_posts()): the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php # QUOTE ?>
		<?php if (get_post_format() != 'quote'): ?>
			<div class="content-wrap content-wrap-header">
				<header class="entry-header">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"
						   title="<?php echo esc_attr(strtr($permalink_tr, array(':title' => the_title_attribute('echo=0')))); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
				</header>
				<div class="post-footer">
					<footer class="post-footer_meta">
						<div class="post-footer_meta-group">
							<h5 class="post-footer_meta-name">
								<?php echo $published_tr ?>
							</h5>
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
				</div>
			</div>
		<?php endif; ?>

	</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; ?>
