<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="page">
        <div class="wrapper">
            <div class="header">
                <header class="site-header">
                    <div class="site-header__branding">
                        <a href="<?php home_url() ?>" class="site-logo"><?php bloginfo( 'name' ); ?></a>
                    </div>
                    <span class="site-navigation__trigger js-nav-trigger"><i class="icon-reorder"></i><i class="icon-remove"></i></span>
                    <div class="header__inner-wrap">
                        <?php 

                        $defaults = array(
                            'theme_location'  => 'menu-header',
                            'menu'            => '',
                            'container'       => 'nav',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'site-navigation site-navigation--main',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                            'walker'          => ''
                        );

                        wp_nav_menu( $defaults );

                        ?>
                    </div>
                </header>
                <?php get_sidebar('header'); ?>
                <footer id="colophon" class="site-footer" role="contentinfo">
                    <div class="site-info text--right">
                        <div>&copy; Copyright 2013</div>
                        <p><?php printf( __( 'Handcrafted with love by %1$s', 'lens' ), '<a href="http://pixelgrade.com/" rel="designer">PixelGrade Team</a>' ); ?></p>
                    </div><!-- .site-info -->
                </footer><!-- #colophon -->
            </div><!-- .header -->
            <div class="content">