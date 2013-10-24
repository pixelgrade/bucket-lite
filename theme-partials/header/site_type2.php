<header class="header header--type2">

    <nav class="navigation  navigation--top">

        <div class="container grid">
            <h2 class="accessibility">Secondary Navigation</h2>
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

    <div class="container">

        <div class="site-header site-header--ad grid">
            <div class="site-header__branding grid__item three-tenths">

                <?php if (wpgrade::option_image_src('main_logo')):

                    $data_retina_logo = wpgrade::option('use_retina_logo'); ?>

                    <div class="site-logo  site-logo--image <?php if ($data_retina_logo) echo "site-logo--image-2x"; ?>">
                        <h1 class="site-home-title">
                            <a class="site-home-link" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name') ?>">
                                <?php $data_retina_logo = $data_retina_logo ? 'data-logo2x="'.wpgrade::option_image_src('retina_main_logo').'"' : ''; ?>
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

            </div><!--
            --><div class="header-ad grid__item seven-tenths">
                <a class="header-ad-link" href="#">
                    <img src="http://placehold.it/728x90" alt="#" />
                </a>
            </div>

        </div>

        <span class="site-navigation__trigger js-nav-trigger"><i class="icon-reorder"></i><i class="icon-remove"></i></span>                
        
        <hr class="nav-top-separator separator separator--striped flush--bottom" />
        <nav class="navigation  navigation--main">

            <h2 class="accessibility">Primary Navigation</h2>
            <?php wpgrade_main_nav(); ?>

        </nav>

    </div>

</header><!-- .header -->