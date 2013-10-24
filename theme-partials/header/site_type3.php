<header class="header header--type3">

    <nav class="navigation  navigation--top">

        <div class="container grid">
            <h2 class="accessibility"><?php _e('Secondary Navigation', wpgrade::textdomain()) ?></h2>
            <div class="grid__item one-half">
                <?php wpgrade_top_nav(); ?>
            </div><!--
            --><div class="grid__item one-half split">
                <ul class="header-bar header-bar--top nav">
                    <li>
                        <a href="#" class="social-icon-link">
                            <i class="icon-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="social-icon-link">
                            <i class="icon-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="social-icon-link">
                            <i class="icon-rss"></i>
                        </a>
                    </li>                
                    <li><?php get_search_form(); ?></li>
                </ul>
                 
            </div>
        </div>

    </nav>

    <div class="container container--main-header">

        <div class="site-header">
            <div class="site-header__branding">

                <?php if (wpgrade::option_image_src('main_logo')): ?>

                    <div class="site-logo  site-logo--image <?php if (wpgrade::option('use_retina_logo')) echo "site-logo--image-2x"; ?>">
                        <h1 class="site-home-title">
                            <a class="site-home-link" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name') ?>">
                                <?php $data_retina_logo = wpgrade::option('use_retina_logo') ? 'data-logo2x="'.wpgrade::option_image_src('retina_main_logo').'"' : ''; ?>
                                <img src="<?php echo wpgrade::option_image_src('main_logo'); ?>" <?php echo $data_retina_logo; ?> rel="logo" alt="<?php echo get_bloginfo('name') ?>"/>
                            </a>
                        </h1>
                    </div>

                <?php else: ?>

                    <div class="site-logo  site-logo--text">
                        <h1 class="site-home-title">
                            <a class="site-home-link" href="<?php echo home_url() ?>"><?php echo get_bloginfo('name') ?></a>
                        </h1>
                    </div>

                <?php endif; ?>

            </div>

        </div>
        
        <a class="site-navigation__trigger js-nav-trigger"><i class="icon-reorder"></i><i class="icon-remove"></i></a>

        <hr class="nav-top-separator separator separator--striped flush--bottom" />        
        <nav class="navigation  navigation--main">

            <h2 class="accessibility"><?php _e('Primary Navigation', wpgrade::textdomain()) ?></h2>
            <?php wpgrade_main_nav(); ?>

        </nav>

    </div>

</header><!-- .header -->