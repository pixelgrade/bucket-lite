<?php
require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );

if ( !class_exists( "WPGrade_Bucket_Walker_Nav_Menu_Edit" ) && class_exists( 'Walker_Nav_Menu_Edit' ) ):

class WPGrade_Bucket_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		// append next menu element to $output
		parent::start_el($output, $item, $depth, $args);
		
		set_error_handler("custom_warning_handler", E_WARNING);
		
		// now let's add the megamenu layout select box but only for the first level
		if ($depth == 0 && ($item->object == 'category' || $item->object == 'post_format')) {
			
			//load up the library
			require_once 'vendor/simplehtmldom/simple_html_dom.php';

			// Create DOM from string
			$_doc = str_get_html($output);
			$_li = $_doc->find( '.menu-item-depth-0',-1); // "-1" aka the last element is important, because $output will contain all the menu elements before current element
		
			// if the last <li>'s id attribute doesn't match $item->ID something is very wrong, don't do anything
			// just a safety, should never happen...
			$menu_item_id = str_replace( 'menu-item-', '', $_li->getAttribute( 'id' ) );
			if( $menu_item_id != $item->ID ) {
				return;
			}

			//somewhere to save the new HTML code
			$newHtml = '';
			
			// fetch previously saved meta for the post (menu_item is just a post type)
			$current_val = esc_attr( get_post_meta( $item->ID, 'wpgrade_megamenu_layout', TRUE ) );

			//let's make the HTML
			//go through the options values and titles
			$themeconfiguration = wpgrade::config();
			if (!empty($themeconfiguration['megamenu_layouts'])) {
				$newHtml .= '<p class="description description-wide wpgrade_custom_menu_meta"><label>'.__('Select MegaMenu Layout:',wpgrade::textdomain()).' <select name="wpgrade_megamenu_layout_'.$menu_item_id.'">';
				foreach ($themeconfiguration['megamenu_layouts'] as $key => $value) {
					$selected = '';
					if ($key == $current_val) $selected = 'selected';

					$newHtml .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
				}
				$newHtml .= '</select></label></p>';
			}

			// inject the new input field
			$whereto = $_li->find( '.menu-item-actions',0);
			//add it before
			$whereto->outertext = $newHtml.$whereto->outertext;
			
			// swap the $output
			$output = $_doc->outertext;
			unset($_doc);
		}
		
		restore_error_handler();
		
	}

}

endif;
