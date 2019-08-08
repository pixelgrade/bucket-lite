<?php

/**
 * @package        wpgrade
 * @category       core
 * @author         Pixelgrade
 * @copyright  (c) 2013, Pixelgrade
 */
class WPGradeMeta {

	/** @var array metadat */
	protected $metadata = array();

	/**
	 * @param  array metadata
	 *
	 * @return PixcoreMeta
	 */
	static function instance( $metadata ) {
		$i           = new self;
		$i->metadata = $metadata;

		return $i;
	}

	/**
	 * @param string meta key
	 *
	 * @return boolean true if key exists, false otherwise
	 */
	function has( $key ) {
		return isset( $this->metadata[ $key ] );
	}

	/**
	 * @param  string key
	 * @param  mixed  default
	 *
	 * @return mixed
	 */
	function get( $key, $default = null ) {
		return $this->has( $key ) ? $this->metadata[ $key ] : $default;
	}

	/**
	 * @param  string key
	 * @param  mixed  value
	 *
	 * @return static $this
	 */
	function set( $key, $value ) {
		$this->metadata[ $key ] = $value;

		return $this;
	}

	/**
	 * If the key is currently a non-array value it will be converted to an
	 * array maintaning the previous value (along with the new one).
	 *
	 * @param  string name
	 * @param  mixed  value
	 *
	 * @return static $this
	 */
	function add( $name, $value ) {

		// Cleanup
		// -------

		if ( ! isset( $this->metadata[ $name ] ) ) {
			$this->metadata[ $name ] = array();
		} else if ( ! is_array( $this->metadata[ $name ] ) ) {
			$this->metadata[ $name ] = array( $this->metadata[ $name ] );
		}
		# else: array, no cleanup required

		// Register new value
		// ------------------

		$this->metadata[ $name ][] = $value;

		return $this;
	}

} # class
