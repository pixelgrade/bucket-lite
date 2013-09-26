<div id="main" class="content djax-updatable">
<div class="page-content project-sidebar-right">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
        <h1 class="entry__title title-mobile"><?php the_title(); ?></h1>            
        <section class="project-images">
            <?php
                $ids = array();
	            $client_name = $client_link = '';
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
                <?php if($client_name != '') : ?>
                <div class="entry__meta-box meta-box--client">
                    <span class="meta-box__box-title"><?php _e("Client", wpGrade::textdomain()); ?>: </span>
                    <a href="<?php echo $client_link; ?>" title="View all posts in Ideas" rel="category"><?php echo $client_name; ?></a>
                </div>
                <?php endif; ?>               
                <?php $categories = get_the_terms($post->ID, 'lens_portfolio_categories');
                    if ( !empty($categories) && !is_wp_error($categories)): ?>
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
            </footer><!-- .entry__meta .entry__meta-project -->
            <hr class="separator separator--striped" />
            <footer class="entry__meta entry__meta--project row cf">
                <?php if (function_exists( 'display_pixlikes' )) {
                        display_pixlikes(array( 'class' => 'likes-box--footer span-12 hand-span-6' ));
                    } 
                ?>
                <div class="social-links span-12 hand-span-6">
                    <span class="social-links__message"><?php _e("Share", wpGrade::textdomain()); ?>: </span>
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
    <?php $yarpp_active = is_plugin_active('yet-another-related-posts-plugin/yarpp.php'); ?>
    <section class="related-projects_container">
        <header class="related-projects_header">
            <?php if($yarpp_active) : ?>
            <h4 class="related-projects_title"><?php _e("Related projects", wpGrade::textdomain()); ?></h4>
            <?php endif; ?>
           <nav class="projects_nav">
               <ul class="projects_nav-list">
                   <li class="projects_nav-item">
                        <?php next_post_link('%link', '<i class="icon-arrow-left"></i>' . __('Previous', wpGrade::textdomain()) ); ?>
                    </li>
                   <li class="projects_nav-item">
                        <a href="#">
                            <?php _e("All projects", wpGrade::textdomain()); ?>
                        </a>
                    </li>
                    <li class="projects_nav-item">
                        <?php previous_post_link('%link', __('Next', wpGrade::textdomain()). '<i class="icon-arrow-right"></i>'); ?>
                    </li>
               </ul>
           </nav>
        </header>        
        <?php 
            if ($yarpp_active) {
                yarpp_related(array(
                    'threshold' => 0,
                    'post_type' => array('lens_portfolio')
                )); 
            }
        ?>
    </section>
</div><!-- .page-content -->
</div><!-- .content -->