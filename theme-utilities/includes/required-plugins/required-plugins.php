<?php

require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'wpgrade_register_required_plugins', 999 );

function wpgrade_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(
		array(
			'name'     				=> 'PixTypes',
			'slug'     				=> 'pixtypes',
			'required' 				=> true,
		),
		array(
			'name'     				=> 'PixCodes',
			'slug'     				=> 'pixcodes',
			'required' 				=> false,
		)
	);
	// Change this to your theme text domain, used for internationalising strings

	$config = array(
		'domain'            => 'bucket-lite',           // Text domain - likely want to be the same as your theme.
		'default_path'      => '',                           // Default absolute path to pre-packaged plugins
		'menu'              => 'install-required-plugins',   // Menu slug
		'has_notices'       => true,                         // Show admin notices or not
		'is_automatic'      => false,            // Automatically activate plugins after installation or not
		'message'           => '',               // Message to output right before the plugins table
		'strings'           => array(
			'page_title'                                => __( 'Install Required Plugins', 'bucket-lite' ),
			'menu_title'                                => __( 'Install Plugins', 'bucket-lite' ),
			'installing'                                => __( 'Installing Plugin: %s', 'bucket-lite' ), // %1$s = plugin name
			'oops'                                      => __( 'Something went wrong with the plugin API.', 'bucket-lite' ),
			'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'bucket-lite' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'bucket-lite' ), // %1$s = plugin name(s)
			'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'bucket-lite' ), // %1$s = plugin name(s)
			'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'bucket-lite' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'bucket-lite' ), // %1$s = plugin name(s)
			'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'bucket-lite' ), // %1$s = plugin name(s)
			'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'bucket-lite' ), // %1$s = plugin name(s)
			'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'bucket-lite' ), // %1$s = plugin name(s)
			'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'bucket-lite' ),
			'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'bucket-lite' ),
			'return'                                    => __( 'Return to Required Plugins Installer', 'bucket-lite' ),
			'plugin_activated'                          => __( 'Plugin activated successfully.', 'bucket-lite' ),
			'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'bucket-lite' ) // %1$s = dashboard link
		)
	);

	tgmpa( $plugins, $config );

} ?>
