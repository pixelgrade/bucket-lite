<div id="portfolio" class="content djax-updatable djax-loading">
<div class="page-content project-sidebar-right">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
        <h1 class="entry__title title-mobile"><?php the_title(); ?></h1>            
        <section class="project-images">
            <?php
                $ids = array();

                if ( class_exists('Pix_Query') ) {
                    $pixquery = new Pix_Query();
                    $ids = $pixquery->get_gallery_ids('portfolio_gallery');
                }

                $attachments = get_posts( array(
                    'post_type' => 'attachment',
                    'posts_per_page' => -1,
    	            'orderby' => "post__in",
                    'post__in'     => $ids
                ) );

                if ( $attachments ) {

                        foreach ( $attachments as $attachment ) {
                            $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                            $thumbimg = wp_get_attachment_image_src( $attachment->ID, 'thumbnail-size', true );
                            echo '<a href="#" class="' . $class . ' data-design-thumbnail"><img alt="" src="' . $thumbimg[0] . '" /></a>';
                        }
                }
            ?>                
        </section>

        <section class="project-content">
            <header class="entry-header">
                <h1 class="entry__title title-lap"><?php the_title(); ?></h1>
            </header>
            <div class="entry__content project-entry-content">
                <?php the_content(); ?>
            </div><!-- .entry__content -->
            <hr class="separator separator--dotted" />
            <footer class="entry__meta entry__meta--project row cf">
                <div class="entry__meta-box meta-box--client span-12 hand-span-6">
                    <span class="meta-box__box-title">Client: </span>
                    <a href="http://localhost/prism/?cat=2" title="View all posts in Ideas" rel="category">Yale House of Style</a>
                </div>                  
                <?php $categories = get_the_terms($post->ID, 'lens_portfolio_categories');
                    if ( !empty($categories) && !is_wp_error($categories)): ?>
                    <div class="entry__meta-box meta-box--categories span-12 hand-span-6">
                        <span class="meta-box__box-title">Filled under: </span>
                        <?php foreach ($categories as $cat): ?>
                                <a href="<?php echo get_category_link($cat); ?>"
                                   rel="category">
                                    <?php echo get_category($cat)->name; ?>
                                </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>    
            </footer><!-- .entry__meta .entry__meta-project -->
            <hr class="separator" />
            <footer class="entry__meta entry__meta--project row cf">
                <?php 
                    if (function_exists( 'display_pixlikes' )) { 
                        display_pixlikes('likes-box--footer span-12 hand-span-6'); 
                    } 
                ?>
                <div class="social-links span-12 hand-span-6">
                    <span class="social-links__message">Share: </span>
                    <ul class="social-links__list">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-google-plus"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                    </ul>
                </div>
            </footer><!-- .entry__meta -->
        </section><!-- .project-content -->
    </article><!-- #post -->
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