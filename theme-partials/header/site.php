<header>

    <nav class="navigation  navigation--top">

        <div class="container">
            <h2 class="accessibility"><?php _e('Secondary Navigation', wpgrade::textdomain()) ?></h2>
            <?php wpgrade_top_nav(); ?>
        </div>

    </nav>

    <div class="container">

        <div class="site-header">

            <div class="site-header__branding">

                <?php if (wpgrade::option_image_src('main_logo')): ?>

                    <div class="site-logo  site-logo--image <?php if (wpgrade::option('use_retina_logo')) echo "site-logo--image-2x"; ?>">
                        <a class="site-home-link" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name') ?>">
                            <?php $data_retina_logo = wpgrade::option('use_retina_logo') ? 'data-logo2x="'.wpgrade::option_image_src('retina_main_logo').'"' : ''; ?>
                            <img src="<?php echo wpgrade::option_image_src('main_logo'); ?>" <?php echo $data_retina_logo; ?> rel="logo" alt="<?php echo get_bloginfo('name') ?>"/>
                        </a>
                    </div>

                <?php else: ?>

                    <div class="site-logo  site-logo--text">
                        <a class="site-home-link" href="<?php echo home_url() ?>"><?php echo get_bloginfo('name') ?></a>
                    </div>

                <?php endif; ?>

            </div>

        </div>

        <nav class="navigation  navigation--main">

            <h2 class="accessibility"><?php _e('Primary Navigation', wpgrade::textdomain()) ?></h2>
            <?php wpgrade_main_nav(); ?>

        </nav>

    </div>

</header><!-- .header -->