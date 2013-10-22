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
					'top_menu' => __('Top Menu', wpgrade::textdomain()),
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
			$args = array
				(
					'theme_location'  => 'main_menu',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'site-navigation site-navigation--header site-navigation--main',
                    'menu_id'         => '',
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'          => new WPGrade_Walker_Nav_Menu()
                );

            wp_nav_menu($args);
        }
    }

    function wpgrade_top_nav() {
        $theme_locations = get_nav_menu_locations();

        if (isset($theme_locations["top_menu"]) && ($theme_locations["top_menu"] != 0)) {
            $args = array
                (
                    'theme_location'  => 'top_menu',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'site-navigation site-navigation--top site-navigation--main flush--bottom',
                    'fallback_cb'     => 'wp_page_menu',
                    'menu_id'         => '',
                    'walker'          => new WPGrade_Walker_Nav_Menu()
                );

            wp_nav_menu($args);
		}
	}
