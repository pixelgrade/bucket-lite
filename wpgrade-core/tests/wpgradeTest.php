<?php

/* This file is property of Pixel Grade Media. You may NOT copy, or redistribute
 * it. Please see the license that came with your copy for more information.
 */

/**
 * @package    wpgrade
 * @category   functions
 * @author     Pixel Grade Team
 * @copyright  (c) 2013, Pixel Grade Media
 */
class wpgradeTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	function can_load_configuration_file() {
		// save configuration
		$originalconfig = wpgrade::config();
		// delete configuration
		wpgrade::overwrite_configuration(null);

		// the test
		$config = wpgrade::config();
		$this->assertTrue(is_array($config) && isset($config['name']));

		// restore configuration
		wpgrade::overwrite_configuration(null);
		wpgrade::overwrite_configuration($originalconfig);
	}

	/**
	 * @test
	 */
	function can_load_textdomain() {
		wpgrade::overwrite_configuration(array('textdomain' => null));
		$this->assertEquals('testgrade_txtd', wpgrade::textdomain());
	}

	/**
	 * @test
	 */
	function can_load_custom_textdomain() {
		// save a copy of the configuration
		$config = wpgrade::config();

		// the test
		wpgrade::overwrite_configuration(array('textdomain' => 'test_text_domain'));
		$this->assertEquals('test_text_domain', wpgrade::textdomain());

		// restore original textdomain
		wpgrade::overwrite_configuration(array('textdomain' => $config['textdomain']));
	}

	/**
	 * @test
	 */
	function can_retrieve_theme_option() {
		$this->assertEquals('success', wpgrade::option('unittest_test_option'));
	}

} # class
