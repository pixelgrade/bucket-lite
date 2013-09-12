<?php
	/* @var string $main_color */
	/* @var array  $fonts */
	/* @var string $port_color */
	/* @var string $rgb */
 ?>

<style>

	<?php if ( ! empty($main_color)): ?>

		/* color */ {
			color: <?php echo $main_color; ?>;
		}

	<?php endif; ?>

	<?php if (isset($fonts['main_font'])):  ?>

		/*  */ {
			font-family: "<?php echo $fonts['main_font']; ?>" !important;
		}

	<?php endif; ?>

	<?php if (isset($fonts["menu_font"])): ?>

		<?php $menu_font = $fonts["menu_font"]; ?>

		.site-navigation a {
			font-family: "<?php echo $menu_font; ?>" !important;
		}

	<?php endif; ?>

	<?php if (isset($fonts["body_font"])): ?>

		<?php $body_font = $fonts["body_font"]; ?>

		body, .testimonial-content {
			font-family: "<?php echo $body_font; ?>" !important;
		}

	<?php endif; ?>

	<?php if ( ! empty($port_color)): ?>

		<?php $port_color = '#'.$port_color; ?>

		.portfolio_items article li.big a div.title,
		.portfolio_single_gallery li a {
			color: <?php echo $port_color ?>
		}

		.portfolio_items article li.big a div.title hr {
			border-color: <?php echo $port_color ?>
		}

		.portfolio_items article li a .border span, .portfolio_single_gallery li a .border span {
			border: 1px solid <?php echo $port_color ?>
		}

	<?php endif; ?>

	<?php if (wpgrade::option('custom_css')): ?>
		<?php echo wpgrade::option('custom_css'); ?>
	<?php endif; ?>

</style>
