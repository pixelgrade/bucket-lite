<?php

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'wpgrade_register_required_plugins', 999 );

function wpgrade_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     => 'PixTypes',
			'slug'     => 'pixtypes',
			'required' => false,
		),
		array(
			'name'     => 'PixCodes',
			'slug'     => 'pixcodes',
			'required' => false,
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'bucket-lite',
		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',
		// Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',
		// Menu slug.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.


		'strings' => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'bucket-lite' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'bucket-lite' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'bucket-lite' ),
			/* translators: %1$s: plugin name(s). */
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'bucket-lite' ),
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'bucket-lite' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'bucket-lite' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'bucket-lite' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'bucket-lite' ),
			/* translators: %1$s: dashboard link. */
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'bucket-lite' )
		)

	);

	tgmpa( $plugins, $config );
}
