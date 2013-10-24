<?php
require_once( ABSPATH . WPINC . '/nav-menu-template.php' );
/**
 * Create a walker which will add a class to items with submenus
 * More http://stackoverflow.com/questions/3558198/php-wordpress-add-arrows-to-parent-menus
 */
if ( !class_exists( "WPGrade_Bucket_Walker_Nav_Menu" ) && class_exists( 'Walker_Nav_Menu' ) ):

class WPGrade_Bucket_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "<ul class=\"site-navigation__sub-menu\">";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {  
        $output .= "</ul>";
    }

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
		
		// check whether there are children for the given ID
        $element->hasChildren = isset($children_elements[$element->$id_field]) && !empty($children_elements[$element->$id_field]);
		
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


//            echo '<!--';
//            print_r($item);
//            echo '-->';
		
		//the megamenu wrapper
		if ($depth == 0) {
			$item_output .= '<div class="megamenu_wrapper">';
		}
		
        if ($depth == 0 && $item->object == 'category') {
			
            $cat = $item->object_id;
			
			//lets get the meta associated with the menu item to see what layout to use
			$menu_layout = esc_attr( get_post_meta( $item->ID, 'wpgrade_megamenu_layout', TRUE ) );
			
			$numberposts = 5; //we start of with 5 posts and decrease from here
			
			//if the menu has children then pull fewer posts
			if ($item->hasChildren) {
				$numberposts--;
			}
            
			if (!empty($menu_layout)) {
				//decrease the number of post by 2 if we have a slider
				if ($menu_layout == 'slider_latest_posts') {
					$numberposts -= 2;
				}
				
				$item_output .= '<div class="sub-menu__posts megamenu_extra"><div class="grid  grid--thin">';

				global $post;
				
				//hold the post slides ids so we exclude them from the rest of the posts
				$slideposts_ids = array();
				
				//create the markup for the category posts slider
				if ($menu_layout == 'slider_latest_posts') {
					
					//lets grab the posts that are marked as being part of the category slider
					$post_args = array( 
							'numberposts' => -1, 
							'offset'=> 0, 
							'category' => $cat,
							'post_type'     => 'post',
							'post_status'   => 'publish',
							'meta_query' => array(
								array(
									'key' => wpgrade::prefix() . 'category_slide',
									'value' => 'on'
								)
							)
						);
					
					$slideposts = get_posts( $post_args );
					
					$item_output .= '<div class="grid__item megamenu_slider two-fifth">';

					foreach( $slideposts as $post ) : setup_postdata( $post );
						//add the id to the array
						$slideposts_ids[] = $post->ID;
						
						$post_title = get_the_title();
						$post_link = get_permalink();
						$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "medium-size" );

						if ( $post_image ){
							$menu_post_image = '<img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" />';
						} else {
							// $menu_post_image = '<div class="image-wrap"></div>';
							$menu_post_image = '';
						}

						$item_output .= 
									'<article class="article slide article--billboard-small">' .
										'<div class="image-wrap">' . $menu_post_image . '</div>' .
										'<h2 class="article__title article--billboard-small__title">' .
											'<div class="hN">' . $post_title . '</div>' .
										'</h2>' .
										'<a class="small-link" href="' . $post_link . '">Read More <em>+</em></a>' .
									'</article>';

					endforeach;
					
					$item_output .= '</div>';
					wp_reset_query();
				}
				
				if ($menu_layout == 'latest_posts' || $menu_layout == 'slider_latest_posts') {
				
					$post_args = array( 
							'numberposts' => $numberposts, 
							'offset'=> 0, 
							'category' => $cat,
							'post_type'     => 'post',
							'post_status'   => 'publish',
							'post__not_in' => $slideposts_ids,
						);

					$menuposts = get_posts( $post_args );

					foreach( $menuposts as $post ) : setup_postdata( $post );

						$post_title = get_the_title();
						$post_link = get_permalink();
						$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "medium-size" );

						if ( $post_image ){
							$menu_post_image = '<img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" />';
						} else {
							// $menu_post_image = '<div class="image-wrap"></div>';
							$menu_post_image = '';
						}

						$item_output .= 
								'<div class="grid__item  one-fifth">' .
									'<article class="article article--billboard-small">' .
										'<div class="image-wrap">' . $menu_post_image . '</div>' .
										'<h2 class="article__title article--billboard-small__title">' .
											'<div class="hN">' . $post_title . '</div>' .
										'</h2>' .
										'<a class="small-link" href="' . $post_link . '">Read More <em>+</em></a>' .
									'</article>'.
								'</div>';

					endforeach;
					wp_reset_query();
				
				}

				$item_output .= '</div></div>';
			}
        }
		
		// build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		
    }

    function end_el(&$output, $item, $depth=0, $args=array()) {
		
		//close the wrapper for the megamenu
		if ($depth == 0) {
			$output .= '</div>';
		}
		
        $output .= "</li>";
		
		//parse the HTML and find the megamenu posts and switch them with the submenus so those are first
		if ($depth == 0) {
			if ( ! class_exists( 'phpQuery') ) {
				// load phpQuery at the last moment, to minimise chance of conflicts (ok, it's probably a bit too defensive)
				require_once 'phpQuery-onefile.php';
			}

			$_doc = phpQuery::newDocumentHTML( $output );
			if ($_doc->find('.megamenu_wrapper:last')->html() != '') {
				$menuposts = $_doc->find('.megamenu_wrapper:last .megamenu_extra')->htmlOuter();
				
				if (!empty($menuposts) && $_doc->find('.megamenu_wrapper:last .site-navigation__sub-menu')->length()) {
					$_doc->find('.megamenu_wrapper:last .megamenu_extra')->remove();
					$_doc->find('.megamenu_wrapper:last .site-navigation__sub-menu')->after($menuposts);
				}
			} else {
				//the megamenu wrapper is empty
				$_doc->find('.megamenu_wrapper:last')->remove();
			}
			
			// swap the $output
			$output = $_doc->html();
		}
    }

} # class

endif;