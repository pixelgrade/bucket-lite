<?php

	function wpgrade_portfolio_remove_parent_classes($class) {
		// check for current page classes, return false if they exist.
		return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;
	}

	function wpgrade_callback_add_current_nav_class_for_portfolio($classes, $item ) {
		// Necessary, otherwise we can't get current post ID
		global $post;

		//get the Portfolio url just to know when the menu item is the same
		$portfolio_url = get_portfolio_page_link();

		//test if the current post is of type portfolio and that the menu item has the link to the portfolio archive
		if (isset($post->post_type) && $post->post_type == 'portfolio') {
			$classes = array_filter($classes, "wpgrade_portfolio_remove_parent_classes");
			if ($item->url == $portfolio_url) {
				 $classes[] = 'current_page_parent current-menu-item';
			}
			else if ($item->url == get_permalink ($post->id)) {
				 $classes[] = 'current-menu-item';
			}
		}

		// return the corrected set of classes to be added to the menu item
		return $classes;
	}

	// make sure that the portfolio menu items have the correct classes when on single projects
	add_action('nav_menu_css_class', 'wpgrade_callback_add_current_nav_class_for_portfolio', 10, 2);