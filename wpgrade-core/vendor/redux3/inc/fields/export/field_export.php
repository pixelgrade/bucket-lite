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
 * @subpackage  Field_Export
 * @author      Abdullah Almesbahi (cadr-sa)
 * @version     3.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_export')) {

	/**
	 * Main ReduxFramework_export class
	 *
	 * @since       3.0.0
	 */
	class ReduxFramework_export extends ReduxFramework {

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
			echo '<h3>' . __( 'Export Theme Options', 'redux-framework' ) . '</h3>';
			echo '<div class="redux-section-desc">';
			echo '<p class="description">' . apply_filters( 'redux-backup-description', __( 'Here you can copy/download your current option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).', 'redux-framework' ) ) . '</p>';
			echo '</div>';
			/** @noinspection PhpUndefinedConstantInspection */
			echo '<p><a href="javascript:void(0);" id="redux-export-code-copy" class="button-secondary">' . __( 'Copy', 'redux-framework' ) . '</a> <a href="' . add_query_arg( array( 'feed' => 'reduxopts-' . $this->args['opt_name'], 'action' => 'download_options', 'secret' => md5( AUTH_KEY . SECURE_AUTH_KEY ) ), site_url() ) . '" id="redux-export-code-dl" class="button-primary">' . __( 'Download', 'redux-framework' ) . '</a> <a href="javascript:void(0);" id="redux-export-link" class="button-secondary">' . __( 'Copy Link', 'redux-framework' ) . '</a></p>';

			$backup_options = $this->args['opt_name'];
			$backup_options = get_option($backup_options);

//			var_dump($backup_options);
			$backup_options['redux-backup'] = '1';
			echo '<textarea class="large-text noUpdate" id="redux-export-code" rows="8">';
			print_r( json_encode( $backup_options ) );
			echo '</textarea>';
			/** @noinspection PhpUndefinedConstantInspection */
			echo '<input type="text" class="large-text noUpdate" id="redux-export-link-value" value="' . add_query_arg( array( 'feed' => 'reduxopts-' . $this->args['opt_name'], 'secret' => md5( AUTH_KEY.SECURE_AUTH_KEY ) ), site_url() ) . '" />';

			echo '</div>';
		}

	}
}