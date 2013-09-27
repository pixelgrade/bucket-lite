<?php

	/*
	 * Register custom menus.
	 * This works on 3.1+
	 */
	function wpgrade_register_custom_menus() {
		wpgrade::options()->set
			(
				'nav_menus',
				array
				(
					// main nav in header
					'main_menu' => __('Header Menu', wpgrade::textdomain()),
				)
			);

		add_theme_support('menus');

		foreach (wpgrade::option('nav_menus') as $key => $value) {
			register_nav_menu($key, wpgrade::themename().' '.$value);
		}
	}

	add_action("after_setup_theme", "wpgrade_register_custom_menus");

	function wpgrade_main_nav() {
		// test if there are menu locations to prevent errors
		$theme_locations = get_nav_menu_locations();

		if (isset($theme_locations["main_menu"]) && ($theme_locations["main_menu"] != 0)) {
			$defaults = array
				(
					'theme_location'  => 'main_menu',
					'menu'            => '',
					'container'       => 'nav',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'site-navigation site-navigation--main',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => new WPGrade_Lens_Walker_Nav_Menu()
				);

			$menu = wp_nav_menu($defaults);
			echo $menu;
		}
	}

	function wpgrade_footer_nav() {
		$theme_locations = get_nav_menu_locations();

		if (isset($theme_locations["footer_menu"]) && ($theme_locations["footer_menu"] != 0)) {
			$menu = wp_nav_menu
				(
					array
					(
						'theme_location' => 'footer_menu',
						'container'      => 'div',
						'container_id'   => 'menu-main-navigation',
						'depth'          => 1,
						'echo'           => false
					)
				);

			echo $menu;
		}
	}
