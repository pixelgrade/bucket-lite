<div id="main" class="content djax-updatable">
<article id="post-<?php the_ID(); ?>" <?php post_class('entry__body'); ?> >
    <div class="page-content  page-content--with-sidebar  project--sidebar">

        <h1 class="beta  entry__title  title-mobile"><?php the_title(); ?></h1>    
        <div class="page-main  project--sidebar__images  js-project-gallery">

            <?php
                $client_name = '';
                $client_name = get_post_meta( get_the_ID(), wpgrade::prefix() . 'portfolio_client_name', true );
                
                $client_link = get_post_meta( get_the_ID(), wpgrade::prefix() . 'portfolio_client_link', true );
                if($client_link == '') $client_link = '#';

                $gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'portfolio_gallery', true );
                if (!empty($gallery_ids)) {
                    $gallery_ids = explode(',',$gallery_ids);
                } else {
	                $gallery_ids = array();
                }

		        if ( !empty($gallery_ids) ) {
			        $attachments = get_posts( array(
				        'post_type' => 'attachment',
				        'posts_per_page' => -1,
				        'orderby' => "post__in",
				        'post__in'     => $gallery_ids
			        ) );
		        } else {
			        $attachments = array();
		        }

                if ($attachments) {
                    foreach ( $attachments as $attachment ) {
                        $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                        $thumbimg = wp_get_attachment_image_src( $attachment->ID, 'thumbnail-size', true );
                        $attachment_url = wp_get_attachment_url( $attachment->ID );

                        $attachment_fields = get_post_custom( $attachment->ID );
                        $video_url = ( isset($attachment_fields['_video_url'][0] ) && !empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';
                        $is_video = false;
                        //  if there is one let royal slider know about it
                        if ( !empty($video_url) ) {
                            $attachment_url = $video_url;
                            $is_video = true;
                            $class .= ' mfp-iframe mfp-video';
                        } else {
                            $class = ' mfp-image';
                        }
						
						//whether or not to show the title and caption in popups
						$img_title = '';
						$img_caption = '';
						if (wpgrade::option('show_title_caption_popup') == 1) {
							$img_title = $attachment->post_title;
							$img_caption = $attachment->post_excerpt;
						}
						
                        echo '<a href="' . $attachment_url .'" class="'. $class . ' title="'.$attachment->post_title.'" data-title="'.$img_title.'" data-alt="'.$img_caption.'" data-design-thumbnail itemscope itemtype="http://schema.org/ImageObject" itemprop="contentURL"><img alt="" src="' . $thumbimg[0] . '" itemprop="thumbnailUrl" /></a>';
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
                    <div class="entry__meta-box meta-box--client col-12 hand-col-6">
                        <span class="meta-box__box-title"><?php _e("Client", wpgrade::textdomain()); ?>: </span>
                        <a href="<?php echo $client_link; ?>"><?php echo $client_name; ?></a>
                    </div>
                    <?php endif; ?>               
                    <?php if ( !empty($categories) && !is_wp_error($categories)): ?>
                    <div class="entry__meta-box meta-box--categories col-12 hand-col-6">
                        <span class="meta-box__box-title"><?php _e("Filled under", wpgrade::textdomain()); ?>: </span>
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
                        <span class="social-links__message"><?php _e("Share", wpgrade::textdomain()); ?>: </span>
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
            <?php
                // If comments are open or we have at least one comment, load up the comment template
               if ( comments_open() || '0' != get_comments_number() )
                  comments_template();
            //$yarpp_active = is_plugin_active('yet-another-related-posts-plugin/yarpp.php');
	        if ( function_exists('yarpp_related') ) {
		        $yarpp_active = true;
	        } ?>
            <aside class="related-projects_container entry__body">
                <div class="related-projects_header">
                    <?php if($yarpp_active) : ?>
                    <h4 class="related-projects_title"><?php _e("Related projects", wpgrade::textdomain()); ?></h4>
                    <?php endif; ?>
                    <div class="projects_nav">
                       <ul class="projects_nav-list">
                           <li class="projects_nav-item">
                                <?php next_post_link('%link', '<span class="prev">&#8592;</span>' . __('Previous', wpgrade::textdomain()) ); ?>
                            </li>
                           <li class="projects_nav-item">
                                <a href="<?php echo get_portfolio_page_link(); ?>">
                                    <?php _e("All projects", wpgrade::textdomain()); ?>
                                </a>
                            </li>
                            <li class="projects_nav-item">
                                <?php previous_post_link('%link', __('Next', wpgrade::textdomain()). '<span class="next">&#8594;</span>'); ?>
                            </li>
                       </ul>
                   </div>
                </div>        
                <?php
                    if ($yarpp_active):
                        yarpp_related();
                    endif;
                ?>
            </aside>
        </div>
    </div>
</article><!-- #post -->
</div><!-- .content -->