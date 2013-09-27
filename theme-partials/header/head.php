<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
	
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta name="HandheldFriendly" content="True">
	<meta name="apple-touch-fullscreen" content="yes" />
	<meta name="MobileOptimized" content="320">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php
    /*
     * icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/)
     */

    $favicon = wpgrade::option( 'favicon' );
    if ( $favicon ) {
        echo '<link rel="icon" href="'.$favicon.'" >';
    }
    $apple_icon = wpgrade::option( 'apple_touch_icon' );
    if ( $apple_icon ) {
        echo '<link rel="apple-touch-icon" href="'.$apple_icon.'" >';
    }
    $win8icon = wpgrade::option( 'metro_icon' );
    if ( $win8icon ) {
        echo '<meta name="msapplication-TileColor" content="#f01d4f">';
        echo '<meta name="msapplication-TileImage" content="'.$win8icon.'" >';
    }
	
	/*
     * Wordpress Head. This is REQUIRED.Never remove this
     */
	wp_head(); ?>
</head>