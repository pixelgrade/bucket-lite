<?php get_header(); ?>

	<?php if (have_posts()): ?>
		<?php get_template_part('theme-partials/posts', 'single-portfolio'); ?>
	<?php else: # no posts ?>
		<?php # empty ?>
	<?php endif; ?>

<?php get_footer(); ?>
