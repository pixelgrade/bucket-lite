<?php 

/**
 * Envato Theme Upgrader class to extend the WordPress Theme_Upgrader class.
 *
 * @package     Envato WordPress Updater
 * @author      Arman Mirkazemi, Derek Herman <derek@valendesigns.com>
 * @since       1.0
 */

include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
include_once( 'class-envato-protected-api.php' );
include_once( 'class-envato-backup.php' );

if ( class_exists( 'Theme_Upgrader' ) && ! class_exists( 'Envato_WordPress_Theme_Upgrader' ) ) {

    /**
     * Envato Wordpress Theme Upgrader class to extend the WordPress Theme_Upgrader class.
     *
     * @package     Envato WordPress Theme Upgrader Library
     * @author      Derek Herman <derek@valendesigns.com>, Arman Mirkazemi
     * @since       1.0
     */
    class Envato_WordPress_Theme_Upgrader extends Theme_Upgrader 
    {
        protected $api_key;
        protected $username;
        protected $api;
        protected $installation_feedback;
        
        public function __construct( $username, $api_key ) 
        {
            parent::__construct(new Envato_Theme_Installer_Skin($this));
        
            $this->constants();
        
            $this->installation_feedback = array();
            $this->username              = $username;
            $this->api_key               = $api_key;
            $this->api                   = new Envato_Protected_API( $this->username, $this->api_key );
        }
        
        /**
         * Checks for theme updates on ThemeForest marketplace
         *
         * @since   1.0
         * @access  public
         *
         * @param   string        Name of the theme. If not set checks for updates for the current theme. Default ''.
         * @param   bool          Allow API calls to be cached. Default true.
         * @return  object        A stdClass object.
         */ 
        public function check_for_theme_update( $theme_name = '', $allow_cache = true ) 
        {
            $result           = new stdClass();
            $purchased_themes = $this->api->wp_list_themes( $allow_cache );

            if ( $errors = $this->api->api_errors() ) 
            {
                $result->errors = array();
                foreach( $errors as $k => $v ) {
                    array_push( $result->errors , $v);
                }
            
                return $result;
            }
            
            if ( empty($theme_name) ) {
                $theme_temp = wp_get_theme();
				$theme_name = $theme_temp->Name;
            }
            
            $purchased_themes             = $this->filter_purchased_themes_by_name($purchased_themes, $theme_name);

            $themes_list = wp_get_themes();

            $result->updated_themes       = $this->get_updated_themes($themes_list, $purchased_themes);
            $result->updated_themes_count = count($result->updated_themes);
            
            return $result; 
        }
      
        /**
         * Upgrades theme to its latest version
         *
         * @since   1.0
         * @access  public
         *
         * @param   string        Name of the theme. If not set checks for updates for the current theme. Default ''.
         * @param   bool          Allow API calls to be cached. Default true.
         * @return  object        A stdClass object.
         */ 
        public function upgrade_theme( $theme_name = '', $allow_cache = true ) 
        {
            $result          = new stdClass();
            $result->success = false;

            if ( empty($theme_name) ) {
                $theme_temp = wp_get_theme();
				$theme_name = $theme_temp->Name;
            }

            $installed_theme = $this->is_theme_installed($theme_name);
            
            if ($installed_theme == null) {
                $result->errors = array("'$theme_name' theme is not installed");
                return $result;  
            }

            $purchased_themes = $this->api->wp_list_themes( $allow_cache );
            $marketplace_theme_data = null;

            if ( $errors = $this->api->api_errors() ) 
            {
                $result->errors = array();
                foreach( $errors as $k => $v ) {
                    array_push( $result->errors , $v);
                }
            
                return $result;
            }
            
            foreach( $purchased_themes as $purchased ) {
                if ( $this->is_matching_themes( $installed_theme, $purchased ) && $this->is_newer_version_available( $installed_theme['Version'], $purchased->version ) ) {
                    $marketplace_theme_data = $purchased;
                    break;
                }
            }
            
            if ( $marketplace_theme_data == null ) {
                $result->errors = array( "There is no update available for '$theme_name'" );
                return $result;  
            }
            
            $result->success               = $this->do_upgrade_theme( $installed_theme['Title'], $marketplace_theme_data->item_id);
            $result->installation_feedback = $this->installation_feedback;
            
            return $result;
        }
		
		public function backup_theme($theme) {
			return $this->_backup_theme($theme);
		}
      
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Void.
         */ 
        public function set_installation_message($message)
        {
            $this->installation_feedback[] = $message;
        }
        
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Array.
         */ 
        protected function filter_purchased_themes_by_name( $all_purchased_themes, $theme_name )
        {
            $result = $all_purchased_themes;
        
            if ( empty($theme_name) )
                return $result;
            
            for ( $i = count($result) - 1; $i >= 0; $i-- ) {
                $entry = $result[$i];
                if ( $entry->theme_name != $theme_name )
                    unset($result[$i]);
            }
            
            return $result;
        }
      
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Void.
         */ 
        protected function constants() 
        {
            define( 'ETU_MAX_EXECUTION_TIME' , 60 * 5);
			
			/**
			* Theme Backup Directory Path
			*/
		   define( 'EWPT_BACKUP_DIR', WP_CONTENT_DIR . '/envato-backups/' );

		   /**
			* Theme Backup Directory URL
			*/
		   define( 'EWPT_BACKUP_URL', WP_CONTENT_URL . '/envato-backups/' );

		   /**
			* Create a key for the .htaccess secure download link.
			*
			* @uses    NONCE_KEY     Defined in the WP root config.php
			*/
		   define( 'EWPT_SECURE_KEY', md5( NONCE_KEY ) );
        }
      
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Array.
         */ 
        protected function get_updated_themes($installed_themes, $purchased_themes)
        {
            $result = array();
        
            if ( count( $purchased_themes ) <= 0 ) {
                return $result;
            }
                
            foreach( $purchased_themes as $purchased ) 
            {
                foreach( $installed_themes as $installed => $installed_theme ) 
                {
                    if ( $this->is_matching_themes( $installed_theme, $purchased ) && $this->is_newer_version_available( $installed_theme['Version'], $purchased->version ) )
                    {
                        $installed_theme['envato-theme'] = $purchased;
                        array_push($result, $installed_theme);
                    }
                }
            }
            
            return $result;
        }
      
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Boolean.
         */ 
        protected function is_matching_themes($installed_theme, $purchased_theme)
        {
            return $installed_theme['Title'] == $purchased_theme->theme_name AND $installed_theme['Author Name'] == $purchased_theme->author_name;
        }
      
        protected function is_newer_version_available($installed_vesion, $latest_version)
        {
            return version_compare($installed_vesion, $latest_version, '<');
        }  

        protected function is_theme_installed($theme_name) 
        {
        	$installed_theme = wp_get_theme();

	        if (  is_child_theme() ) {
		        $installed_theme = wp_get_theme( $installed_theme->template );
	        }

            //our modification - get only the active theme
			if (strcmp($installed_theme['Name'], $theme_name) == 0) {
				return $installed_theme;
			}
            return null;
        }

        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Boolean.
         */ 
        protected function do_upgrade_theme( $installed_theme_name, $marketplace_theme_id ) 
        {
            $result   = false;
            $callback = array( &$this , '_http_request_args' );

            add_filter( 'http_request_args', $callback, 10, 1 );
            $result = $this->envato_upgrade( $installed_theme_name, $this->api->wp_download( $marketplace_theme_id ) );
            remove_filter( 'http_request_args', $callback );
            
            return $result;
        }
      
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Array.
         */ 
        public function _http_request_args($r) 
        {
            if ((int)ini_get("max_execution_time") <  ETU_MAX_EXECUTION_TIME)
            {
                set_time_limit( ETU_MAX_EXECUTION_TIME );
            }

            $r['timeout'] = ETU_MAX_EXECUTION_TIME;
            return $r;
        }    
        
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Void.
         */ 
        public function upgrade_strings() {
            parent::upgrade_strings();
            $this->strings['downloading_package'] = __( 'Downloading upgrade package from the Envato API&#8230;', wpgrade::textdomain() );
        }
  
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Void.
         */ 
        public function install_strings() {
            parent::install_strings();
            $this->strings['downloading_package'] = __( 'Downloading install package from the Envato API&#8230;', wpgrade::textdomain() );
        }
    
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Boolean.
         */ 
        public function envato_upgrade( $theme, $package ) {
            $this->init();
            $this->upgrade_strings();
  
            $options = array(
                'package' => $package,
                'destination' => WP_CONTENT_DIR . '/themes',
                'clear_destination' => true,
                'clear_working' => true,
                'hook_extra' => array(
                    'theme' => $theme
                )
            );
  
            $this->run( $options );
  
            if ( ! $this->result || is_wp_error($this->result) )
                return $this->result;
  
            return true;
        }
		
		/**
		* Backup an Envato theme.
		*
		* This function requires the template/theme slug
		* to locate and backup that theme.
		*
		* @access    private
		* @since     1.4
		*
		* @param     string    Template slug
		* @return    void
		*/
	   protected function _backup_theme( $theme ) {

		 $backup_errors = array();

		 $theme_backup = Envato_Backup::get_instance();

		 $theme_backup->path = EWPT_BACKUP_DIR;

		 $theme_backup->root = get_theme_root() . '/' . $theme . '/';

		 $theme_backup->archive_filename = strtolower( sanitize_file_name( $theme . '.backup.' . date( 'Y-m-d-H-i-s', time() + ( current_time( 'timestamp' ) - time() ) ) . '.zip' ) );

		 if ( ( ! is_dir( $theme_backup->path() ) && ( ! is_writable( dirname( $theme_backup->path() ) ) || ! mkdir( $theme_backup->path() ) ) ) || ! is_writable( $theme_backup->path() ) ) {
		   array_push( $backup_errors, 'Invalid backup path' );
		   return false;
		 }

		 if ( ! is_dir( $theme_backup->root() ) || ! is_readable( $theme_backup->root() ) ) {
		   array_push( $backup_errors, 'Invalid root path' );
		   return false;
		 }

		 $theme_backup->backup();

		 if ( file_exists( Envato_Backup::get_instance()->archive_filepath() ) ) {
		   return true;
		 } else {
		   return $backup_errors;
		 }
	   }

	   /**
		* Prepare the envato backup directory and .htaccess
		*
		* @access    private
		* @since     1.4
		*
		* @return    void
		*/
	   function _prepare_envato_backup() {

		 $path = EWPT_BACKUP_DIR;

		 /* Create the backups directory if it doesn't exist */
		 if ( is_writable( dirname( $path ) ) && ! is_dir( $path ) )
		   mkdir( $path, 0755 );

		 /* Secure the directory with a .htaccess file */
		 $htaccess = $path . '.htaccess';

		 $contents[]	= '# ' . __( 'This .htaccess file ensures that other people cannot download your backup files.', 'envato' );
		 $contents[] = '';
		 $contents[] = '<IfModule mod_rewrite.c>';
		 $contents[] = 'RewriteEngine On';
		 $contents[] = 'RewriteCond %{QUERY_STRING} !key=' . md5( EWPT_SECURE_KEY );
		 $contents[] = 'RewriteRule (.*) - [F]';
		 $contents[] = '</IfModule>';
		 $contents[] = '';

		 if ( ! file_exists( $htaccess ) && is_writable( $path ) && require_once( ABSPATH . '/wp-admin/includes/misc.php' ) )
		   insert_with_markers( $htaccess, 'EnvatoBackup', $contents );

	   }

	   /**
		* Get the backup directory path for a given theme.
		*
		* @access    private
		* @since     1.4
		*
		* @param     string        Theme slug.
		* @return    bool|string   Return the theme path or false.
		*/
	   protected function _get_theme_backup_dir( $theme ) {

		 $backup_path = EWPT_BACKUP_DIR;

		 if ( $handle = @opendir( $backup_path ) ) {
		   $files = array();
		   while ( false !== ( $file = readdir( $handle ) ) ) {
			 $temp_theme = reset( explode( '.', $file ) );
			 $temp_ext = end( explode( '.', $file ) );
			 if ( $temp_theme == $theme &&  $temp_ext == 'zip' ) {
			   $files[@filemtime( trailingslashit( $backup_path ) . $file )] = trailingslashit( $backup_path ) . $file;
			 }
		   }
		   closedir( $handle );
		   krsort( $files );
		 }

		 if ( isset( $files ) && ! empty( $files ) )
		   return array_shift( $files );

		 return false;
	   }

	   /**
		* Get the backup directory URI for a given theme.
		*
		* @uses      get_theme_backup_dir()
		*
		* @access    public
		* @since     1.4
		*
		* @param     string      Theme slug.
		* @return    bool|string Return the theme URI or false.
		*/
	   public function get_theme_backup_uri( $theme ) {

		 $theme_backup = $this->_get_theme_backup_dir( $theme );

		 if ( empty( $theme_backup ) )
		   return false;

		 $theme_backup_uri = str_replace( EWPT_BACKUP_DIR, EWPT_BACKUP_URL, $theme_backup );

		 if ( defined( 'EWPT_SECURE_KEY' ) ) {
		   $theme_backup_uri = $theme_backup_uri . '?key=' . md5( EWPT_SECURE_KEY );
		 }

		 if ( '' != $theme_backup_uri )
		   return $theme_backup_uri;

		 return false;
	   }
    }

    /**
     * Envato Theme Installer Skin class to extend the WordPress Theme_Installer_Skin class.
     *
     * @package     Envato WordPress Theme Upgrader Library
     * @author      Arman Mirkazemi
     * @since       1.0
     */
    class Envato_Theme_Installer_Skin extends Theme_Installer_Skin {
      
        protected $envato_theme_updater;
      
        function __construct($envato_theme_updater) 
        {
            parent::__construct();
            $this->envato_theme_updater = $envato_theme_updater;
        }
      
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Void.
         */ 
        function feedback($string) 
        {
            if ( isset( $this->upgrader->strings[$string] ) )
                $string = $this->upgrader->strings[$string];
      
            if ( strpos($string, '%') !== false ) {
                $args = func_get_args();
                $args = array_splice($args, 1);
                if ( !empty($args) )
                    $string = vsprintf($string, $args);
            }
            
            if ( empty($string) )
                return;
      
            $this->envato_theme_updater->set_installation_message($string);
        }
      
        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Void.
         */ 
        function header(){}

        /**
         * @since   1.0
         * @access  internal
         *
         * @return  array         Void.
         */ 
        function footer(){}
    }
    
}