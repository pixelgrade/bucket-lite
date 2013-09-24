<div id="main" class="content djax-updatable">
    <?php
        $client_name = '';
        $client_link = '#';
        if ( class_exists('Pix_Query') ) {
            $pixquery = new Pix_Query();
            $client_name = $pixquery->get_meta_value('portfolio_client_name');
            $client_link = $pixquery->get_meta_value('portfolio_client_link');
        }
    ?>    
    <div class="page-content">        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
            <header class="entry-header">
                <h1 class="entry__title"><?php the_title(); ?></h1>
                <div class="entry__content project-entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry__content -->
            </header>
            <hr class="separator--dotted separator--full-left" />
            <footer class="entry__meta entry__meta--project cf">
                <?php if($client_name != '') : ?>
                <div class="entry__meta-box meta-box--client">
                    <span class="meta-box__box-title"><?php _e("Client", wpGrade::textdomain()); ?>: </span>
                    <a href="<?php echo $client_link; ?>" title="View all posts in Ideas" rel="category"><?php echo $client_name; ?></a>
                </div>
                <?php endif; ?>
                <?php $categories = get_the_terms($post->ID, 'lens_portfolio_categories');
                    if (count($categories) && !is_wp_error($categories)): ?>
                    <div class="entry__meta-box meta-box--categories span-12 hand-span-6">
                        <span class="meta-box__box-title"><?php _e("Filled under", wpGrade::textdomain()); ?>: </span>
                        <?php foreach ($categories as $cat): ?>
                                <a href="<?php echo get_category_link($cat); ?>"
                                   rel="category">
                                    <?php echo get_category($cat)->name; ?>
                                </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>       
            </footer><!-- .entry__meta .entry__meta --project -->
            <hr class="separator separator--striped separator--full-left"/>
            <footer class="entry__meta cf">
                <?php if (function_exists( 'display_pixlikes' )) {
                        display_pixlikes(array('class' => 'likes-box likes-box--footer'));
                    } 
                ?>                
                <div class="social-links">
                    <span class="social-links__message"><?php _e("Share", wpGrade::textdomain()); ?>: </span>
                    <ul class="social-links__list">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-google-plus"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                    </ul>
                </div>
            </footer><!-- .entry__meta -->
        </article>
        <?php 
            if (is_plugin_active('yet-another-related-posts-plugin/yarpp.php')) {
                yarpp_related(array(
                    'threshold' => 0,
                    'post_type' => array('lens_portfolio')
                )); 
            }
        ?>
    </div><!-- .page-content -->
</div><!-- .content -->