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
    <?php wp_head(); ?>
</head>
<?php

    $class_name = '';
    if(get_post_type() == 'lens_gallery'){
        $class_name = 'single-gallery-';
        $class_name .= get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_template', true);

        if($class_name == 'single-gallery-fullscreen'){
            $class_name .= ' header-transparent';
        }
    }
    else if(get_post_type() == 'lens_portfolio'){
        $class_name = 'single-portfolio-';
        $class_name .= get_post_meta(get_the_ID(), wpgrade::prefix().'project_template', true);        
    }

    $data_ajaxloading = (wpgrade::option('use_ajax_loading') != '') ? 'data-ajaxloading' : '';
    $data_smoothscrolling = (wpgrade::option('use_smooth_scroll') != '') ? 'data-smoothscrolling' : '';
?>
<body <?php body_class($class_name); echo ' ' . $data_ajaxloading . ' ' . $data_smoothscrolling; ?>>
    <div class="pace">
        <div class="pace-activity"></div>
    </div>
    <div id="page">
        <div class="wrapper">
            <div class="header">
                <header class="site-header">
                    <div class="site-header__branding">
                        <a href="<?php home_url() ?>" class="site-logo"><?php bloginfo( 'name' ); ?></a>
                    </div>
                    <span class="site-navigation__trigger js-nav-trigger"><i class="icon-reorder"></i><i class="icon-remove"></i></span>
                    <div id="navigation" class="header__inner-wrap djax-updatable">
                        <?php wpgrade_main_nav();?>
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