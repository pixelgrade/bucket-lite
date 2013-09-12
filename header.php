<?php

	// Resolve html tag classes
	// ------------------------

	$htmlclasses = 'no-js color1';

	if (wpgrade::option('bw_portfolio_filter')) {
		$htmlclasses .= ' bw-images';
	}

	if (wpgrade::option('header_fixed')) {
		$htmlclasses .= ' l-header-fixed';
	}

	// Resolve html tag data attributes
	// --------------------------------

	$smoothscrolling = 'off';
	if (wpgrade::option('use_smooth_scrool')) {
		$smoothscrolling = 'on';
	}

	$main_color = wpgrade::option('main_color');

	$html_data_attributes = " data-smooth-scroll=\"$smoothscrolling\" data-accentcolor=\"$main_color\"";

	// Resolve Retina Logo
	// -------------------

	$data_retina_logo  = wpgrade::option('use_retina_logo');

	if ($data_retina_logo) {
		$data_retina_logo = 'data-retina_logo="'.wpgrade::option('retina_main_logo').'"';
	}
	else { // no retina logo
		$data_retina_logo = '';
	}

?>
<!DOCTYPE html>

<!--[if lt IE 7]>     <html <?php language_attributes() ?> <?php echo "$html_data_attributes class=\"$htmlclasses lt-ie9 lt-ie8 lt-ie7\"" ?>><![endif]-->
<!--[if (IE 7)]>      <html <?php language_attributes() ?> <?php echo "$html_data_attributes class=\"$htmlclasses lt-ie9 lt-ie8\"" ?>><![endif]-->
<!--[if (IE 8)]>      <html <?php language_attributes() ?> <?php echo "$html_data_attributes class=\"$htmlclasses lt-ie9\"" ?>><![endif]-->
<!--[if (IE 9)]>      <html <?php language_attributes() ?> <?php echo "$html_data_attributes class=\"$htmlclasses ie9\"" ?>><![endif]-->
<!--[if gt IE 9]><!--><html <?php language_attributes() ?> <?php echo "$html_data_attributes class=\"$htmlclasses\"" ?>><!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title><?php wp_title('|', 'true', 'right') ?><?php bloginfo('name') ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="apple-touch-fullscreen" content="yes" />
	<meta name="MobileOptimized" content="320" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php wp_head() ?>
</head>

<body <?php body_class(wpgrade::body_class()) ?>>

	<div id="page" <?php if ( ! wpgrade::option('header_fixed')): ?>class="no-sticky-header"<?php endif; ?> >

		<header id="header" class="wrapper wrapper-header wrapper-header-big">
			<div class="site-header">

				<div class="site-branding">

					<?php if (wpgrade::option('main_logo')): ?>
						<div class="site-logo site-logo_image<?php if (wpgrade::option('use_full_size_logo')): ?> full-sized<?php endif; ?>">

							<a class="site-home-link" href="<?php echo home_url() ?>"
							   title="<?php echo get_bloginfo('name') ?>">

								<img src="<?php echo wpgrade::option('main_logo') ?>" <?php echo $data_retina_logo ?>
									 alt="<?php echo get_bloginfo('name') ?>"
									 rel="logo"/>

							</a>

						</div>
					<?php else: # no main logo ?>
						<div class="site-logo site-logo_text">
							<a class="site-home-link" href="<?php echo home_url() ?>">
								<?php echo get_bloginfo('name') ?>
							</a>
						</div>
					<?php endif; ?>

				</div>

				<nav class="site-navigation" role="navigation">
					<h6 class="hidden" hidden>Main navigation</h6>
					<?php wpgrade_main_nav() ?>
					<div class="header_search-form">
						<?php get_search_form(true) ?>
					</div>
				</nav>

			</div>
		</header>

		<div class="wrapper wrapper-header wrapper-header-small">
			<div class="site-header">
				<a class="nav-btn" id="nav-open-btn" href=""><i class="icon-reorder"></i></a>
				<div class="site-branding">

					<?php if (wpgrade::option('main_small_logo') || wpgrade::option('main_logo')): ?>
						<div class="site-logo site-logo_image <?php if (wpgrade::option('use_full_size_logo')): ?>full-sized<?php endif; ?>">

							<a class="site-home-link" href="<?php echo home_url() ?>"
							   title="<?php echo get_bloginfo('name') ?>">

								<?php if (wpgrade::option('main_small_logo')): ?>
									<img src="<?php echo wpgrade::option('main_small_logo') ?>" <?php echo $data_retina_logo ?>
										 alt="<?php echo get_bloginfo('name') ?>"/>
								<?php else: # not small logo ?>
									<img src="<?php echo wpgrade::option('main_logo') ?>"
										 alt="<?php echo get_bloginfo('name') ?>"/>
								<?php endif; ?>

							</a>

						</div>
					<?php else: # ! main_small_logo && ! main_logo ?>
						<div class="site-logo site-logo_text">
							<a class="site-home-link"
							   href="<?php echo home_url() ?>">
								<?php echo get_bloginfo('name') ?>
							</a>
						</div>
					<?php endif; ?>

				</div>

				<div class="header_search-form">
					<?php get_search_form(true) ?>
				</div>

				<nav class="site-navigation" role="navigation">
					<h6 class="hidden" hidden>Main navigation</h6>
					<?php wpgrade_main_nav() ?>
				</nav>

			</div>
		</div>

		<?php # content ... ?>
