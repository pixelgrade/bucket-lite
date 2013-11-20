<?php
require_once( ABSPATH . WPINC . '/nav-menu-template.php' );
/**
 * Create a walker which will add a class to items with submenus
 * More http://stackoverflow.com/questions/3558198/php-wordpress-add-arrows-to-parent-menus
 */

if ( !class_exists( "WPGrade_Bucket_Walker_Top_Nav_Menu" ) && class_exists( 'Walker_Nav_Menu' ) ):

class WPGrade_Bucket_Walker_Top_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "<ul class=\"nav nav--stacked nav--sub-menu sub-menu\">";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {  
        $output .= "</ul>";
    }

    // add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;

        if (!is_array($args)) {
            $args = (array)$args;
        }

        // depth dependent classes
        $depth_classes = array('depth-'.$depth);

        $depth_class_names = esc_attr(implode(' ', $depth_classes));

        // passed classes
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $class_names = esc_attr(implode(' ', apply_filters( 'nav_menu_css_class', array_filter($classes), $item)));

        // build html
        $output .= '<li id="nav--top__item-'.$item->ID. '" class="nav__item '.$depth_class_names.' '.$class_names.'">';

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
}

endif;


if ( !class_exists( "WPGrade_Bucket_Walker_Nav_Menu" ) && class_exists( 'Walker_Nav_Menu' ) ):

class WPGrade_Bucket_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "<ul class=\"sub-menu\">";
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
        $depth_classes = array('depth-'.$depth);

        $depth_class_names = esc_attr(implode(' ', $depth_classes));

        // passed classes
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $class_names = esc_attr(implode(' ', apply_filters( 'nav_menu_css_class', array_filter($classes), $item)));

        // build html
        $output .= '<li id="nav--top__item-'.$item->ID. '" class="nav__item '.$depth_class_names.' '.$class_names.' hidden">';

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
            $item_output .= '<div class="sub-menu--mega"><div class="sub-menu__grid  grid  grid--thin">';
        }
        
        if ($depth == 0 && ($item->object == 'category' || $item->object == 'post_format')) {
            //lets get the meta associated with the menu item to see what layout to use
            $menu_layout = esc_attr( get_post_meta( $item->ID, 'wpgrade_megamenu_layout', TRUE ) );
            
            $numberposts = 5; //we start of with 5 posts and decrease from here
            
            //if the menu has children then pull fewer posts
            if ($item->hasChildren) {
                $numberposts--;
            }
            
            if (!empty($menu_layout)) {
				 $post_args = array( 
							'numberposts' => -1,
							'offset'=> 0,
							'post_type'     => 'post',
							'post_status'   => 'publish',
                        );
				 
				if ($item->object == 'category') {
					
					$post_args['category'] = $item->object_id;
					
				} elseif ($item->object == 'post_format') {
					
					//first get the post format information
					$menu_item_post_format = get_term( $item->object_id, 'post_format' );
					
					$post_args['tax_query'] =
						array(
							array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array($menu_item_post_format->slug),
							  )
						);
				}
				
                //decrease the number of post by 2 if we have a slider
                if ($menu_layout == 'slider_latest_posts') {
                    $numberposts -= 2;
                }
                
                global $post;
                
                //hold the post slides ids so we exclude them from the rest of the posts
                $slideposts_ids = array();
                
                //create the markup for the category posts slider
                if ($menu_layout == 'slider_latest_posts') {
                    
                    //lets grab the posts that are marked as being part of the category slider
                    $post_args['meta_query'] = 
						array(
							array(
								'key' => wpgrade::prefix() . 'category_slide',
								'value' => 'on'
							)
						);
                    
                    $slideposts = get_posts( $post_args );

                    
                    $item_output .= '<div class="sub-menu__grid__item  grid__item  two-fifths">';

                    if (count($slideposts)):
                    
                    $item_output .= '<div class="pixslider js-pixslider" data-imagealign="center" data-imagescale="fill" data-arrows data-autoScaleSliderWidth="410" data-autoScaleSliderHeight="280">';

                        foreach( $slideposts as $post ) : setup_postdata( $post );
                            //add the id to the array
                            $slideposts_ids[] = $post->ID;
                            
                            $post_title = get_the_title();
                            $post_link = get_permalink();
                            $post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "post-big" );

                            if ( $post_image ){
                                $menu_post_image = '<img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" class="rsImg"/>';
                            } else {
                                // $menu_post_image = '<div class="image-wrap"></div>';
                                $menu_post_image = '';
                            }

                            $item_output .=
                                '<article class="featured-area__article  article--big">' .
                                    '<a href="' . $post_link . '" class="image-wrap">' .
                                        $menu_post_image .
                                        '<div class="article__title">' .
                                            '<h3 class="hN">' . $post_title . '</h3>' .
                                        '</div>' .
                                    '</a>' .
                                '</article>';
                        endforeach;
                    
                    $item_output .= '</div>';

                    else:

                        $item_output .= '<div class="no-slides-message">';
                        $item_output .= __('No featured posts in this category' , wpgrade::textdomain());
                        $item_output .= '</div>';

                    endif;

                    $item_output .= '</div>';
                    wp_reset_query();
					
					//a bit of clean up
					unset($post_args['meta_query']);
                }
                
                if ($menu_layout == 'latest_posts' || $menu_layout == 'slider_latest_posts') {
                
                    $post_args['numberposts'] = $numberposts;  
                    $post_args['post__not_in'] = $slideposts_ids;

                    $menuposts = get_posts( $post_args );

                    foreach( $menuposts as $post ) : setup_postdata( $post );

                        $post_title = get_the_title();
                        $post_link = get_permalink();
                        $post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "post-small" );

//                        $image_ratio = 70; // some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
//                        if (isset($post_image[1]) && isset($post_image[2]) && $post_image[1] > 0) {
//                            $image_ratio = $post_image[2] * 100/$post_image[1];
//                        }

                        if ( $post_image ){
                            $menu_post_image = '<div class="article__thumb" style=""><img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" /></div>';
                        } else {
                            $menu_post_image = '<div class="article__thumb"></div>';
                            $menu_post_image = '';
                        }

                        $item_output .= 
                            '<div class="sub-menu__grid__item  grid__item  one-fifth">' .
                                    '<article class="article article--billboard-small">' .
                                        '<a href="' . $post_link . '">' .
                                            $menu_post_image .
                                            '<div class="article__content">
                                                <h2 class="article__title article--billboard-small__title">' .
                                                    '<span class="hN">' . $post_title . '</span>' .
                                                '</h2>
                                                <div class="article__description">'.
                                                    substr(get_the_excerpt(), 0, 75). 
                                                '</div>
                                                <span class="small-link">'.__('Read More', wpgrade::textdomain()).'<em>+</em></span>
                                            </div>
                                        </a>'.
                                    '</article>'.
                            '</div>';

                    endforeach;
                    wp_reset_query();



                
                }
            }
        }

        if ($depth == 0) {
            $item_output .= '</div>';
        }

        
        // build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth=0, $args=array()) {

        if ($depth == 0) {
            $output .= '</div>';
        }
        
        $output .= "</li>";
        
        // parse the HTML and find the megamenu posts and switch them with the submenus so those are first
        if ($depth == 0) {
			
			set_error_handler("custom_warning_handler", E_WARNING);
			
			//load up the library
            require_once 'vendor/simplehtmldom/simple_html_dom.php';
			
			// Create DOM from string
			$_doc = str_get_html($output);

			$zagrid = $_doc->find('.sub-menu--mega',-1)->find('.grid',0);
			if (!empty($zagrid) && !empty($zagrid->innertext)) {
                $submenu = $_doc->find('.sub-menu--mega', -1)->find('.sub-menu', 0);
                if (!empty($submenu)) {
					//cleanup
					$submenu->removeClass('sub-menu');
					$submenu->removeClass('one-fifth');
					//add classes
					$submenu->addClass('nav nav--stacked nav--sub-menu sub-menu');
					//wrap it
					$submenu->outertext = '<div class="sub-menu__grid__item  grid__item  one-fifth">'.$submenu->outertext.'</div>';
					//prepend it
					$zagrid->innertext = $submenu->outertext.$zagrid->innertext;
					//empty it
					$submenu->outertext = '';
                }

            } else {
                // the megamenu wrapper is empty
                $submenu = $_doc->find('.sub-menu--mega', -1)->find('.sub-menu', 0);
                if (!empty($submenu) && !empty($submenu->innertext)) {

                    $_nav__item = $_doc->find('.sub-menu--mega',-1)->parent();
                    $_nav__item->addClass('nav__item--relative');
                    
					$whereto = $_doc->find('.sub-menu--mega',-1);
					//cleanup
					$submenu->removeClass('sub-menu');
					$submenu->removeClass('one-fifth');
					//add classes
					$submenu->addClass('nav nav--stacked nav--sub-menu sub-menu');
					//insert it
					$whereto->outertext = $submenu->outertext.$whereto->outertext;
					//empty it
					$submenu->outertext = '';
                }
				
				//empty it
				$_doc->find('.sub-menu--mega',-1)->outertext = '';
            }
			
			// swap the $output
			$output = $_doc->outertext;
			unset($_doc);
			
			restore_error_handler();
        }
    }

} # class

endif;