<?php

/**
 * @package        wpgrade
 * @category       functions
 * @author         Pixelgrade
 * @copyright  (c) 2013, Pixelgrade Media
 */
class wpgrade {

	#
	# This class is strictly meant to act as a function container to emulate
	# namespace behaviour. This avoids confusion and eliminates the risk of
	# injecting conflicting names.
	#
	# Shorthands for system classes should also be placed here.
	#
	# This is the ONLY place where functions that directly echo out content
	# should exist.
	#

	/** @var array */
	protected static $configuration = null;

	/**
	 * The theme configuration as read by the system is defined in
	 * wpgrade-config.php
	 * @return array theme configuration
	 */
	static function config() {
		return self::get_config();
	}

	static function get_config() {
		if ( ! self::has_config() ) {
			self::set_config();
		}

		return self::$configuration;
	}

	static function set_config() {
		/**
		 * this is the old path...keep it for legacy
		 */
		if ( file_exists( self::childpath() . 'config/wpgrade-config' . EXT ) ) {
			self::$configuration = include self::childpath() . 'config/wpgrade-config' . EXT;
		} elseif ( file_exists( self::themepath() . 'config/wpgrade-config' . EXT ) ) {
			self::$configuration = include self::themepath() . 'config/wpgrade-config' . EXT;
		} elseif ( file_exists( self::childpath() . 'wpgrade-config' . EXT ) ) {
			self::$configuration = include self::childpath() . 'wpgrade-config' . EXT;
		} elseif ( file_exists( self::themepath() . 'wpgrade-config' . EXT ) ) {
			self::$configuration = include self::themepath() . 'wpgrade-config' . EXT;
		}
	}

	static function has_config() {
		if ( self::$configuration === null ) {
			return false;
		}

		return true;
	}

	static $shortname = null;

	/** @var WPGradeMeta wpgrade state information */
	protected static $state = null;

	protected static $customizer_options = null;

	/**
	 * The state consists of variables set by the system, and used to pass data
	 * between different routines. eg. the update notifier
	 * @return WPGradeMeta current system state
	 */
	static function state() {
		if ( self::$state === null ) {
			self::$state = WPGradeMeta::instance( array() );
		}

		return self::$state;
	}

	/**
	 * @return mixed
	 */
	static function confoption( $key, $default = null ) {
		$config = self::config();

		return isset( $config[ $key ] ) ? $config[ $key ] : $default;
	}

	/**
	 * @return string theme textdomain
	 */
	static function textdomain() {
		$conf = self::config();
		if ( isset( $conf['textdomain'] ) && $conf['textdomain'] !== null ) {
			return $conf['textdomain'];
		} else { // no custom text domain, fallback to default pattern
			return $conf['name'] . '_txtd';
		}
	}

	/**
	 * @return string http or https based on is_ssl()
	 */
	static function protocol() {
		return is_ssl() ? 'https' : 'http';
	}


	//// Options ///////////////////////////////////////////////////////////////////

	/** @var WPGradeOptions */
	protected static $options_handler = null;

	/**
	 * @param WPGradeOptions option driver manager
	 */
	static function options_handler( $options_handler ) {
		self::$options_handler = $options_handler;
	}

	/**
	 * @return WPGradeOptions current options handler
	 */
	static function options() {
		return self::$options_handler;
	}

	/**
	 * @return mixed
	 */
	static function option( $option, $default = null ) {
		global $pagenow;
		global $pixcustomify_plugin;

		if ( $pixcustomify_plugin !== null && $pixcustomify_plugin->has_option( $option ) ) {
			// if this is a customify value get it here
			return $pixcustomify_plugin->get_option( $option, $default );
		} elseif ( isset( $_POST['customized'] ) && self::customizer_option_exists( $option ) ) {
			// so we are on the customizer page
			// overwrite every option if we have one
			return self::get_customizer_option( $option );

		} else {
			return self::options()->get( $option, $default );
		}
	}

	/**
	 * Get the image src attribute.
	 * Target should be a valid option accessible via WPGradeOptions interface.
	 * @return string|false
	 */
	static function image_src( $target ) {
		$image = self::option( $target, array() );
		if ( isset( $image['url'] ) ) {
			return $image['url'];
		}

		return false;
	}

	/**
	 * Shorthand.
	 * Please try using wpgrade::options()->set instead, it's clearer.
	 * @return WPGradeOptions
	 */
	static function setoption( $option, $value ) {
		return self::options()->set( $option, $value );
	}

	/**
	 * [!!] The method wording makes no sense in English. It's not retrieving a
	 * set of items. Please replace instances of this method with either,
	 *        wpgrade::options()->set
	 * or
	 *        wpgrade::setoption
	 * @deprecated
	 */
	static function option_set( $option, $value ) {
		return self::setoptions( $option, $value );
	}


	//// Resolvers /////////////////////////////////////////////////////////////////

	/** @var array */
	protected static $resolvers = array();

	/**
	 * The point of a resolver is to deal with various anti-pattern adopted by
	 * sadly quite a few WordPress specific plugins and frameworks. The pattern
	 * offers an alternative to techniques such as globals and mitigates the
	 * use of various "god object" patterns (generally manifesting themselves
	 * as classes that do their work in the damn constructor, and other
	 * singleton-ish patterns).
	 *
	 * @param string   key by which to invoke the resolver
	 * @param callable callback function
	 */
	static function register_resolver( $key, $callback_function ) {
		self::$resolvers[ $key ] = $callback_function;
	}

	/**
	 * A previously registered resolver is invoked and the relevant key is
	 * removed to prevent double invokation since the use of resolves means
	 * dangerous code is involved.
	 * The function will gracefully do nothing when multiple calls do occur.
	 * Though this does little but prevent local damage.
	 *
	 * @param string resolver key
	 * @param mixed  configuration to passs to resolver
	 */
	static function resolve( $key, $conf ) {
		if ( isset( self::$resolvers[ $key ] ) ) {
			call_user_func_array( self::$resolvers[ $key ], array( $conf ) );
		}
	}


	//// WordPress Defferred Helpers ///////////////////////////////////////////////

	/**
	 * @return string template path WITH TRAILING SLASH
	 */
	static function themepath() {
		return get_template_directory() . DIRECTORY_SEPARATOR;
	}

	/**
	 * @return string theme path (it may be a child theme) WITH TRAILING SLASH
	 */
	static function childpath() {
		return get_stylesheet_directory() . DIRECTORY_SEPARATOR;
	}

	/**
	 * @return string path to core with slash
	 */
	static function corepath() {
		return dirname( __FILE__ ) . DIRECTORY_SEPARATOR;
	}

	/**
	 * @return string core uri path
	 */
	static function coreuri() {
		return get_template_directory_uri() . '/' . basename( dirname( __FILE__ ) ) . '/';
	}

	/**
	 * @return string resource uri
	 */
	static function coreresourceuri( $file ) {
		return self::coreuri() . 'resources/assets/' . $file;
	}

	/**
	 * @return string file path
	 */
	static function themefilepath( $file ) {
		return self::themepath() . $file;
	}

	/**
	 * @return string path
	 */
	static function corepartial( $file ) {

		$templatepath = self::themepath() . rtrim( self::confoption( 'core-partials-overwrite-path', 'theme-partials/wpgrade-partials' ), '/' ) . '/' . $file;
		$childpath    = self::childpath() . rtrim( self::confoption( 'core-partials-overwrite-path', 'theme-partials/wpgrade-partials' ), '/' ) . '/' . $file;

		if ( file_exists( $childpath ) ) {
			return $childpath;
		} elseif ( file_exists( $templatepath ) ) {
			return $templatepath;
		} else { // local file not available
			return self::corepath() . 'resources/views/' . $file;
		}
	}

	/**
	 * This method uses wpgrade::corepartial to determine the path.
	 * @return string contents of partial at the computed path
	 */
	static function coreview( $file, $__include_parameters = array() ) {
		extract( $__include_parameters );
		ob_start();
		include wpgrade::corepartial( $file );

		return ob_get_clean();
	}

	/**
	 * @return string the lowercase version of the name
	 */
	static function shortname() {
		return self::get_shortname();
	}

	static function get_shortname() {
		if ( self::$shortname === null ) {
			$config = self::get_config();
			if ( isset( $config['shortname'] ) ) {
				self::$shortname = $config['shortname'];
			} else { // use name to determine apropriate shortname
				self::$shortname = str_replace( ' ', '_', strtolower( $config['name'] ) );
			}
		}

		return self::$shortname;
	}

	/**
	 * @return string theme prefix
	 */
	static function prefix() {
		$config = self::config();
		if ( isset( $config['prefix'] ) ) {
			return $config['prefix'];
		} else { // use shortname to determine apropriate shortname
			return '_' . self::shortname() . '_';
		}
	}

	/**
	 * @return string theme name, in presentable format
	 */
	static function themename() {
		$config = self::config();

		return ucfirst( $config['name'] );
	}

	/** @var WP_Theme */
	protected static $theme_data = null;

	/**
	 * @return WP_Theme
	 */
	static function themedata() {
		if ( self::$theme_data === null ) {
			if ( is_child_theme() ) {
				$theme_name       = get_template();
				self::$theme_data = wp_get_theme( $theme_name );
			} else {
				self::$theme_data = wp_get_theme();
			}
		}

		return self::$theme_data;
	}

	/**
	 * @return string
	 */
	static function themeversion() {
		return wpgrade::themedata()->Version;
	}

	/**
	 * @return string
	 */
	static function template_folder() {
		return wpgrade::themedata()->Template;
	}

	/**
	 * Reads theme configuration and returns resolved classes.
	 * @return array|boolean classes or false
	 */
	static function body_class() {
		$config = self::config();

		if ( ! empty( $config['body-classes'] ) ) {
			$classes          = array();
			$handlers_results = array();
			foreach ( $config['body-classes'] as $classname => $resolution ) {
				if ( is_string( $resolution ) ) {
					// ensure handler is executed; and only executed once
					if ( ! isset( $handlers_results[ $resolution ] ) ) {
						$handlers_results[ $resolution ] = call_user_func( $resolution );
					}
					// process result of handler
					if ( $handlers_results[ $resolution ] ) {
						$classes[] = $classname;
					}
				} else { // assume boolean
					if ( $resolution ) {
						$classes[] = $classname;
					}
				}
			}

			return $classes;
		} else { // no body class handlers
			return null;
		}
	}

	/**
	 * @return string uri to file
	 */
	static function uri( $file ) {
		$file = '/' . ltrim( $file, '/' );

		return get_template_directory_uri() . $file;
	}

	/**
	 * @return string uri to resource file
	 */
	static function resourceuri( $file ) {
		return wpgrade::uri( wpgrade::confoption( 'resource-path', 'theme-content' ) . '/' . ltrim( $file, '/' ) );
	}

	/**
	 * @return string
	 */
	static function pagination( $query = null, $target = null ) {
		if ( $query === null ) {
			global $wp_query;
			$query = $wp_query;
		}

		$target_settings = null;
		if ( $target !== null ) {
			$targets = self::confoption( 'pagination-targets', array() );
			if ( isset( $targets[ $target ] ) ) {
				$target_settings = $targets[ $target ];
			}
		}

		$pager = new WPGradePaginationFormatter( $query, $target_settings );

		return $pager->render();
	}


	//// Helpers ///////////////////////////////////////////////////////////////////

	/**
	 * Hirarchical array merge. Will always return an array.
	 *
	 * @param  ... arrays
	 *
	 * @return array
	 */
	static function merge() {
		$base = array();
		$args = func_get_args();

		foreach ( $args as $arg ) {
			self::array_merge( $base, $arg );
		}

		return $base;
	}

	/**
	 * Overwrites base array with overwrite array.
	 *
	 * @param array base
	 * @param array overwrite
	 */
	protected static function array_merge( array &$base, array $overwrite ) {
		foreach ( $overwrite as $key => &$value ) {
			if ( is_int( $key ) ) {
				// add only if it doesn't exist
				if ( ! in_array( $overwrite[ $key ], $base ) ) {
					$base[] = $overwrite[ $key ];
				}
			} else if ( is_array( $value ) ) {
				if ( isset( $base[ $key ] ) && is_array( $base[ $key ] ) ) {
					self::array_merge( $base[ $key ], $value );
				} else { // does not exist or it's a non-array
					$base[ $key ] = $value;
				}
			} else { // not an array and not numeric key
				$base[ $key ] = $value;
			}
		}
	}

	/**
	 * Recursively finds all files in a directory.
	 *
	 * @param string directory to search
	 *
	 * @return array found files
	 */
	static function find_files( $dir ) {
		$found_files = array();
		$files       = scandir( $dir );

		foreach ( $files as $value ) {
			// skip special dot files
			// and any file that starts with a . - think hidden directories like .svn or .git
			if ( strpos( $value, '.' ) === 0 ) {
				continue;
			}

			// is it a file?
			if ( is_file( "$dir/$value" ) ) {
				$found_files[] = "$dir/$value";
				continue;
			} else { // it's a directory
				foreach ( self::find_files( "$dir/$value" ) as $value ) {
					$found_files[] = $value;
				}
			}
		}

		return $found_files;
	}

	/**
	 * Requires all PHP files in a directory.
	 * Use case: callback directory, removes the need to manage callbacks.
	 * Should be used on a small directory chunks with no sub directories to
	 * keep code clear.
	 *
	 * @param string path
	 */
	static function require_all( $path ) {

		$files = self::find_files( rtrim( $path, '\\/' ) );

		$priority_list = array();
		foreach ( $files as $file ) {
			$priority_list[ $file ] = self::file_priority( $file );
		}

		asort( $priority_list, SORT_ASC );

		foreach ( $priority_list as $file => $priority ) {
			if ( strpos( $file, EXT ) ) {

				// we need to prepare the get_template_part param
				// which should be a relative path but without the extension
				// like "wpgrade-core/hooks"

				// first time test if this is a linux based server path with backslash
				$file = explode( 'themes/'. self::template_folder(), $file);
				if ( isset( $file[1] ) ) {
					$file = $file[1];
				} else { // if not it must be a windows path with slash
					$file = explode( 'themes\\'. self::template_folder(), $file[0]);
					if ( isset( $file[1] ) ) {
						$file = $file[1];
					}
				}
				$file = str_replace( EXT, '', $file  );
			}

			get_template_part($file) ;
		}
	}

	/**
	 * Priority based on path length and number of directories. Files in the
	 * same directory have higher priority if their path is shorter; files in
	 * directories have +100 priority bonus for every directory.
	 *
	 * @param  string file path
	 *
	 * @return int
	 */
	protected static function file_priority( $path ) {
		$path = str_replace( '\\', '/', $path );

		return strlen( $path ) + substr_count( $path, '/' ) * 100;
	}

	/**
	 * Helper for registering scripts based on a wpgrade configuration pattern.
	 * Used in wpgrade-system/hook for reading wpgrade-config values
	 *
	 * @param array   scripts
	 * @param boolean place scripts in footer?
	 */
	protected static function register_scripts( $scripts, $in_footer ) {
		foreach ( $scripts as $scriptname => $conf ) {
			// the child theme may be allowed to overwrite the configuration in
			// which case we support for null configuration, ie. child theme turned
			// the resource off
			if ( $conf !== null ) {
				if ( is_string( $conf ) ) {
					$path       = $conf;
					$require    = array();
					$cache_bust = '';

				} else { // array configuration passed
					$path = $conf['path'];

					// compute requirements
					if ( isset( $conf['require'] ) ) {
						if ( is_string( $conf['require'] ) ) {
							$require = array( $conf['require'] );
						} else { // assume array
							$require = $conf['require'];
						}
					} else { // no dependencies
						$require = array();
					}

					// compute cache bust
					if ( isset( $conf['cache_bust'] ) ) {
						$cache_bust = $conf['cache_bust'];
					} else { // no cache bust
						$cache_bust = '';
					}
				}

				wp_register_script( $scriptname, $path, $require, $cache_bust, $in_footer );
			}
		}
	}

	/**
	 * Helper for registering scripts based on a wpgrade configuration pattern.
	 * Used in wpgrade-system/hook for reading wpgrade-config values
	 *
	 * @param array footer scripts
	 */
	static function register_head_scripts( $scripts ) {
		self::register_scripts( $scripts, false );
	}

	/**
	 * Helper for registering scripts based on a wpgrade configuration pattern.
	 * Used in wpgrade-system/hook for reading wpgrade-config values
	 *
	 * @param array footer scripts
	 */
	static function register_footer_scripts( $scripts ) {
		self::register_scripts( $scripts, true );
	}

	/**
	 * Helper for registering styles based on a wpgrade configuration pattern.
	 * Used in wpgrade-system/hook for reading wpgrade-config values
	 *
	 * @param array styles
	 */
	static function register_styles( $styles ) {
		foreach ( $styles as $stylename => $conf ) {
			// the child theme may be allowed to overwrite the configuration in
			// which case we support for null configuration, ie. child theme turned
			// the resource off
			if ( $conf !== null ) {
				if ( is_string( $conf ) ) {
					$path       = $conf;
					$require    = array();
					$cache_bust = '';
					$media      = 'all';
				} else { // array configuration passed
					$path = $conf['path'];

					// compute requirements
					if ( isset( $conf['require'] ) ) {
						if ( is_string( $conf['require'] ) ) {
							$require = array( $conf['require'] );
						} else { // assume array
							$require = $conf['require'];
						}
					} else { // no dependencies
						$require = array();
					}

					// compute cache bust
					if ( isset( $conf['cache_bust'] ) ) {
						$cache_bust = $conf['cache_bust'];
					} else { // no cache bust
						$cache_bust = '';
					}

					// compute media
					if ( isset( $conf['media'] ) ) {
						$media = $conf['media'];
					} else { // no media
						$media = 'all';
					}
				}

				wp_register_style( $stylename, $path, $require, $cache_bust, $media );
			}
		}
	}

	/**
	 * @param string font
	 *
	 * @return array values for the font
	 */
	static function get_the_typo( $font ) {
		if ( self::option( $font ) ) {
			return self::option( $font );
		}

		return false;
	}

	/**
	 * @param string hex
	 *
	 * @return array rgb
	 */
	static function hex2rgb_array( $hex ) {
		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else { // strlen($hex) != 3
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}

		$rgb = array( $r, $g, $b );

		return $rgb; // returns an array with the rgb values
	}


	//// Media Handlers & Helpers //////////////////////////////////////////////////

	#
	# Audio
	#

	static function audio_selfhosted( $postID ) {
		$audio_mp3    = get_post_meta( $postID, wpgrade::prefix() . 'audio_mp3', true );
		$audio_m4a    = get_post_meta( $postID, wpgrade::prefix() . 'audio_m4a', true );
		$audio_oga    = get_post_meta( $postID, wpgrade::prefix() . 'audio_ogg', true );
		$audio_poster = get_post_meta( $postID, wpgrade::prefix() . 'audio_poster', true );

		include wpgrade::corepartial( 'audio-selfhosted' . EXT );
	}

	//// WPML Related Functions ////////////////////////////////////////////////////

	static function lang_post_id( $id ) {
		if ( function_exists( 'icl_object_id' ) ) {
			global $post;
			// make this work for any post type
			if ( isset( $post->post_type ) ) {
				$post_type = $post->post_type;
			} else {
				$post_type = 'post';
			}

			return icl_object_id( $id, $post_type, true );
		} else {
			return $id;
		}
	}

	// == Customizer overridden helpers ==

	/**
	 * Check if an option exists in customizer's post
	 *
	 * @param $option
	 *
	 * @return bool
	 */
	static function customizer_option_exists( $option ) {

		// cache this json so we don't scramble it every time
		if ( ! self::has_customizer_options() && isset( $_POST['customized'] ) ) {
			self::set_customizer_options( $_POST['customized'] );
		}
		$options = self::get_customizer_options();
		if ( isset( $options[ $option ] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get an options from our static customizer options array
	 *
	 * @param $option
	 *
	 * @return mixed
	 */
	static function get_customizer_option( $option ) {
		$options = self::get_customizer_options();

		return $options[ $option ];
	}

	/**
	 * Check we we have cached our customizer options
	 * @return bool
	 */
	static function has_customizer_options() {
		if ( ! empty( self::$customizer_options ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get our static customizer options or false if they don't exist
	 * @return bool|null
	 */
	static function get_customizer_options() {
		if ( ! empty( self::$customizer_options ) ) {
			return self::$customizer_options;
		}

		return false;
	}

	/**
	 * Cache the customizer's options in a static array (converted from an given json)
	 *
	 * @param $json
	 */
	static function set_customizer_options( $json ) {
		if ( empty( self::$customizer_options ) ) {
			$options = json_decode( wp_unslash( $json ), true );

			$theme_key = self::shortname() . '_options';

			$options[ $theme_key ] = array();
			foreach ( $options as $key => $opt ) {
				$new_key = '';
				if ( stripos( $key, $theme_key ) === 0 && stripos( $key, $theme_key ) !== false ) {
					$new_key                           = str_replace( $theme_key . '[', '', $key );
					$new_key                           = rtrim( $new_key, ']' );
					$options[ $theme_key ][ $new_key ] = $opt;
				}
			}
			self::$customizer_options = $options[ $theme_key ];
		}
	}

} # class
