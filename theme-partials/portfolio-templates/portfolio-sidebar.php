<div id="main" class="content djax-updatable">
<article id="post-<?php the_ID(); ?>" <?php post_class('entry__body'); ?> >
    <div class="page-content  page-content--with-sidebar  project--sidebar">

        <div class="page-main  project--sidebar__images">
            <h1 class="beta  entry__title  title-mobile"><?php the_title(); ?></h1>    

            <?php
                $client_name = '';
                $client_name = get_post_meta( get_the_ID(), wpgrade::prefix() . 'portfolio_client_name', true );
        		
        		$client_link = '#';
                $client_link = get_post_meta( get_the_ID(), wpgrade::prefix() . 'portfolio_client_link', true );

                $gallery_ids = array();
                $gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'portfolio_gallery', true );
                if (!empty($gallery_ids)) {
        	        $gallery_ids = explode(',',$gallery_ids);
                }

                $attachments = get_posts(array(
                    'post_type' => 'attachment',
                    'posts_per_page' => -1,
                    'orderby' => "post__in",
                    'post__in'     => $gallery_ids
                ));
        		
        		// let's get the video
        		// first get the youtube one
        		$video = get_post_meta( get_the_ID(), wpgrade::prefix() . 'portfolio_video_youtube', true );
        		$video = trim($video);

        		if (empty($video)) {
        			// let's try getting the vimeo video link
        			$video = get_post_meta( get_the_ID(), wpgrade::prefix() . 'portfolio_video_vimeo', true );
        			$video = trim($video);
        		}
        		
        		if (!empty($video)) {
        			echo html_entity_decode($video);
        		}

                if ($attachments) {
                    foreach ( $attachments as $attachment ) {
                        $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                        $thumbimg = wp_get_attachment_image_src( $attachment->ID, 'thumbnail-size', true );
                        $attachment_url = wp_get_attachment_url( $attachment->ID );
                        echo '<a href="' . $attachment_url .'" class="' . $class . ' data-design-thumbnail"><img alt="" src="' . $thumbimg[0] . '" /></a>';
                    }
                }
            ?>

        </div><!-- .page-main -->


        <div class="page-side  project--sidebar__content">

            <div class="entry-header">
                <div class="beta  entry__title  title-lap"><?php the_title(); ?></div>
            </div>
            <hr class="separator separator--dotted" />

            <div class="entry__content project-entry-content">
                <?php the_content(); ?>
            </div><!-- .entry__content -->


            <?php $categories = get_the_terms($post->ID, 'lens_portfolio_categories'); ?>
            <?php if ($client_name !== '' && !empty($categories) && !is_wp_error($categories)): ?>
                <hr class="separator separator--dotted" />
                <footer class="entry__meta entry__meta--project row cf">
                    <?php if($client_name !== '') : ?>
                    <div class="entry__meta-box meta-box--client">
                        <span class="meta-box__box-title"><?php _e("Client", wpGrade::textdomain()); ?>: </span>
                        <a href="<?php echo $client_link; ?>" title="View all posts for this client" rel="category"><?php echo $client_name; ?></a>
                    </div>
                    <?php endif; ?>               
                    <?php if ( !empty($categories) && !is_wp_error($categories)): ?>
                    <div class="entry__meta-box meta-box--categories col-12 hand-col-6">
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
            <?php endif; ?>

            <hr class="separator separator--striped" />

            <footer class="entry__meta entry__meta--project flexbox">
                <?php
                if (function_exists( 'display_pixlikes' )) {
                    display_pixlikes(array( 'class' => 'likes-box--footer flexbox__item' ));
                }

                if (wpgrade::option('portfolio_single_show_share_links')): ?>
                    <div class="social-links  flexbox__item  text--right">
                        <span class="social-links__message"><?php _e("Share", wpGrade::textdomain()); ?>: </span>
                        <ul class="social-links__list">
                            <?php if (wpgrade::option('portfolio_single_share_links_twitter')): ?>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;source=tweetbutton&amp;text=<?php echo urlencode(get_the_title())?>&amp;url=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;via=<?php echo wpgrade::option( 'twitter_card_site' ) ?>" onclick="return popitup(this.href, this.title)"
                                       title="<?php _e('Share on Twitter!', wpgrade::textdomain()) ?>">
                                        <i class="icon-e-twitter-circled"></i>
                                    </a>
                                </li>
                            <?php endif;
                            if (wpgrade::option('portfolio_single_share_links_facebook')): ?>
                                <li>
                                    <a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)"
                                       title="<?php _e('Share on Facebook!', wpgrade::textdomain()) ?>">
                                        <i class="icon-e-facebook-circled"></i>
                                    </a>
                                </li>
                            <?php endif;
                            if (wpgrade::option('portfolio_single_share_links_googleplus')): ?>
                                <li>
                                    <a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)"
                                       title="<?php _e('Share on Google+!', wpgrade::textdomain()) ?>">
                                        <i class="icon-e-gplus-circled"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </footer><!-- .entry__meta -->
        </div><!-- .page-side -->

        <div class="page-main  project--sidebar__related">
            <?php $yarpp_active = is_plugin_active('yet-another-related-posts-plugin/yarpp.php'); ?>
            <aside class="related-projects_container entry__body">
                <div class="related-projects_header">
                    <?php if($yarpp_active) : ?>
                    <h4 class="related-projects_title"><?php _e("Related projects", wpGrade::textdomain()); ?></h4>
                    <?php endif; ?>
                    <div class="projects_nav">
                       <ul class="projects_nav-list">
                           <li class="projects_nav-item">
                                <?php next_post_link('%link', '<span class="prev">&#8592;</span>' . __('Previous', wpGrade::textdomain()) ); ?>
                            </li>
                           <li class="projects_nav-item">
                                <a href="<?php echo get_portfolio_page_link(); ?>">
                                    <?php _e("All projects", wpGrade::textdomain()); ?>
                                </a>
                            </li>
                            <li class="projects_nav-item">
                                <?php previous_post_link('%link', __('Next', wpGrade::textdomain()). '<span class="next">&#8594;</span>'); ?>
                            </li>
                       </ul>
                   </div>
                </div>        
                <?php
                    if ($yarpp_active):
                        yarpp_related(array(
                            'threshold' => 0,
                            'post_type' => array('lens_portfolio')
                        ));
                    endif;
                ?>
            </aside>
        </div>
    </div>
</article><!-- #post -->
</div><!-- .content -->