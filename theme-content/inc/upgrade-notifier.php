<?php
/**************************************************************
* *
* Provides a notification to the user everytime *
* your WordPress theme is updated *
* *
* Based on the work of Joao Araujo *
* Profile: http://themeforest.net/user/unisphere *
* Follow me: http://twitter.com/unispheredesign *
* *
**************************************************************/

// Constants for the theme name, folder and remote XML url
define( 'NOTIFIER_THEME_NAME', wpgrade::themename() ); // The theme name
define( 'NOTIFIER_THEME_SHORTNAME', wpgrade::shortname() ); // The theme name
define( 'NOTIFIER_XML_FILE', 'http://pixelgrade.com/updates/'. wpgrade::shortname() .'.xml' ); // The remote notifier XML file containing the latest version of the theme and changelog
define( 'NOTIFIER_CACHE_INTERVAL', 10800 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)
define ('WPGRADE_UPDATE_PAGE_NAME', 'theme-update-notifier');


add_action('admin_enqueue_scripts', 'wpGrade_theme_update_admin_init');

/**
 * Enqueues the JavaScript files needed depending on the current section.
 */
function wpGrade_theme_update_admin_init(){
	if(isset($_GET['page']) && ($_GET['page']=='theme-update-notifier')){
		//enqueue the scripts for the Update notifier page
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('wpgrade-update',WPGRADE_SCRIPT_URL.'update-notifier.js');

		//enqueue the styles for the Update notifier page
		wp_enqueue_style('wpgrade-page-style',WPGRADE_CSS_URL.'page_style.css');
		wp_enqueue_style('wpgrade-update-style',WPGRADE_CSS_URL.'update-notifier.css');
	}

}

// Adds an update notification to the WordPress Dashboard menu
function update_notifier_menu() {
	if (wpgrade::option('themeforest_upgrade'))
	{
		if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
			$newversion=wpGrade_check_if_new_version();

			$count = (isset($_GET['wpGrade_update']) &&  $_GET['wpGrade_update']=='true')?'':'<span class="update-plugins count-1"><span class="update-count">1</span></span>';
			if($newversion) { // Compare current theme version with the remote XML version
				add_dashboard_page( NOTIFIER_THEME_NAME . ' Theme Updates', NOTIFIER_THEME_NAME . ' Update '.$count, 'administrator', WPGRADE_UPDATE_PAGE_NAME, 'update_notifier');
			}
		}
	}
}
add_action('admin_menu', 'update_notifier_menu');

function wpGrade_check_if_new_version(){
	$xml = get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server

	if (version_compare($xml->latest, wpgrade::themeversion()) == 1){
		return true;
	} else {
		return false;
	}
}

// Adds an update notification to the Admin Bar
function update_notifier_bar_menu() {
	if (wpgrade::option('themeforest_upgrade'))
	{
		if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
			global $wp_admin_bar, $wpdb;

			if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
			return;

			$newversion=wpGrade_check_if_new_version();

			if($newversion) { // Compare current theme version with the remote XML version
				$wp_admin_bar->add_menu( array( 'id' => 'update_notifier', 'title' => '<span>' . NOTIFIER_THEME_NAME . ' <span id="ab-updates">New Updates</span></span>', 'href' => get_admin_url() . 'index.php?page=theme-update-notifier' ) );
			}
		}
	}
}
add_action( 'admin_bar_menu', 'update_notifier_bar_menu', 1000 );

// The notifier page - where the magic happens
function update_notifier() {
	$xml = get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
	$theme_data = wp_get_theme(); // Read theme current version from the style.css
	$options_url= admin_url('index.php?page='.WPGRADE_UPDATE_PAGE_NAME.'&wpGrade_update=true'); ?>

	<script type="text/javascript">
	var wpGradeUpdateData = {
		optionsLink: "<?php echo $options_url; ?>",
		envatoDetails: <?php if (wpgrade::option('marketplace_username') && wpgrade::option('marketplace_api_key')) { echo "true"; } else { echo "false" ; } ?>
	};
	</script>

	<div class="wrap">

	<div id="icon-tools" class="icon32"></div>
	<h2><?php echo NOTIFIER_THEME_NAME ?> Theme Updates</h2>

	<?php if(!(isset($_GET['wpGrade_update']) &&  $_GET['wpGrade_update']=='true')){ ?>
	<div id="message" class="updated below-h2"><p><strong><?php echo $xml->message; ?></strong> You have version <?php echo $theme_data->Version; ?> installed. Please update to version <?php echo $xml->latest; ?>.</p></div>


	<div id="instructions">
	<div class="two-columns">
		<h3>Automatic Update Instructions</h3>
		<b>Important: </b><i>Please note that with the automatic theme update <b>any code modifications</b> done in the theme's code <b>will be lost</b>, so please
				 make sure you have a <b>backup copy of the theme files</b> before you update the theme. </i>
		<p>In order to use this functionality, you have to:<br/>
		1. Go to <strong><?php echo NOTIFIER_THEME_NAME; ?> Options &raquo; Theme Auto Update</strong> section and input your <b>ThemeForest/Envato Marketplace username</b> and <b>API Key</b> in the corresponding fields. <br/>
		2. Make sure that the <b>name of the folder</b> that contains the theme files is called <b>"<?php echo NOTIFIER_THEME_SHORTNAME; ?>"</b>. This is the default folder name, so if you haven't modified it manually, the name of the folder on your server should be called "<?php echo NOTIFIER_THEME_SHORTNAME; ?>"</p>

		<div id="confirm-update" title="Theme Update">Are you sure you want to update the theme and replace all your current theme files with the new updated files?</div>
		<div id="no-details" title="Almost There">You haven't inserted your Marketplace username and API Key - please go to the <a href="<?php echo admin_url().'admin.php?page='.NOTIFIER_THEME_SHORTNAME.'_options'; ?>"><b><?php echo NOTIFIER_THEME_NAME; ?> Options</b></a> page and input the required data in the <b>"Theme Auto Update"</b> section.</div>
		<a href="" class="button-primary" id="update-btn">Automatically Update Theme</a>
	</div>

	<div class="two-columns no-margin">
		<h3>Manual Update Instructions</h3>
		<p><b>It is recommended to manually install the update if you have done some modifications to the theme's code.</b> If so, first create
			a backup copy of the current theme you have installed and modified and then you can proceed with installing the update.</p>
		<a id="manual-instructions-btn" class="button-primary">View Update Instructions</a>
		<div id="manual-instructions" title="Manual Update Instructions">
		<p>To download the latest update of the theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>Downloads</strong> section in your profile and download again the theme like you did when you bought it.</p>
		<p>There are two main ways of installing an update manually:</p>
		<ol>
		<li><i><b>By uploading the theme as a new theme (recommended)</b></i>- this is the easiest way to accomplish this. You just have to upload
		the updated theme zip file via the built in WordPress theme uploader as a new theme from the Appearance &raquo; Themes &raquo; Install Themes &raquo; Upload section.

		<div class="note_box">
			<b>Note: </b><i>Please note that when activating the new theme it is possible that your menu settings are not kept for the new theme. If so, you just have to go to Appearance &raquo; Menus &raquo; Theme Locations, select the menu (it is still there) and press the "Save" button</i>.
		</div>
		</li>
		<li><i><b>Via FTP</b></i> - you have to first unzip the zipped theme file and then you can use an FTP client (such as <a href="http://filezilla-project.org/download.php">FileZilla</a>) and replace all the theme files with the updated ones.

		<div class="note_box">
			<b>Note: </b><i>Please note that with the file replacing all the code changes you have made to the files (if you have made any) will be lost, so please make sure you have a backup copy of the theme files before you do the replacement. All the settings you have made from the Admin panel (Theme Options and other places) won't be lost- they will still be available.</i>
		</div>

		</li>
		</ol>
		</div>
	</div>
	<div class="clear"></div>
	<p>For more information about auto updates, please refer to the "Updates" section of the documentation included.</p>
	<br />
	</div>
	<?php } ?>
	<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div><h2 class="title" id="changes-title">Update Changes</h2>
		<div id="changelog">
	<?php echo $xml->changelog; ?>
	</div>
	</div>
<?php
}

// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function get_latest_theme_version($interval) {
	$notifier_file_url = NOTIFIER_XML_FILE;
	$db_cache_field = 'notifier-cache-'.NOTIFIER_THEME_SHORTNAME;
	$db_cache_field_last_updated = 'notifier-cache-last-updated-'.NOTIFIER_THEME_SHORTNAME;
	$last = get_option( $db_cache_field_last_updated );
	$now = time();

	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it

		$res = wp_remote_get( $notifier_file_url );
		$cache=wp_remote_retrieve_body($res);

		if ($cache) {
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}


	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down

	if( strpos((string)$notifier_data, '<notifier>') === false ) {
	$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
	}

	// Load the remote XML data into a variable and return it
	$xml = simplexml_load_string($notifier_data);
	return $xml;
}

/*
 * Here is where the magic happens - the actual update
 */

add_action('admin_init', 'wpGrade_set_update_functionality');

function wpGrade_set_update_functionality(){
	global $wpGrade_data;
	if (wpgrade::option('themeforest_upgrade') && isset($_GET['wpGrade_update']) &&  $_GET['wpGrade_update']=='true')
	{
		$theme_data = wp_get_theme();
		$theme_name = $theme_data->Name;
		$allow_cache=true;
		// include the library
		include_once('vendor/envato-wtl/class-envato-wordpress-theme-upgrader.php');
		$marketplace_username = wpgrade::option('marketplace_username');
		$marketplace_api_key = wpgrade::option('marketplace_api_key');

		if (!empty($marketplace_username) && !empty($marketplace_api_key))
		{
			if (in_array  ('curl', get_loaded_extensions())){
				//cURL is enabled, the Envato Toolkit uses cURL, so the update can be performed
				$upgrader = new Envato_WordPress_Theme_Upgrader( $marketplace_username, $marketplace_api_key );
				$upgrader->check_for_theme_update($theme_name, $allow_cache);
				$res = $upgrader->upgrade_theme($theme_name, $allow_cache);
				$success = $res->success;
				$wpGrade_data->theme_updated = $success;

				//make sure the nag notices appear again
				delete_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice' );

				if (isset($res->errors)) {
					$wpGrade_data->theme_update_error = $res->errors;
				}
			}else{
				$wpGrade_data->curl_disabled = true;
			}
		}
	}
}


add_action('admin_notices', 'wpGrade_update_notice' );
/*
 * Let the user know what is happening and if everything went well
 */
function wpGrade_update_notice(){
	global $wpGrade_data;
	if (wpgrade::option('themeforest_upgrade'))
	{
		$message_type="updated";

		if(isset($wpGrade_data->theme_updated) && isset($_GET['wpGrade_update']) &&  $_GET['wpGrade_update']=='true'){
			if($wpGrade_data->theme_updated){
				$message = 'The theme has been updated successfully';
			}else{
				$message = 'An error occurred, the theme has not been updated. Please try again later or install the update manually.';
				if (isset($wpGrade_data->theme_update_error) && isset($wpGrade_data->theme_update_error[1])) {
					$message .= '<br/>(Error message: '.$wpGrade_data->theme_update_error[1].')';
				}
				$message_type = "error";
			}
		}elseif(isset($wpGrade_data->curl_disabled) && $wpGrade_data->curl_disabled){
			$message = 'Error: The theme was not updated, because the cURL extension is not enabled on your server. In order to update the theme automatically, the Envato Toolkit Library requires cURL to be enabled on your server. You can contact your hosting provider to enable this extension for you.';
			$message_type = "error";
		}

		if(isset($message)){
			echo '<div class="'.$message_type.'"><p>'.$message.'</p></div>';
		}
	}
}
