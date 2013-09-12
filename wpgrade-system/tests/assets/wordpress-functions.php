<?php

	#
	# Mock wordpress functions used in tests.
	# We ignore them from the code coverage report.
	#

	// @codeCoverageIgnoreStart

	function get_template_directory() {
		return dirname(__FILE__).'/../../../';
	}

	function load_theme_textdomain($domain, $path) {
		// do nothing
	}

	function trailingslashit($path) {
		return rtrim($path, '/\\').DIRECTORY_SEPARATOR;
	}

	function site_url() {
		return 'tests.nosuchsite.tld';
	}

	function add_action($tag, $function_to_add, $priority = null, $accepted_args = null) {
		// do nothing
	}

	function add_filter($tag, $function_to_add, $priority = null, $accepted_args = null) {
		// do nothing
	}

	function is_admin() {
		return false;
	}

	function __($str, $textdomain) {
		// do nothing
	}

	function _n_noop() {
		// do nothing
	}

	function do_action_ref_array($tag, $arg) {
		// do nothing
	}

	function sanitize_key($key) {
		return strtolower(preg_replace('#[^a-z0-9_-]#', '_', $key));
	}

	function is_ssl() {
		return false;
	}

	function get_template_directory_uri() {
		return 'template/dir/uri';
	}

	function admin_url()
	{
		return 'admin/url';
	}

	class WP_Widget {
		// empty
	}

	class Walker_Nav_Menu {
		// empty
	}

	// @codeCoverageIgnoreEnd
