<header>

    <nav class="navigation  navigation--top">

        <h2 class="accessibility">Secondary Navigation</h2>
        <?php wpgrade_top_nav(); ?>

    </nav>

    <div class="container">

        <div class="site-header">

            <div class="site-header__branding">

                <?php if (wpgrade::option('main_logo')):

                    $data_retina_logo = wpgrade::option('use_retina_logo'); ?>

                    <div class="site-logo  site-logo--image <?php if ($data_retina_logo) echo "site-logo--image-2x"; ?>">
                        <a class="site-home-link" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name') ?>">
                            <?php $data_retina_logo = $data_retina_logo ? 'data-logo2x="'.wpgrade::option('retina_main_logo').'"' : ''; ?>
                            <img src="<?php echo wpgrade::option('main_logo'); ?>" <?php echo $data_retina_logo; ?> rel="logo" alt="<?php echo get_bloginfo('name') ?>"/>
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

            <h2 class="accessibility">Primary Navigation</h2>
            <?php wpgrade_main_nav(); ?>

        </nav>

    </div>

</header><!-- .header -->