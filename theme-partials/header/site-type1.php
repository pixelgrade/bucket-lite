<?php
/**
 * The Template file for the main header section.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<header class="header header--type1">

    <nav class="navigation  navigation--top">

        <div class="container">
            <div class="grid">
                <div class="grid__item one-half">
	                <?php wpgrade_top_nav_left(); ?>
                </div><!--
                --><div class="grid__item one-half">
		            <?php wpgrade_top_nav_right(); ?>
                </div>
            </div>
        </div>

    </nav>

    <div class="container">
        <div class="site-header flexbox">
            <div class="site-header__branding flexbox__item one-half">
                <?php get_template_part('theme-partials/header/site-header__branding'); ?>
            </div><!--
            --><div class="header-bar-container flexbox__item one-half split">
                <ul class="header-bar nav flush--bottom">
                    <?php if ( wpgrade::option('nav_show_header_search') ){ ?>
                    <li class="search-item"><?php get_search_form(); ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <div class="site-navigation__trigger js-nav-trigger"><span class="nav-icon"></span></div>                

        <hr class="nav-top-separator separator separator--subsection flush--bottom" />
        <nav class="navigation  navigation--main  js-navigation--main">

            <h2 class="accessibility"><?php esc_html_e('Primary Navigation', 'bucket-lite') ?></h2>
            <div class="nav--main__wrapper  js-sticky">
                <?php wpgrade_main_nav(); ?>
            </div>

        </nav>
    </div>

</header><!-- .header -->
