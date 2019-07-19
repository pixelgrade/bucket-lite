<?php

	/*
	 * Register custom menus.
	 * This works on 3.1+
	 */
	function wpgrade_register_custom_menus() {

		add_theme_support('menus');
		$menus = wpgrade::confoption('import_nav_menu');
		foreach ($menus as $key => $value) {
			register_nav_menu($key, $value);
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
                    'menu_class'      => 'nav  nav--main  js-nav--main',
                    'menu_id'         => '',
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'          => new WPGrade_Bucket_Walker_Nav_Menu()
                );

            wp_nav_menu($args);
        }
    }

    /*
     * Function for displaying The Main Header Menu
     */
    function wpgrade_main_nav_mobile() {
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
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                );

            wp_nav_menu($args);
        }
    }    

