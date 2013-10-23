<?php
require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );

if ( !class_exists( "WPGrade_Bucket_Walker_Nav_Menu_Edit" ) && class_exists( 'Walker_Nav_Menu_Edit' ) ):

class WPGrade_Bucket_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		// append next menu element to $output
		parent::start_el($output, $item, $depth, $args);
		
		if ( ! class_exists( 'phpQuery') ) {
			// load phpQuery at the last moment, to minimise chance of conflicts (ok, it's probably a bit too defensive)
			require_once 'phpQuery-onefile.php';
		}
		
		$_doc = phpQuery::newDocumentHTML( $output );
		$_li = phpQuery::pq( 'li.menu-item:last' ); // ":last" is important, because $output will contain all the menu elements before current element
		
		// if the last <li>'s id attribute doesn't match $item->ID something is very wrong, don't do anything
		// just a safety, should never happen...
		$menu_item_id = str_replace( 'menu-item-', '', $_li->attr( 'id' ) );
		if( $menu_item_id != $item->ID ) {
			return;
		}
		
		//somewhere to save the new HTML code
		$newHtml = '';
		
		// now let's add the megamenu layout select box but only for the first level
		if ($depth == 0 && $item->object == 'category') {
		
			// fetch previously saved meta for the post (menu_item is just a post type)
			$current_val = esc_attr( get_post_meta( $menu_item_id, 'wpgrade_megamenu_layout', TRUE ) );

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

			// by means of phpQuery magic, inject a new input field
			$_li->find( '.menu-item-actions' )
				->before( $newHtml );
		}
		
		// swap the $output
		$output = $_doc->html();
		
	}

}

endif;
