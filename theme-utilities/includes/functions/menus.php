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
                    'main_menu' => __('Header Menu', wpgrade::textdomain()),
					'top_menu_left' => __('Top Menu Left', wpgrade::textdomain()),
                    'top_menu_right' => __('Top Menu Right', wpgrade::textdomain()),
					'footer_menu' => __('Footer Menu', wpgrade::textdomain()),
				)
			);

		add_theme_support('menus');

		foreach (wpgrade::option('nav_menus') as $key => $value) {
			register_nav_menu($key, wpgrade::themename().' '.$value);
		}
	}

	add_action("after_setup_theme", "wpgrade_register_custom_menus");


    /*
     * Function for displaying The Main Header Menu
     */
	function wpgrade_main_nav() {
		// test if there are menu locations to prevent errors
		$theme_locations = get_nav_menu_locations();

		if (isset($theme_locations["main_menu"]) && ($theme_locations["main_menu"] != 0)) {
			require_once(wpgrade::themefilepath('theme-utilities/includes/WPGrade_Bucket_Walker_Nav_Menu.php'));
			
			$args = array
				(
					'theme_location'  => 'main_menu',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'nav  nav--main',
                    'menu_id'         => '',
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'          => new WPGrade_Bucket_Walker_Nav_Menu()
                );

            wp_nav_menu($args);
        }
    }

    /*
     * Function for displaying The Top Left Menu 
     */
    function wpgrade_top_nav_left() {
        $theme_locations = get_nav_menu_locations();

        if (isset($theme_locations["top_menu_left"]) && ($theme_locations["top_menu_left"] != 0)) {
            $args = array
                (
                    'theme_location'  => 'top_menu_left',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'nav  nav--top nav--block',
                    'fallback_cb'     => 'wp_page_menu',
                    'menu_id'         => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                );

            wp_nav_menu($args);
		}
	}


	/*
     * Function for displaying The Top Right Menu 
     */
    function wpgrade_top_nav_right() {
        $theme_locations = get_nav_menu_locations();

        if (isset($theme_locations["top_menu_right"]) && ($theme_locations["top_menu_right"] != 0)) {
            $args = array
                (
                    'theme_location'  => 'top_menu_right',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'nav  nav--top  nav--block',
                    'fallback_cb'     => 'wp_page_menu',
                    'menu_id'         => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                );

            wp_nav_menu($args);
        }
    }


    /*
     * Function for displaying The Footer Menu
     */
	function wpgrade_footer_nav() {
        $theme_locations = get_nav_menu_locations();

        if (isset($theme_locations["footer_menu"]) && ($theme_locations["footer_menu"] != 0)) {
            $args = array
                (
                    'theme_location'  => 'footer_menu',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'site-navigation site-navigation--footer site-navigation--secondary flush--bottom',
                    'fallback_cb'     => 'wp_page_menu',
                    'menu_id'         => '',
					'depth'			  => 1,
					'items_wrap'      => '<ul id="%1$s" class="%2$s nav nav--block">%3$s</ul>',
                );

            wp_nav_menu($args);
		}
	}
