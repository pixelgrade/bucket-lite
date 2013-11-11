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
 * @subpackage  Field_Import
 * @author      Abdullah Almesbahi (cadr-sa)
 * @version     3.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_import')) {

	/**
	 * Main ReduxFramework_import class
	 *
	 * @since       3.0.0
	 */
	class ReduxFramework_import extends ReduxFramework {

		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function __construct($field = array(), $value = '', $parent) {

			parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);

			$this->field = $field;
			$this->value = $value;
		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {
			echo '<div  class="redux-normal  redux-info-field">';
			echo '<h3>' . __( 'Import Theme Options', 'redux-framework' ) . '</h3>';
			echo '<p class="description">Choose how to import theme options.</p>';
			echo '<div>';
				echo '<a href="javascript:void(0);" id="redux-import-code-button" class="button-secondary">' . __( 'Import from file', 'redux-framework' ) . '</a>';
				echo '<a href="javascript:void(0);" id="redux-import-link-button" class="button-secondary">' . __( 'Import from URL', 'redux-framework' ) . '</a>';
			echo '</div>';

			echo '<div id="redux-import-code-wrapper">';
				echo '<div class="redux-section-desc">';
					echo '<p class="description" id="import-code-description">';
					echo apply_filters( 'redux-import-file-description', __( 'Input your backup file below and hit Import to restore your sites options from a backup.', 'redux-framework' ) );
					echo '</p>';
				echo '</div>';
				echo '<textarea id="import-code-value" name="' . $this->args['opt_name'] . '[import_code]" class="large-text noUpdate" rows="8"></textarea>';

				echo '</div>';

				echo '<div id="redux-import-link-wrapper">';

				echo '<div class="redux-section-desc">';
				echo '<p class="description" id="import-link-description">' . apply_filters( 'redux-import-link-description', __( 'Input the URL to another sites options set and hit Import to load the options from that site.', 'redux-framework' ) ) . '</p>';
			echo '<p class="description" id="import-link-description">' . apply_filters( 'redux-import-link-description', __( 'A good exemple could be the theme demosite:<br>http://pixelgrade.com/demos/bucket?feed=reduxopts-bucket_options&secret=c9f7fb94cbcf78dd9782ee477403dc13', 'redux-framework' ) ) . '</p>';
				echo '</div>';

				echo '<input type="text" id="import-link-value" name="' . $this->args['opt_name'] . '[import_link]" class="large-text noUpdate" value="" />';

				echo '</div>';

				echo '<p id="redux-import-action"><input type="submit" id="redux-import" name="' . $this->args['opt_name'] . '[import]" class="button-primary" value="' . __( 'Import', 'redux-framework' ) . '">&nbsp;&nbsp;<span>' . apply_filters( 'redux-import-warning', __( 'WARNING! This will overwrite all existing option values, please proceed with caution!', 'redux-framework' ) ) . '</span></p>';
				echo '<div class="hr"/><div class="inner"><span>&nbsp;</span></div></div>';
			echo '</div></div>';
		}
	}
}