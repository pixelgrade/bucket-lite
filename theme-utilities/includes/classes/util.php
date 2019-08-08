<?php
/**
 * util.php
 *
 * util.php is a library of helper functions for common tasks such as
 * formatting bytes as a string or displaying a date in terms of how long ago
 * it was in human readable terms (E.g. 4 minutes ago). The library is entirely
 * contained within a single file and hosts no dependencies. The library is
 * designed to avoid any possible conflicts.
 *
 * @author Brandon Wamboldt <brandon.wamboldt@gmail.com>
 * @link   http://github.com/brandonwamboldt/utilphp/ Official Documentation
 */
class util
{
	const SECONDS_IN_A_MINUTE = 60;
	const SECONDS_IN_A_HOUR   = 3600;
	const SECONDS_IN_AN_HOUR  = 3600;
	const SECONDS_IN_A_DAY    = 86400;
	const SECONDS_IN_A_WEEK   = 604800;
	const SECONDS_IN_A_MONTH  = 2592000;
	const SECONDS_IN_A_YEAR   = 31536000;

	/**
	 * A collapse icon, used in the dump_var function to allow collapsing an
	 * array or object
	 *
	 * @var string
	 */
	static $icon_collapse = 'iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAMAAADXT/YiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2RpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo3MjlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFNzFDNDQyNEMyQzkxMUUxOTU4MEM4M0UxRDA0MUVGNSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFNzFDNDQyM0MyQzkxMUUxOTU4MEM4M0UxRDA0MUVGNSIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IFdpbmRvd3MiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo3NDlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3MjlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PuF4AWkAAAA2UExURU9t2DBStczM/1h16DNmzHiW7iNFrypMvrnD52yJ4ezs7Onp6ejo6P///+Tk5GSG7D9h5SRGq0Q2K74AAAA/SURBVHjaLMhZDsAgDANRY3ZISnP/y1ZWeV+jAeuRSky6cKL4ryDdSggP8UC7r6GvR1YHxjazPQDmVzI/AQYAnFQDdVSJ80EAAAAASUVORK5CYII=';

	/**
	 * A collapse icon, using in the dump_var function to allow collapsing an
	 * array or object
	 *
	 * @var string
	 */
	static $icon_expand = 'iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAMAAADXT/YiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2RpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo3MTlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFQzZERTJDNEMyQzkxMUUxODRCQzgyRUNDMzZEQkZFQiIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFQzZERTJDM0MyQzkxMUUxODRCQzgyRUNDMzZEQkZFQiIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IFdpbmRvd3MiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo3MzlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3MTlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PkmDvWIAAABIUExURU9t2MzM/3iW7ubm59/f5urq85mZzOvr6////9ra38zMzObm5rfB8FZz5myJ4SNFrypMvjBStTNmzOvr+mSG7OXl8T9h5SRGq/OfqCEAAABKSURBVHjaFMlbEoAwCEPRULXF2jdW9r9T4czcyUdA4XWB0IgdNSybxU9amMzHzDlPKKu7Fd1e6+wY195jW0ARYZECxPq5Gn8BBgCr0gQmxpjKAwAAAABJRU5ErkJggg==';

	/** Limit words for a string */

	static function limit_words( $string, $word_limit, $more_text = ' [&hellip;]' ) {

		$words = explode(' ',$string);
		$output = implode(' ', array_splice($words,0,$word_limit ) );
		
		//check if we actually cut something
		if ( count( $words ) > $word_limit) {
			$output .= $more_text;
		}
		
		return $output;
	}

	static function get_latest_twelve_monts( $start_month = '' ) {

		if ( !empty( $start_month ) ) {
			$month = $start_month;
		} else {
			$month = (int) date('m');
		}

		$return = array();
		$count = 1;
		while ( $count <= 12  ) {
			if ( $month < 1 ) {
				$month = 12;
			}
			$return[$month] = $month;
			$month--;
			$count++;
		}

		return $return;
	}

	/**
	 * Access an array index, retrieving the value stored there if it
	 * exists or a default if it does not. This function allows you to
	 * concisely access an index which may or may not exist without
	 * raising a warning
	 *
	 * @param   array   $var      Array to access
	 * @param   string  $field    Index to access in the array
	 * @param   mixed   $default  Default value to return if the key is not
	 *                            present in the array
	 * @return  mixed
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function array_get( & $var, $default = NULL ) {

		if ( isset( $var ) ) {
			return $var;
		} else {
			return $default;
		}
	}

	/**
	 * Checks to see if the page is being server over SSL or not
	 *
	 * @return  bool
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function is_https() {

		if ( isset( $_SERVER['HTTPS'] ) && ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Retrieve a modified URL query string.
	 *
	 * You can rebuild the URL and append a new query variable to the URL
	 * query by using this function. You can also retrieve the full URL
	 * with query data.
	 *
	 * Adding a single key & value or an associative array. Setting a key
	 * value to an empty string removes the key. Omitting oldquery_or_uri
	 * uses the $_SERVER value. Additional values provided are expected
	 * to be encoded appropriately with urlencode() or rawurlencode().
	 *
	 * @param   mixed  $newkey          Either newkey or an associative
	 *                                  array
	 * @param   mixed  $newvalue        Either newvalue or oldquery or uri
	 * @param   mixed  $oldquery_or_uri Optionally the old query or uri
	 * @return  string
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/add_query_arg
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function add_query_arg() {

		$ret = '';

		// Was an associative array of key => value pairs passed?
		if ( is_array( func_get_arg( 0 ) ) ) {

			// Was the URL passed as an argument?
			if ( func_num_args() == 2 && func_get_arg( 1 ) ) {
				$uri = func_get_arg( 1 );
			} else if ( func_num_args() == 3 && func_get_arg( 2 ) ) {
				$uri = func_get_arg( 2 );
			} else {
				$uri = $_SERVER['REQUEST_URI'];
			}
		} else {

			// Was the URL passed as an argument?
			if ( func_num_args() == 3 && func_get_arg( 2 ) ) {
				$uri = func_get_arg( 2 );
			} else {
				$uri = $_SERVER['REQUEST_URI'];
			}
		}

		// Does the URI contain a fragment section (The part after the #)
		if ( $frag = strstr( $uri, '#' ) ) {
			$uri = substr( $uri, 0, -strlen( $frag ) );
		} else {
			$frag = '';
		}

		// Get the URI protocol if possible
		if ( preg_match( '|^https?://|i', $uri, $matches ) ) {
			$protocol = $matches[0];
			$uri = substr( $uri, strlen( $protocol ) );
		} else {
			$protocol = '';
		}

		// Does the URI contain a query string?
		if ( strpos( $uri, '?' ) !== FALSE ) {
			$parts = explode( '?', $uri, 2 );

			if ( 1 == count( $parts ) ) {
				$base  = '?';
				$query = $parts[0];
			} else {
				$base  = $parts[0] . '?';
				$query = $parts[1];
			}
		} else if ( ! empty( $protocol ) || strpos( $uri, '=' ) === FALSE ) {
			$base  = $uri . '?';
			$query = '';
		} else {
			$base  = '';
			$query = $uri;
		}

		// Parse the query string into an array
		parse_str( $query, $qs );

		// This re-URL-encodes things that were already in the query string
		$qs = self::array_map_deep( $qs, 'rawurlencode' );

		if ( is_array( func_get_arg( 0 ) ) ) {
			$kayvees = func_get_arg( 0 );
			$qs = array_merge( $qs, $kayvees );
		} else {
			$qs[func_get_arg( 0 )] = func_get_arg( 1 );
		}

		foreach ( (array) $qs as $k => $v ) {
			if ( $v === false )
				unset( $qs[$k] );
		}

		$ret = http_build_query( $qs );
		$ret = trim( $ret, '?' );
		$ret = preg_replace( '#=(&|$)#', '$1', $ret );
		$ret = $protocol . $base . $ret . $frag;
		$ret = rtrim( $ret, '?' );
		return $ret;
	}

	/**
	 * Convert entities, while preserving already-encoded entities
	 *
	 * @param   string  $string  The text to be converted
	 * @return  string
	 *
	 * @link    http://ca2.php.net/manual/en/function.htmlentities.php#90111
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function htmlentities( $string, $preserve_encoded_entities = FALSE ) {

		if ( $preserve_encoded_entities ) {
			$translation_table = get_html_translation_table( HTML_ENTITIES, ENT_QUOTES );
			$translation_table[chr(38)] = '&';
			return preg_replace( '/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,3};)/', '&amp;', strtr( $string, $translation_table ) );
		} else {
			return htmlentities( $string, ENT_QUOTES, mb_internal_encoding() );
		}
	}

	/**
	 * Convert >, <, ', " and & to html entities, but preserves entities
	 * that are already encoded
	 *
	 * @param   string  $string  The text to be converted
	 * @return  string
	 *
	 * @link    http://ca2.php.net/manual/en/function.htmlentities.php#90111
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function htmlspecialchars( $string, $preserve_encoded_entities = FALSE  ) {

		if ( $preserve_encoded_entities ) {
			$translation_table            = get_html_translation_table( HTML_SPECIALCHARS, ENT_QUOTES );
			$translation_table[chr( 38 )] = '&';

			return preg_replace( '/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,3};)/', '&amp;', strtr( $string, $translation_table ) );
		} else {
			return htmlentities( $string, ENT_QUOTES, mb_internal_encoding() );
		}
	}

	/**
	 * Return the URL to a user's gravatar
	 *
	 * @param   string  $email  The email of the user
	 * @param   int     $size   The size of the gravatar
	 * @return  string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function get_gravatar( $email, $size = 32 ) {

		if ( self::is_https() ) {
			$url = 'https://secure.gravatar.com/';
		} else {
			$url = 'http://www.gravatar.com/';
		}

		$url .= 'avatar/' . md5( $email ) . '?s=' . (int) abs( $size );

		return $url;
	}

	static function get_avatar_url($email, $size = 32) {

		$get_avatar = get_avatar($email, $size);
		
		preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $get_avatar, $matches);
		if (isset($matches[1])) {
			return $matches[1];
		} else {
			return '';
		}

	}

	/**
	 * Returns the first element in an array
	 *
	 * @param   array  $array  The array
	 * @return  mixed
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function array_first( array $array ) {

		return reset( $array );
	}

	/**
	 * Returns the last element in an array
	 *
	 * @param   array  $array  The array
	 * @return  mixed
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function array_last( array $array ) {

		return end( $array );
	}

	/**
	 * Returns the first key in an array
	 *
	 * @param   array  $array  The array
	 * @return  int|string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function array_first_key( array $array ) {

		reset( $array );

		return key( $array );
	}

	/**
	 * Returns the last key in an array
	 *
	 * @param   array  $array  The array
	 * @return  int|string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function array_last_key( array $array ) {

		end( $array );

		return key( $array );
	}

	/**
	 * Flattens a potentially multi-dimensional array into a one
	 * dimensional array
	 *
	 * @param   array  $array         The array to flatten
	 * @param   bool   preserve_keys  Whether or not to preserve array
	 *                                keys. Keys from deeply nested arrays
	 *                                will overwrite keys from shallowy
	 *                                nested arrays
	 * @return  array
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function array_flatten( array $array, $preserve_keys = TRUE ) {

		$flattened = array();

		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$flattened = array_merge( $flattened, self::array_flatten( $value, $preserve_keys ) );
			} else {
				if ( $preserve_keys ) {
					$flattened[$key] = $value;
				} else {
					$flattened[] = $value;
				}
			}
		}

		return $flattened;
	}

	/**
	 * Returns an array containing all the elements of arr1 after applying
	 * the callback function to each one
	 *
	 * @param   string  $callback      Callback function to run for each
	 *                                 element in each array
	 * @param   array   $array         An array to run through the callback
	 *                                 function
	 * @param   bool    $on_nonscalar  Whether or not to call the callback
	 *                                 function on nonscalar values
	 *                                 (Objects, resources, etc)
	 * @return  array
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function array_map_deep( array $array, $callback, $on_nonscalar = FALSE ) {

		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$args = array( $value, $callback, $on_nonscalar );
				$array[$key] = call_user_func_array( array( __CLASS__, __FUNCTION__ ), $args );
			} else if ( is_scalar( $value ) || $on_nonscalar ) {
				$array[$key] = call_user_func( $callback, $value );
			}
		}

		return $array;
	}
   
}