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
                        <?php if (wpgrade::option('main_logo')): ?>
                            <div class="site-logo site-logo--image <?php if ( wpgrade::option('use_retina_logo') ) echo "site-logo--image-2x"; ?>">
                                <a class="site-home-link" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name') ?>">
                                    <?php
                                    $data_retina_logo  = wpgrade::option('use_retina_logo');
                                    if ($data_retina_logo)
                                        $data_retina_logo = 'data-logo2x="'.wpgrade::option('retina_main_logo').'"';
                                    else
                                        $data_retina_logo = '';
                                    ?>
                                    <img src="<?php echo wpgrade::option('main_logo'); ?>" <?php echo $data_retina_logo; ?> rel="logo" alt="<?php echo get_bloginfo('name') ?>"/>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="site-logo site-logo--text">
                                <a class="site-home-link" href="<?php echo home_url() ?>"><?php echo get_bloginfo('name') ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <span class="site-navigation__trigger js-nav-trigger"><i class="icon-reorder"></i><i class="icon-remove"></i></span>
                    <div id="navigation" class="header__inner-wrap djax-updatable">
                        <?php wpgrade_main_nav();?>
                    </div>
                </header>
                <?php get_sidebar('header'); ?>
                <footer id="colophon" class="site-footer" role="contentinfo">
                    <?php
                    $social_icons = wpgrade::option('social_icons');
                    $target = '';
                    if (wpgrade::option('social_icons_target_blank')) {
                        $target = ' target="_blank"';
                    }

                    if (count($social_icons)): ?>
                        <h5><?php _e("We are Social", wpgrade::textdomain()); ?></h5>
                        <ul class="site-social-links">
                            <?php foreach ($social_icons as $domain => $value): if ($value): ?>
                                <li class="site-social-links__social-link">
                                    <a href="<?php echo $value ?>"<?php echo $target ?>>
                                        <?php switch($domain) {
                                            case 'youtube':
                                                ?><i class="pixcode  pixcode--icon  icon-play"></i>
                                                <?php break;
                                            case 'appnet':
                                                ?><i class="pixcode  pixcode--icon  icon-user"></i>
                                                <?php break;
                                            default:
                                                ?><i class="pixcode  pixcode--icon  icon-<?php echo $domain; ?>"></i>
                                                <?php } ?>
                                    </a>
                                </li>
                            <?php endif; endforeach ?>
                        </ul>
                    <?php endif; ?>

                    <div class="site-info text--right">
                        <?php
                            $copyright = wpgrade_callback_theme_general_filters(wpgrade::option('copyright_text'));
                            echo $copyright;
                        ?>
                    </div><!-- .site-info -->
                </footer><!-- #colophon -->
            </div><!-- .header -->