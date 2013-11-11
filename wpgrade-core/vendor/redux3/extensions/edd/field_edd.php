<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Color
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_edd' ) ) {

    /**
     * Main ReduxFramework_color class
     *
     * @since       1.0.0
     */
	class ReduxFramework_edd extends ReduxFramework {
	
		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
	 	 * @since 		1.0.0
	 	 * @access		public
	 	 * @return		void
		 */
		public function __construct( $field = array(), $value ='', $parent ) {
		
			parent::__construct( $parent->sections, $parent->args, $parent->extra_tabs );

			$this->field = $field;
			$this->value = $value;

			$this->parent = $parent;
		
		}
	
		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
	 	 *
	 	 * @since 		1.0.0
	 	 * @access		public
	 	 * @return		void
		 */
		public function render() {

			$defaults = array(
				'license' 	=> '',
				'status' 	=> '',
			);

			$this->value = wp_parse_args( $this->value, $defaults );     

			echo '<input data-id="'.$this->field['id'].'" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][license]"  id="' . $this->field['id'] . '-license" class="redux-edd ' . $this->field['class'] . '"  type="text" value="' . $this->value['license'] . '" " />'; 
			echo '<input type="hidden" data-id="'.$this->field['id'].'" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][status]" id="' . $this->field['id'] . '-status" class="redux-edd ' . $this->field['class'] . '" type="text" value="' . $this->value['status'] . '" " />'; 
			echo '&nbsp; <a href="#" class="button button-primary redux-EDDAction" data-edd_action="check_license">Verify License</a>';
			echo '&nbsp; <a href="#" class="button button-primary redux-EDDAction" data-edd_action="activate_license">Activate License</a>';
			echo '&nbsp; <a href="#" class="button redux-EDDAction" data-edd_action="deactivate_license">Deactivate License</a>';
			if (isset($this->parent->args['edd'])) {
				foreach( $this->parent->args['edd'] as $k => $v ) {
					echo '<input type="hidden" data-id="'.$this->field['id'].'" id="' . $this->field['id'] . '-'.$k.'" class="redux-edd edd-'.$k.'"  type="text" value="' . $v . '" " />';
				}
			}

		}
	
		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since		1.0.0
		 * @access		public
		 * @return		void
		 */
		public function enqueue() {

			wp_enqueue_script(
				'redux-field-edd-js', 
				ReduxFramework::$_url . 'extensions/edd/field_edd.js', 
				array( 'jquery' ),
				time(),
				true
			);

			wp_enqueue_style(
				'redux-field-edd-css', 
				ReduxFramework::$_url . 'extensions/edd/field_edd.css', 
				time(),
				true
			);
		
		}
	
	}
}