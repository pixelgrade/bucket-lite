<?php
/**
 * The Template file for the header.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//this is just for the doctype and <head> section
get_template_part('theme-partials/header/head');

$class_name = '';

?>

<body <?php body_class($class_name); ?> itemscope itemtype="http://schema.org/WebPage">
    <div class="pace">
        <div class="pace-activity"></div>
    </div>
    <div id="page">
        <nav class="navigation  navigation--mobile  overthrow">
            <h2 class="accessibility"><?php esc_html_e('Primary Mobile Navigation', 'bucket-lite') ?></h2>
            <div class="search-form  push-half--top  push--bottom  soft--bottom">
                <?php get_search_form(); ?>
            </div>
            <?php
                wpgrade_main_nav_mobile();
                wpgrade_top_nav_left('nav--stacked', true);
                wpgrade_top_nav_right('nav--stacked', true);
            ?>
        </nav>
        <div class="wrapper">
            <?php //get the main header section - logo, nav, footer
			get_template_part('theme-partials/header/site-type1');
