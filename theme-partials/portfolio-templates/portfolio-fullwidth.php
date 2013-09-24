<div id="main" class="content djax-updatable">
    <?php
    $ids = array();

    if ( class_exists('Pix_Query') ) {
        $pixquery = new Pix_Query();
        $ids = $pixquery->get_gallery_ids('portfolio_gallery');
        $client_name = $pixquery->get_meta_value('portfolio_client_name');
        $client_link = $pixquery->get_meta_value('portfolio_client_link');        
    }

    $attachments = get_posts( array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'orderby' => "post__in",
        'post__in'     => $ids
    ) );

    if ( $attachments ) : ?>
    <div class="featured-image">
        <div class="pixslider js-pixslider" data-bullets data-customarrows>                    
            <?php 
                foreach ( $attachments as $attachment ) : 
                    $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                    $thumbimg = wp_get_attachment_image_src( $attachment->ID, 'full' );                            
            ?>
                <div class="pixslider__slide">
                    <img src="<?php echo $thumbimg[0]; ?>" class="rsImg"/>
                </div>
            <?php endforeach; ?>                    
        </div>
    </div>
    <?php endif; ?>
    <?php $categories = get_the_terms($post->ID, 'lens_portfolio_categories'); ?>   

    <div class="page-content single-portfolio-fullwidth">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="row">
                <div class="col-4">
                    <header class="entry__header">
                        <h1 class="entry__title"><?php the_title(); ?></h1>
                        <div class="entry__meta entry__meta--project cf hand-visible">
                            <?php if($client_name != '') : ?>
                            <div class="entry__meta-box meta-box--client">
                                <span class="meta-box__box-title"><?php _e("Client", wpGrade::textdomain()); ?>: </span>
                                <a href="<?php echo $client_link; ?>" title="View all posts in Ideas" rel="category"><?php echo $client_name; ?></a>
                            </div>
                            <?php endif; ?> 
                            <?php
                                if ($categories): ?>                                    
                                <div class="entry__meta-box meta-box--categories">
                                    <span class="meta-box__box-title"><?php _e("Filled under", wpGrade::textdomain()); ?>: </span>
                                    <?php foreach ($categories as $cat): ?>
                                        <a href="<?php echo get_category_link($cat); ?>" rel="category">
                                            <?php echo get_category($cat)->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?> 
                        </div>
                    </header><!-- .entry-header -->
                </div>
                <div class="col-8 gutter--double">
                    <div class="entry__content project-entry-content">
                        <?php the_content(); ?>
                    </div><!-- .entry__content -->
                </div>
            </div>
            <footer class="entry__meta cf to-hand-visible">
                <hr class="separator separator--dotted" />
                <div class="entry__meta entry__meta--project cf">
                    <div class="entry__meta-box meta-box--client">
                        <span class="meta-box__box-title"><?php _e("Client", wpGrade::textdomain()); ?>: </span>
                        <a href="http://localhost/prism/?cat=2" title="View all posts in Ideas" rel="category">Yale House of Style</a>
                    </div>  
                    <?php 
                        if ($categories): ?>                                    
                        <div class="entry__meta-box meta-box--categories">
                            <span class="meta-box__box-title"><?php _e("Filled under", wpGrade::textdomain()); ?>: </span>
                            <?php foreach ($categories as $cat): ?>
                                <a href="<?php echo get_category_link($cat); ?>" rel="category">
                                    <?php echo get_category($cat)->name; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?> 
                </div>                
            </footer>
            <div class="row">
                <div class="col-4">
                    <hr class="separator separator--striped separator--full-left hand-visible"/>
                </div>
                <div class="col-8 gutter--double">
                    <hr class="separator separator--striped"/>
                </div>
            </div>
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
            </footer><!-- .entry-meta -->
        </article><!-- #post -->
        <?php 
            if (is_plugin_active('yet-another-related-posts-plugin/yarpp.php')) {
                yarpp_related(array(
                    'threshold' => 0,
                    'post_type' => array('lens_portfolio')
                )); 
            }
        ?>                      
    </div><!-- #page-content -->
</div><!-- .content -->