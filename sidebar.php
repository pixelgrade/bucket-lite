<?php if ( function_exists('dynamic_sidebar')) {
	$post; // @todo CLEANUP find out if this line actually does anything (should not be the case)
	
	$posttype = get_post_type($post);
	
//	$template = '';
//	if (is_single()) {
//		$template = wpgrade::option('blog_single_template');
//	} else {
//		$template = wpgrade::option('blog_archive_template');
//	}
?>

<?php
if( (is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag()) || (is_search()) ) {
	if ( is_active_sidebar( 'sidebar1' ) ) : ?>
	<div id="sidebar1" class="side side-content sidebar widget-area unwrap <?php //echo $template; if ($template == 'l-sidebar-left') echo ' pull8'; ?>" role="complementary">
   		<div class="block-inner block-inner_last"><?php dynamic_sidebar( 'sidebar1' ); ?></div>
	</div>
<?php endif;
} else {
	if ( is_page() && is_active_sidebar( 'pagesidebar' )) : ?>
	<div id="pagesidebar" class="side side-content sidebar widget-area" role="complementary">
   		<div class="block-inner block-inner_last"><?php dynamic_sidebar( 'pagesidebar' ); ?></div>
	</div>
<?php endif;
	}
} ?>