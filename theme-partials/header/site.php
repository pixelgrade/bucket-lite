<div class="header" data-smoothscrolling>
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
        <div class="header__inner-wrap">
            <div id="navigation" class="djax-updatable">
                <?php wpgrade_main_nav();?>
            </div>
            
        </div>
    </header>
    <?php get_sidebar('header'); ?>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <?php if(wpgrade::option('do_social_footer_menu')): ?>
            <div class="header__social-section">
                <?php
                $social_icons = wpgrade::option('social_icons');
                $target = '';
                $title = wpgrade::option('social_footer_menu_title');
                if (wpgrade::option('social_icons_target_blank')) {
                    $target = ' target="_blank"';
                }
                if (count($social_icons)): ?>
                <?php if ($title): ?><h4 class="widget__title"><?php echo $title; ?></h4><?php endif; ?>
                <ul class="site-social-links">
                    <?php foreach ($social_icons as $domain => $value): if ($value): ?>
                        <li class="site-social-links__social-link">
                            <a href="<?php echo $value ?>"<?php echo $target ?>>
                                <i class="pixcode  pixcode--icon  icon-e-<?php echo $domain; ?>"></i>
                            </a>
                        </li>
                    <?php endif; endforeach ?>
                </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="site-info text--right">
            <?php
                $copyright = wpgrade_callback_theme_general_filters(wpgrade::option('copyright_text'));
                echo $copyright;
            ?>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- .header -->