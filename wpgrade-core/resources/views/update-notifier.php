<?php
	// get the latest remote XML file on our server
	$xml = wpgrade_update_notifier_latest_theme_version(wpgrade::update_notifier_cacheinterval());
	// read theme current version from the style.css
	$theme_data = wpgrade::themedata();
	$options_url = admin_url('index.php?page='.wpgrade::update_notifier_pagename().'&wpgrade_update=true');

	// compute envatoDetails
	if (wpgrade::option('marketplace_username') && wpgrade::option('marketplace_api_key')) {
		$envatoDetails = 'true';
	}
	else { // ! marketplace_username || ! marketplace_api_key
		$envatoDetails = 'false';
	}
?>

<script type="text/javascript">
	var wpGradeUpdateData = {
		optionsLink: "<?php echo $options_url; ?>",
		envatoDetails: <?php echo $envatoDetails ?>
	};
</script>

<div class="wrap">

	<div id="icon-tools" class="icon32"></div>

	<h2><?php echo wpgrade::themename() ?> Theme Updates</h2>

	<?php if ( ! (isset($_GET['wpgrade_update']) && $_GET['wpgrade_update'] == 'true')): ?>

		<div id="message" class="updated below-h2">
			<p>
				<strong><?php echo $xml->message; ?></strong> You have version <?php echo $theme_data->Version; ?> installed.
				Please update to version <?php echo $xml->latest; ?>.
			</p>
		</div>

		<div id="instructions">

			<div class="two-columns">
				<h3>Automatic Update Instructions</h3>
				<p>
					<b>Important:</b> <i>Please note that with the automatic theme update <b>any code modifications</b> done in the theme's code <b>will be lost</b>, so please
					make sure you have a <b>backup copy of the theme files</b> before you update the theme.</i>
				</p>
				<p>
					In order to use this functionality, you have to:<br/>
					1. Go to <strong><?php echo wpgrade::themename(); ?> Options &raquo; Theme Auto Update</strong> section and input your <b>ThemeForest/Envato Marketplace username</b> and <b>API Key</b> in the corresponding fields.<br/>
					2. Make sure that the <b>name of the folder</b> that contains the theme files is called <b>"<?php echo wpgrade::shortname(); ?>"</b>. This is the default folder name, so if you haven't modified it manually, the name of the folder on your server should be called "<?php echo wpgrade::shortname(); ?>"
				</p>

				<div id="confirm-update" title="Theme Update">
					Are you sure you want to update the theme and replace all your current theme files with the new updated files?
				</div>
				<div id="no-details" title="Almost There">
					You haven't inserted your Marketplace username and API Key - please go to the
					<a href="<?php echo admin_url().'admin.php?page='.wpgrade::shortname().'_options'; ?>">
						<b><?php echo wpgrade::themename(); ?> Options</b>
					</a>
					page and input the required data in the
					<b>"Theme Auto Update"</b> section.
				</div>
				<a href="" class="button-primary" id="update-btn">
					Automatically Update Theme
				</a>
			</div>

			<div class="two-columns no-margin">
				<h3>Manual Update Instructions</h3>

				<b>It is recommended to manually install the update if you have done some modifications to the theme's code.</b> If so, first create
				a backup copy of the current theme you have installed and modified and then you can proceed with installing the update.

				<a id="manual-instructions-btn" class="button-primary">View Update Instructions</a>

				<div id="manual-instructions" title="Manual Update Instructions">
					<p>
						To download the latest update of the theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>,
						head over to your <strong>Downloads</strong> section in your profile and download again the theme like you
						did when you bought it.
					</p>
					<p>There are two main ways of installing an update manually:</p>
					<ol>
						<li>
							<i><b>By uploading the theme as a new theme (recommended)</b></i>- this is the easiest way to accomplish this. You just have to upload
							the updated theme zip file via the built in WordPress theme uploader as a new theme from the Appearance &raquo; Themes &raquo; Install
							Themes &raquo; Upload section.

							<div class="note_box">
								<b>Note: </b><i>Please note that when activating the new theme it is possible that your menu settings are not kept for the new theme. If so, you just have to go to Appearance &raquo; Menus &raquo; Theme Locations, select the menu (it is still there) and press the "Save" button</i>.
							</div>
						</li>
						<li>
							<i><b>Via FTP</b></i> - you have to first unzip the zipped theme file and then you can use an FTP client (such as <a href="http://filezilla-project.org/download.php">FileZilla</a>) and replace all the theme files with the updated ones.

							<div class="note_box">
								<b>Note: </b><i>Please note that with the file replacing all the code changes you have made to the files (if you have made any) will be lost, so please make sure you have a backup copy of the theme files before you do the replacement. All the settings you have made from the Admin panel (Theme Options and other places) won't be lost- they will still be available.</i>
							</div>

						</li>
					</ol>
				</div>
			</div>

			<div class="clear"></div>

			<p>For more information about auto updates, please refer to the "Updates" section of the documentation included.</p>

			<br/>

		</div>
	<?php endif; ?>

	<div class="icon32 icon32-posts-page" id="icon-edit-pages">
		<br>
	</div>

	<h2 class="title" id="changes-title">Update Changes</h2>

	<div id="changelog">
		<?php echo $xml->changelog; ?>
	</div>

</div>
