<?php get_header(); ?>

	<?php if (have_posts()): ?>
		<?php get_template_part('theme-partials/posts', 'single'); ?>
	<?php else: # no posts ?>
		<div class="row">
			<div class="main main-content" role="main">
				<div class="block-inner block-inner_first">
					<article id="post-not-found" class="hentry clearfix">
						<header class="article-header">
							<h1><?php _e("Oops, Post Not Found!", wpgrade::textdomain()); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e("Uh Oh. Something is missing. Try double checking things.", wpgrade::textdomain()); ?></p>
						</section>
						<footer class="article-footer">
							<p><?php _e("This is the error message in the single.php template.", wpgrade::textdomain()); ?></p>
						</footer>
					</article>
				</div>
			</div>

			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>

<?php get_footer(); ?>
