<?php

/**
 * Create a walker which will add a class to items with submenus
 * More http://stackoverflow.com/questions/3558198/php-wordpress-add-arrows-to-parent-menus
 */
class WPGrade_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "<ul class=\"site-navigation__sub-menu\">";
    }

    function end_lvl(&$output, $depth=0, $args=array()) {  
        $output .= "</ul>";  
    }

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if ( ! empty($children_elements[$element->$id_field])) {
            $element->classes[] = 'menu-item--parent';
        }

        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    // add main/sub classes to li's and links
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;

		if (!is_array($args)) {
			$args = (array)$args;
		}

        // depth dependent classes
        $depth_classes = array
			(
				($depth == 0 ? 'menu-item--main' : 'menu-item--main  menu-item--sub-menu-item'),
				($depth % 2 ? 'menu-item--odd' : 'menu-item--even'),
				'menu-item-depth--'.$depth
			);

        $depth_class_names = esc_attr(implode(' ', $depth_classes));

        // passed classes
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $class_names = esc_attr(implode(' ', apply_filters( 'nav_menu_css_class', array_filter($classes), $item)));

        // build html
        $output .= '<li id="nav-menu-item-'.$item->ID. '" class="site-navigation__menu-item  menu-item '.$depth_class_names.' '.$class_names.'">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        $item_output = sprintf
			(
				'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args['before'],
				$attributes,
				$args['link_before'],
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args['link_after'],
				$args['after']
			);

        // build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth=0, $args=array()) {  
        $output .= "</li>";  
    }

} # class
