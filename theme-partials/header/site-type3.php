<header class="header header--type3">

    <nav class="navigation  navigation--top">

        <div class="container">
            <h2 class="accessibility"><?php _e('Secondary Navigation', wpgrade::textdomain()) ?></h2>
            
            <div class="grid">
                <div class="grid__item one-half">
                    <?php wpgrade_top_nav_left(); ?>
                </div><!--
             --><div class="grid__item one-half text--right">
                    <ul class="header-bar header-bar--top nav flush--bottom"><!--
                     --><li><?php wpgrade_top_nav_right(); ?></li><!--
                        <?php if (wpgrade::option('nav_show_header_social_icons')) { ?>
                     --><li><?php get_template_part('theme-partials/wpgrade-partials/social-icons-list'); ?></li><!--
                        <?php }
                        if (wpgrade::option('nav_show_header_search')): ?>
                     --><li><?php get_search_form(); ?></li><!--
                        <?php endif; ?>
                 --></ul>
                </div>
            </div>
        </div>

    </nav>

    <div class="container">

        <div class="site-header flexbox">
            <div class="site-header__branding  flexbox__item  one-whole">
                <?php get_template_part('theme-partials/header/site-header__branding'); ?>
            </div>

        </div>
        
        <span class="site-navigation__trigger js-nav-trigger"><i class="icon-reorder"></i><i class="icon-remove"></i></span>

        <hr class="nav-top-separator separator separator--subsection flush--bottom" />
		
        <nav class="navigation  navigation--main">
            <h2 class="accessibility"><?php _e('Primary Navigation', wpgrade::textdomain()) ?></h2>
            <?php wpgrade_main_nav(); ?>
        </nav>

    </div>

</header><!-- .header -->