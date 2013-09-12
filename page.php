<?php get_header(); ?>

	<?php if (have_posts()): ?>

		<?php get_template_part('theme-partials/posts', 'page'); ?>

	<?php else: # no posts ?>
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
	<?php endif; ?>

<?php get_footer(); ?>
