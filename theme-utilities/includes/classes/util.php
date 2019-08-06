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

	static function limit_words($string, $word_limit, $more_text = ' [&hellip;]') {
		$words = explode(" ",$string);
		$output = implode(" ",array_splice($words,0,$word_limit));
		
		//check if we actually cut something
		if (count($words) > $word_limit) {
			$output .= $more_text;
		}
		
		return $output;
	}

	static function get_latest_twelve_monts( $start_month = '' ){

		if (!empty($start_month)) {
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
	static function array_get( & $var, $default = NULL )
	{
		if ( isset( $var ) ) {
			return $var;
		} else {
			return $default;
		}
	}

	/**
	 * Display a variable's contents using nice HTML formatting and will
	 * properly display the value of booleans as true or false
	 *
	 * @param   mixed  $var  The variable to dump
	 * @return  string
	 *
	 * @see     var_dump_plain()
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function var_dump( $var, $return = FALSE )
	{
		$html = '<pre style="margin-bottom: 18px;' .
			'background: #f7f7f9;' .
			'border: 1px solid #e1e1e8;' .
			'padding: 8px;' .
			'border-radius: 4px;' .
			'-moz-border-radius: 4px;' .
			'-webkit-border radius: 4px;' .
			'display: block;' .
			'font-size: 12.05px;' .
			'white-space: pre-wrap;' .
			'word-wrap: break-word;' .
			'color: #333;' .
			'font-family: Menlo,Monaco,Consolas,\'Courier New\',monospace;">';
		$html .= self::var_dump_plain( $var );
		$html .= '</pre>';

		if ( ! $return ) {
			echo $html;
		} else {
			return $html;
		}
	}

	/**
	 * Display a variable's contents using nice HTML formatting (Without
	 * the <pre> tag) and will properly display the values of variables
	 * like booleans and resources. Supports collapsable arrays and objects
	 * as well.
	 *
	 * @param   mixed  $var  The variable to dump
	 * @return  string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function var_dump_plain( $var )
	{
		$html = '';

		if ( is_bool( $var ) ) {
			$html .= '<span style="color:#588bff;">bool</span><span style="color:#999;">(</span><strong>' . ( ( $var ) ? 'true' : 'false' ) . '</strong><span style="color:#999;">)</span>';
		} else if ( is_int( $var ) ) {
			$html .= '<span style="color:#588bff;">int</span><span style="color:#999;">(</span><strong>' . $var . '</strong><span style="color:#999;">)</span>';
		} else if ( is_float( $var ) ) {
			$html .= '<span style="color:#588bff;">float</span><span style="color:#999;">(</span><strong>' . $var . '</strong><span style="color:#999;">)</span>';
		} else if ( is_string( $var ) ) {
			$html .= '<span style="color:#588bff;">string</span><span style="color:#999;">(</span>' . strlen( $var ) . '<span style="color:#999;">)</span> <strong>"' . self::htmlentities( $var ) . '"</strong>';
		} else if ( is_null( $var ) ) {
			$html .= '<strong>NULL</strong>';
		} else if ( is_resource( $var ) ) {
			$html .= '<span style="color:#588bff;">resource</span>("' . get_resource_type( $var ) . '") <strong>"' . $var . '"</strong>';
		} else if ( is_array( $var ) ) {
			$uuid = 'include-php-' . uniqid();

			$html .= '<span style="color:#588bff;">array</span>(' . count( $var ) . ')';

			if ( ! empty( $var ) ) {
				$html .= '<br /><span id="' . $uuid . '-collapsable">[<br />';

				$indent = 4;
				$longest_key = 0;

				foreach( $var as $key => $value ) {
					if ( is_string( $key ) ) {
						$longest_key = max( $longest_key, strlen( $key ) + 2 );
					} else {
						$longest_key = max( $longest_key, strlen( $key ) );
					}
				}

				foreach ( $var as $key => $value ) {
					if ( is_numeric( $key ) ) {
						$html .= str_repeat( ' ', $indent ) . str_pad( $key, $longest_key, ' ');
					} else {
						$html .= str_repeat( ' ', $indent ) . str_pad( '"' . self::htmlentities( $key ) . '"', $longest_key, ' ' );
					}

					$html .= ' => ';

					$value = explode( '<br />', self::var_dump_plain( $value ) );

					foreach ( $value as $line => $val ) {
						if ( $line != 0 ) {
							$value[$line] = str_repeat( ' ', $indent * 2 ) . $val;
						}
					}

					$html .= implode( '<br />', $value ) . '<br />';
				}

				$html .= ']</span>';

				$html .= preg_replace( '/ +/', ' ', '<script type="text/javascript">(function() {
				var img = document.getElementById("' . $uuid . '");
				img.onclick = function() {
					if ( document.getElementById("' . $uuid . '-collapsable").style.display == "none" ) {
						document.getElementById("' . $uuid . '-collapsable").style.display = "inline";
						img.src = img.getAttribute("data-collapse");
						var previousSibling = document.getElementById("' . $uuid . '-collapsable").previousSibling;

						while ( previousSibling != null && ( previousSibling.nodeType != 1 || previousSibling.tagName.toLowerCase() != "br" ) ) {
							previousSibling = previousSibling.previousSibling;
						}

						if ( previousSibling != null && previousSibling.tagName.toLowerCase() == "br" ) {
							previousSibling.style.display = "inline";
						}
					} else {
						document.getElementById("' . $uuid . '-collapsable").style.display = "none";
						img.setAttribute( "data-collapse", img.getAttribute("src") );
						img.src = img.getAttribute("data-expand");
						var previousSibling = document.getElementById("' . $uuid . '-collapsable").previousSibling;

						while ( previousSibling != null && ( previousSibling.nodeType != 1 || previousSibling.tagName.toLowerCase() != "br" ) ) {
							previousSibling = previousSibling.previousSibling;
						}

						if ( previousSibling != null && previousSibling.tagName.toLowerCase() == "br" ) {
							previousSibling.style.display = "none";
						}
					}
				};
				})();
				</script>' );
			}
		} else if ( is_object( $var ) ) {
			$uuid = 'include-php-' . uniqid();

			$html .= '<span style="color:#588bff;">object</span>(' . get_class( $var ) . ') <img id="' . $uuid . '" data-expand="data:image/png;base64,' . self::$icon_expand . '" style="position:relative;left:-5px;top:-1px;cursor:pointer;" src="data:image/png;base64,' . self::$icon_collapse . '" /><br /><span id="' . $uuid . '-collapsable">[<br />';

			$original = $var;
			$var = (array) $var;

			$indent = 4;
			$longest_key = 0;

			foreach( $var as $key => $value ) {
				if ( substr( $key, 0, 2 ) == "\0*" ) {
					unset( $var[$key] );
					$key = 'protected:' . substr( $key, 2 );
					$var[$key] = $value;
				} else if ( substr( $key, 0, 1 ) == "\0" ) {
					unset( $var[$key] );
					$key = 'private:' . substr( $key, 1, strpos( substr( $key, 1 ), "\0" ) ) . ':' . substr( $key, strpos( substr( $key, 1 ), "\0" ) + 1 );
					$var[$key] = $value;
				}

				if ( is_string( $key ) ) {
					$longest_key = max( $longest_key, strlen( $key ) + 2 );
				} else {
					$longest_key = max( $longest_key, strlen( $key ) );
				}
			}

			foreach ( $var as $key => $value ) {
				if ( is_numeric( $key ) ) {
					$html .= str_repeat( ' ', $indent ) . str_pad( $key, $longest_key, ' ');
				} else {
					$html .= str_repeat( ' ', $indent ) . str_pad( '"' . self::htmlentities( $key ) . '"', $longest_key, ' ' );
				}

				$html .= ' => ';

				$value = explode( '<br />', self::var_dump_plain( $value ) );

				foreach ( $value as $line => $val ) {
					if ( $line != 0 ) {
						$value[$line] = str_repeat( ' ', $indent * 2 ) . $val;
					}
				}

				$html .= implode( '<br />', $value ) . '<br />';
			}

			$html .= ']</span>';

			$html .= preg_replace( '/ +/', ' ', '<script type="text/javascript">(function() {
			var img = document.getElementById("' . $uuid . '");
			img.onclick = function() {
				if ( document.getElementById("' . $uuid . '-collapsable").style.display == "none" ) {
					document.getElementById("' . $uuid . '-collapsable").style.display = "inline";
					img.src = img.getAttribute("data-collapse");
					var previousSibling = document.getElementById("' . $uuid . '-collapsable").previousSibling;

					while ( previousSibling != null && ( previousSibling.nodeType != 1 || previousSibling.tagName.toLowerCase() != "br" ) ) {
						previousSibling = previousSibling.previousSibling;
					}

					if ( previousSibling != null && previousSibling.tagName.toLowerCase() == "br" ) {
						previousSibling.style.display = "inline";
					}
				} else {
					document.getElementById("' . $uuid . '-collapsable").style.display = "none";
					img.setAttribute( "data-collapse", img.getAttribute("src") );
					img.src = img.getAttribute("data-expand");
					var previousSibling = document.getElementById("' . $uuid . '-collapsable").previousSibling;

					while ( previousSibling != null && ( previousSibling.nodeType != 1 || previousSibling.tagName.toLowerCase() != "br" ) ) {
						previousSibling = previousSibling.previousSibling;
					}

					if ( previousSibling != null && previousSibling.tagName.toLowerCase() == "br" ) {
						previousSibling.style.display = "none";
					}
				}
			};
			})();
			</script>' );
		}

		return $html;
	}

	/**
	 * Converts any accent characters to their equivalent normal characters
	 * and converts any other non-alphanumeric characters to dashes, then
	 * converts any sequence of two or more dashes to a single dash. This
	 * function generates slugs safe for use as URLs, and if you pass TRUE
	 * as the second parameter, it will create strings safe for use as CSS
	 * classes or IDs
	 *
	 * @param   string  $string    A string to convert to a slug
	 * @param   bool    $css_mode  Whether or not to generate strings safe
	 *                             for CSS classes/IDs (Default to false)
	 * @return  string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function slugify( $string, $css_mode = FALSE )
	{
		$slug = preg_replace( '/([^a-z0-9]+)/', '-', strtolower( self::remove_accents( $string ) ) );

		if ( $css_mode ) {
			$digits = array( 'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine' );

			if ( is_numeric( substr( $slug, 0, 1 ) ) ) {
				$slug = $digits[substr( $slug, 0, 1 )] . substr( $slug, 1 );
			}
		}

		return $slug;
	}

	/**
	 * Checks to see if a string is utf8 encoded.
	 *
	 * NOTE: This function checks for 5-Byte sequences, UTF8
	 *       has Bytes Sequences with a maximum length of 4.
	 *
	 * @param   string  $string  The string to be checked
	 * @return  bool
	 *
	 * @link    https://github.com/facebook/libphutil/blob/master/src/utils/utf8.php
	 *
	 * @access  public
	 * @author  bmorel@ssi.fr
	 * @since   1.0.000
	 * @static
	 */
	static function seems_utf8( $string )
	{
		if ( function_exists( 'mb_check_encoding' ) ) {
			// If mbstring is available, this is significantly faster than
			// using PHP regexps.
			return mb_check_encoding( $string, 'UTF-8' );
		}

		$regex = '/(
| [\xF8-\xFF] # Invalid UTF-8 Bytes
| [\xC0-\xDF](?![\x80-\xBF]) # Invalid UTF-8 Sequence Start
| [\xE0-\xEF](?![\x80-\xBF]{2}) # Invalid UTF-8 Sequence Start
| [\xF0-\xF7](?![\x80-\xBF]{3}) # Invalid UTF-8 Sequence Start
| (?<=[\x0-\x7F\xF8-\xFF])[\x80-\xBF] # Invalid UTF-8 Sequence Middle
| (?<![\xC0-\xDF]|[\xE0-\xEF]|[\xE0-\xEF][\x80-\xBF]|[\xF0-\xF7]|[\xF0-\xF7][\x80-\xBF]|[\xF0-\xF7][\x80-\xBF]{2})[\x80-\xBF] # Overlong Sequence
| (?<=[\xE0-\xEF])[\x80-\xBF](?![\x80-\xBF]) # Short 3 byte sequence
| (?<=[\xF0-\xF7])[\x80-\xBF](?![\x80-\xBF]{2}) # Short 4 byte sequence
| (?<=[\xF0-\xF7][\x80-\xBF])[\x80-\xBF](?![\x80-\xBF]) # Short 4 byte sequence (2)
)/x';

		return ! preg_match( $regex, $string );
	}

	/**
	 * Nice formatting for computer sizes (Bytes)
	 *
	 * @param   int  $bytes     The number in bytes to format
	 * @param   int  $decimals  The number of decimal points to include
	 * @return  string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function size_format( $bytes, $decimals = 0 )
	{
		$bytes = floatval( $bytes );

		if ( $bytes < 1024 ) {
			return $bytes . ' B';
		} else if ( $bytes < pow( 1024, 2 ) ) {
			return number_format( $bytes / 1024, $decimals, '.', '' ) . ' KiB';
		} else if ( $bytes < pow( 1024, 3 ) ) {
			return number_format( $bytes / pow( 1024, 2 ), $decimals, '.', '' ) . ' MiB';
		} else if ( $bytes < pow( 1024, 4 ) ) {
			return number_format( $bytes / pow( 1024, 3 ), $decimals, '.', '' ) . ' GiB';
		} else if ( $bytes < pow( 1024, 5 ) ) {
			return number_format( $bytes / pow( 1024, 4 ), $decimals, '.', '' ) . ' TiB';
		} else if ( $bytes < pow( 1024, 6 ) ) {
			return number_format( $bytes / pow( 1024, 5 ), $decimals, '.', '' ) . ' PiB';
		} else {
			return number_format( $bytes / pow( 1024, 5 ), $decimals, '.', '' ) . ' PiB';
		}
	}

	/**
	 * Serialize data, if needed.
	 *
	 * @param   mixed  $data  Data that might need to be serialized
	 * @return  mixed
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/maybe_serialize
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function maybe_serialize( $data )
	{
		if ( is_array( $data ) || is_object( $data ) ) {
			return serialize( $data );
		}

		return $data;
	}

	/**
	 * Check value to find if it was serialized.
	 *
	 * If $data is not an string, then returned value will always be false.
	 * Serialized data is always a string.
	 *
	 * @param   mixed  $data  Value to check to see if was serialized
	 * @return  bool
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/is_serialized
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function is_serialized( $data )
	{
		// If it isn't a string, it isn't serialized
		if ( ! is_string( $data ) ) {
			return FALSE;
		}

		$data = trim( $data );

		if ( 'N;' == $data ) {
			return TRUE;
		}

		$length = strlen( $data );

		if ( $length < 4 ) {
			return FALSE;
		}

		if ( ':' !== $data[1] ) {
			return FALSE;
		}

		$lastc = $data[$length - 1];

		if ( ';' !== $lastc && '}' !== $lastc ) {
			return FALSE;
		}

		$token = $data[0];

		switch ( $token ) {
			case 's' :
				if ( '"' !== $data[$length-2] ) {
					return FALSE;
				}
			case 'a' :
			case 'O' :
				return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
			case 'b' :
			case 'i' :
			case 'd' :
				return (bool) preg_match( "/^{$token}:[0-9.E-]+;\$/", $data );
		}

		return FALSE;
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
	static function is_https()
	{
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
	static function add_query_arg()
	{
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
		$qs = self::array_map_deep( $qs, 'urlencode' );

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
	 * Removes an item or list from the query string.
	 *
	 * @param   string|array  $keys  Query key or keys to remove.
	 * @param   bool          $uri   When false uses the $_SERVER value
	 * @return  string
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/remove_query_arg
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function remove_query_arg( $keys, $uri = FALSE )
	{
		if ( is_array( $keys ) ) {
			foreach ( $keys as $key ) {
				$uri = self::add_query_arg( $key, FALSE, $uri );
			}

			return $uri;
		}

		return self::add_query_arg( $keys, FALSE, $uri );
	}

	/**
	 * Converts many english words that equate to true or false to boolean
	 *
	 * Supports 'y', 'n', 'yes', 'no' and a few other variations
	 *
	 * @param   string  $string   The string to convert to boolean
	 * @param   bool    $default  The value to return if we can't match any
	 *                            yes/no words
	 * @return  bool
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function str_to_bool( $string, $default = FALSE )
	{
		$yes_words = 'affirmative|all right|aye|indubitably|most assuredly|ok|of course|okay|sure thing|y|yes+|yea|yep|sure|yeah|true|t|on|1';
		$no_words = 'no*|no way|nope|nah|na|never|absolutely not|by no means|negative|never ever|false|f|off|0';

		if ( preg_match( '/^(' . $yes_words . ')$/i', $string ) ) {
			return TRUE;
		} else if ( preg_match( '/^(' . $no_words . ')$/i', $string ) ) {
			return FALSE;
		} else {
			return $default;
		}
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
	static function htmlentities( $string, $preserve_encoded_entities = FALSE )
	{
		if ( $preserve_encoded_entities ) {
			$translation_table = get_html_translation_table( HTML_ENTITIES, ENT_QUOTES, mb_internal_encoding() );
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
	static function htmlspecialchars( $string, $preserve_encoded_entities = FALSE  )
	{
		if ( $preserve_encoded_entities ) {
			$translation_table            = get_html_translation_table( HTML_SPECIALCHARS, ENT_QUOTES, mb_internal_encoding() );
			$translation_table[chr( 38 )] = '&';

			return preg_replace( '/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,3};)/', '&amp;', strtr( $string, $translation_table ) );
		} else {
			return htmlentities( $string, ENT_QUOTES, mb_internal_encoding() );
		}
	}

	/**
	 * Pads a given string with zeroes on the left
	 *
	 * @param   int  $number  The number to pad
	 * @param   int  $length  The total length of the desired string
	 * @return  string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function zero_pad( $number, $length )
	{
		return str_pad( $number, $length, '0', STR_PAD_LEFT );
	}

	/**
	 * Transmit UTF-8 content headers if the headers haven't already been
	 * sent
	 *
	 * @param   string  $content_type  The content type to send out,
	 *                                 defaults to text/html
	 * @return  bool
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function utf8_headers( $content_type = 'text/html' )
	{
		if ( ! headers_sent() ) {
			header( 'Content-type: ' . $content_type . '; charset=utf-8' );

			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Sets the headers to prevent caching for the different browsers
	 *
	 * Different browsers support different nocache headers, so several
	 * headers must be sent so that all of them get the point that no
	 * caching should occur
	 *
	 * @return  bool
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function nocache_headers()
	{
		if ( ! headers_sent() ) {
			header( 'Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
			header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
			header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
			header( 'Pragma: no-cache' );

			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Generates a string of random characters
	 *
	 * @param   int   $length              The length of the string to
	 *                                     generate
	 * @param   bool  $human_friendly      Whether or not to make the
	 *                                     string human friendly by
	 *                                     removing characters that can be
	 *                                     confused with other characters (
	 *                                     O and 0, l and 1, etc)
	 * @param   bool  $include_symbols     Whether or not to include
	 *                                     symbols in the string. Can not
	 *                                     be enabled if $human_friendly is
	 *                                     true
	 * @param   bool  $no_duplicate_chars  Whether or not to only use
	 *                                     characters once in the string.
	 * @return  string
	 *
	 * @throws  LengthException  If $length is bigger than the available
	 *                           character pool and $no_duplicate_chars is
	 *                           enabled
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function random_string( $length, $human_friendly = TRUE, $include_symbols = FALSE, $no_duplicate_chars = FALSE )
	{
		$nice_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefhjkmnprstuvwxyz23456789';
		$all_an     = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		$symbols    = '!@#$%^&*()~_-=+{}[]|:;<>,.?/"\'\\`';
		$string     = '';

		// Determine the pool of available characters based on the given parameters
		if ( $human_friendly ) {
			$pool = $nice_chars;
		} else {
			$pool = $all_an;

			if ( $include_symbols ) {
				$pool .= $symbols;
			}
		}

		// Don't allow duplicate letters to be disabled if the length is
		// longer than the available characters
		if ( $no_duplicate_chars && strlen( $pool ) < $length ) {
			throw new LengthException( '$length exceeds the size of the pool and $no_duplicate_chars is enabled' );
		}

		// Convert the pool of characters into an array of characters and
		// shuffle the array
		$pool = str_split( $pool );
		shuffle( $pool );

		// Generate our string
		for ( $i = 0; $i < $length; $i++ ) {
			if ( $no_duplicate_chars ) {
				$string .= array_shift( $pool );
			} else {
				$string .= $pool[0];
				shuffle( $pool );
			}
		}

		return $string;
	}

	/**
	 * Validate an email address
	 *
	 * @param   string  $possible_email  An email address to validate
	 * @return  bool
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function validate_email( $possible_email )
	{
		return (bool) filter_var( $possible_email, FILTER_VALIDATE_EMAIL );
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
	static function get_gravatar( $email, $size = 32 )
	{
		if ( self::is_https() ) {
			$url = 'https://secure.gravatar.com/';
		} else {
			$url = 'http://www.gravatar.com/';
		}

		$url .= 'avatar/' . md5( $email ) . '?s=' . (int) abs( $size );

		return $url;
	}

	static function get_avatar_url($email, $size = 32){
		$get_avatar = get_avatar($email, $size);
		
		preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $get_avatar, $matches);
		if (isset($matches[1])) {
			return $matches[1];
		} else {
			return '';
		}

	}

	/**
	 * Return the current URL
	 *
	 * @return  string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function get_current_url()
	{
		$url = '';

		// Check to see if it's over https
		if ( self::is_https() ) {
			$url .= 'https://';
		} else {
			$url .= 'http://';
		}

		// Was a username or password passed?
		if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
			$url .= $_SERVER['PHP_AUTH_USER'];

			if ( isset( $_SERVER['PHP_AUTH_PW'] ) ) {
				$url .= ':' . $_SERVER['PHP_AUTH_PW'];
			}

			$url .= '@';
		}


		// We want the user to stay on the same host they are currently on,
		// but beware of security issues
		// see http://shiflett.org/blog/2006/mar/server-name-versus-http-host
		$url .= $_SERVER['HTTP_HOST'];

		// Is it on a non standard port?
		if ( $_SERVER['SERVER_PORT'] != 80 ) {
			$url .= ':' . $_SERVER['SERVER_PORT'];
		}

		// Get the rest of the URL
		if ( ! isset( $_SERVER['REQUEST_URI'] ) ) {

			// Microsoft IIS doesn't set REQUEST_URI by default
			$url .= substr( $_SERVER['PHP_SELF'], 1 );

			if ( isset( $_SERVER['QUERY_STRING'] ) ) {
				$url .= '?' . $_SERVER['QUERY_STRING'];
			}
		} else {
			$url .= $_SERVER['REQUEST_URI'];
		}

		return $url;
	}

	/**
	 * Truncate a string to a specified length without cutting a word off
	 *
	 * @param   string  $string  The string to truncate
	 * @param   int     $length  The length to truncate the string to
	 * @param   string  $append  Text to append to the string IF it gets
	 *                           truncated, defaults to '...'
	 * @return  string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function safe_truncate( $string, $length, $append = '...' )
	{
		$ret        = substr( $string, 0, $length );
		$last_space = strrpos( $ret, ' ' );

		if ( $last_space !== FALSE && $string != $ret ) {
			$ret     = substr( $ret, 0, $last_space );
		}

		if ( $ret != $string ) {
			$ret .= $append;
		}

		return $ret;
	}

	/**
	 * Returns the file permissions as a nice string, like -rw-r--r--
	 *
	 * @param   string  $file  The name of the file to get permissions form
	 * @return  string
	 *
	 * @access  public
	 * @since   1.0.000
	 * @static
	 */
	static function full_permissions( $file )
	{
		$perms = fileperms( $file );

		if ( ( $perms & 0xC000 ) == 0xC000 ) {
			// Socket
			$info = 's';
		} else if ( ( $perms & 0xA000 ) == 0xA000 ) {
			// Symbolic Link
			$info = 'l';
		} else if ( ( $perms & 0x8000 ) == 0x8000 ) {
			// Regular
			$info = '-';
		} else if ( ( $perms & 0x6000 ) == 0x6000 ) {
			// Block special
			$info = 'b';
		} else if ( ( $perms & 0x4000 ) == 0x4000 ) {
			// Directory
			$info = 'd';
		} else if ( ( $perms & 0x2000 ) == 0x2000 ) {
			// Character special
			$info = 'c';
		} else if ( ( $perms & 0x1000 ) == 0x1000 ) {
			// FIFO pipe
			$info = 'p';
		} else {
			// Unknown
			$info = 'u';
		}

		// Owner
		$info .= ( ( $perms & 0x0100 ) ? 'r' : '-' );
		$info .= ( ( $perms & 0x0080 ) ? 'w' : '-' );
		$info .= ( ( $perms & 0x0040 ) ?
					( ( $perms & 0x0800 ) ? 's' : 'x' ) :
					( ( $perms & 0x0800 ) ? 'S' : '-' ) );

		// Group
		$info .= ( ( $perms & 0x0020 ) ? 'r' : '-' );
		$info .= ( ( $perms & 0x0010 ) ? 'w' : '-' );
		$info .= ( ( $perms & 0x0008 ) ?
					( ( $perms & 0x0400 ) ? 's' : 'x' ) :
					( ( $perms & 0x0400 ) ? 'S' : '-' ) );

		// World
		$info .= ( ( $perms & 0x0004 ) ? 'r' : '-' );
		$info .= ( ( $perms & 0x0002 ) ? 'w' : '-' );
		$info .= ( ( $perms & 0x0001 ) ?
					( ( $perms & 0x0200 ) ? 't' : 'x' ) :
					( ( $perms & 0x0200 ) ? 'T' : '-' ) );

		return $info;
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
	static function array_first( array $array )
	{
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
	static function array_last( array $array )
	{
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
	static function array_first_key( array $array )
	{
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
	static function array_last_key( array $array )
	{
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
	static function array_flatten( array $array, $preserve_keys = TRUE )
	{
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
	static function array_map_deep( array $array, $callback, $on_nonscalar = FALSE )
	{
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