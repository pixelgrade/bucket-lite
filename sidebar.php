<?php if ( function_exists('dynamic_sidebar')): ?>

	<?php
		$posttype = get_post_type($post);
	?>

	<?php if (is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() || is_search()): ?>
		<?php if (is_active_sidebar('sidebar1')): ?>
			<div id="sidebar1" class="side side-content sidebar widget-area unwrap" role="complementary">
				<div class="block-inner block-inner_last">
					<?php dynamic_sidebar('sidebar1'); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<?php if (is_page() && is_active_sidebar('pagesidebar')): ?>
			<div id="pagesidebar" class="side side-content sidebar widget-area" role="complementary">
				<div class="block-inner block-inner_last">
					<?php dynamic_sidebar( 'pagesidebar' ); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>

<?php endif; ?>