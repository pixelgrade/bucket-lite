<?php
/*
 * Register custom menus.
 * This works on 3.1+
 */
if(!function_exists(' wpgrade_register_custom_menus'))
{
	function wpgrade_register_custom_menus() {
		wpgrade::options()->set
			(
				'nav_menus', 
				array
				(
					'main_menu' => __( 'Header Menu', wpgrade::textdomain() ), // main nav in header
				)
			);
		
		add_theme_support( 'menus' );
		
		foreach(wpgrade::option('nav_menus') as $key => $value)
		{ 
			register_nav_menu($key, wpgrade::themename().' '.$value);
		}
	}

	add_action("after_setup_theme", "wpgrade_register_custom_menus");
}

function wpgrade_main_nav() {
    /*
     * Test if there are menu locations to prevent errors.
     */
    $theme_locations = get_nav_menu_locations();
	
    if ( isset( $theme_locations["main_menu"] ) && ( $theme_locations["main_menu"] != 0 ) ) {

        $menu = wp_nav_menu(array(
            'theme_location' => 'main_menu',              // where it's located in the theme
            'container' => false,                           // remove nav container
            //'container_class' => '',           // class of container (should you choose to use it)
            'menu_class' => 'site-mainmenu',         // adding custom nav class
            'depth' => 0,                                // limit the depth of the nav
            'walker' => new Arrow_Walker_Nav_Menu,
            'echo' => false,
        ));

        echo $menu;
    }
}

function wpgrade_footer_nav() {
    $theme_locations = get_nav_menu_locations();
	
    if ( isset( $theme_locations["footer_menu"] ) && ( $theme_locations["footer_menu"] != 0 ) ) {

        $menu = wp_nav_menu( array(
            'theme_location'  => 'footer_menu',
            'container'       => 'div',
            'container_id'    => 'menu-main-navigation',
            'depth' => 1,
            'echo' => false
        ) );

        echo $menu;
    }
}

/*
 * Create a walker which will add a class to items with submenus
 * More http://stackoverflow.com/questions/3558198/php-wordpress-add-arrows-to-parent-menus
 */
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) {
            $element->classes[] = 'menu-item--parent'; //enter any classname you like here!
        }
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    // add main/sub classes to li's and links
    function start_el( &$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
      
        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'menu-item--main' : 'menu-item--sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
      
        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
      
        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="site-navigation__menu-item  menu-item' . $depth_class_names . ' ' . $class_names . '">';
      
        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
      
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
      
        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}