<?php
    
?>
<div id="main" class="content djax-updatable">
    <div class="mosaic">
        <?php

        $has_post_thumbnail = has_post_thumbnail();

        if ($has_post_thumbnail) {
            $post_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big', true);
            $post_featured_image = $post_featured_image[0];
        }

        ?>

        <div class="mosaic__item  mosaic__item--page-title-mobile">
            <div class="image__item-link">
                <div class="image__item-wrapper">
                    <?php if ($has_post_thumbnail) : ?>
                    <img
                        class="js-lazy-load"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                        data-src="<?php echo $post_featured_image; ?>"
                        alt=""
                        />
                    <?php endif; ?>                         
                </div>
                <div class="image__item-meta">
                    <div class="image_item-table">
                        <div class="image_item-cell">
                            <h1><?php _e('Galleries',wpgrade::textdomain()) ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php

            $idx = 0;
            while ( have_posts() ) : the_post();
            $idx++;
            $gallery_ids = array();
            $gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'main_gallery', true );
            if (!empty($gallery_ids)) {
                $gallery_ids = explode(',',$gallery_ids);
            }

            $attachments = get_posts( array(
                'post_type' => 'attachment',
                'posts_per_page' => -1,
                'orderby' => "post__in",
                'post__in' => $gallery_ids
            ) );

            $featured_image = "";
            if (has_post_thumbnail()) {
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big');
                $featured_image = $featured_image[0];
            } else {
                if ($gallery_ids != "") {
                    $attachments = get_posts( array(
                        'post_type' => 'attachment',
                        'posts_per_page' => -1,
                        'orderby' => "post__in",
                        'post__in' => $gallery_ids
                    ) ); 
                } else {
                    $attachments = get_posts( array(
                        'post_type' => 'attachment',
                        'posts_per_page' => -1,
                        'post_status' =>'any',
                        'post_parent' => $post->ID
                    ) );
                }

                if ( $attachments ) {
                    foreach ( $attachments as $attachment ) {
                        $featured_image = wp_get_attachment_image_src($attachment->ID, 'portfolio-big');
                        $featured_image = $featured_image[0];
                        break;
                    }
                }
            }

            $categories = get_the_terms($post->ID, 'lens_gallery_categories');
            ?>

            <div class="mosaic__item <?php if($categories) foreach($categories as $cat) { echo strtolower($cat->name) . ' '; } ?> ">
                <a href="<?php the_permalink(); ?>" class="image__item-link">
                   <div class="image__item-wrapper">
                        <?php if ($featured_image != ""): ?>
                            <img
                                class="js-lazy-load"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                data-src="<?php echo $featured_image; ?>"
                                alt=""
                            />
                        <?php else: ?>
                            <img
                                class="js-lazy-load"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                data-src="<?php echo get_template_directory_uri().'/theme-content/img/camera.png'; ?>"
                                alt=""
                            />
                        <?php endif ?>
                    </div>
                    <div class="image__item-meta image_item-meta--portfolio">
                        <div class="image_item-table">
                            <div class="image_item-cell image_item--block image_item-cell--top">
                                <h3 class="image_item-title"><?php the_title(); //short_text(get_the_title($post->ID), 20, 20); ?></h3>
                                <span class="image_item-description"><?php short_text(get_the_excerpt(), 50, 50); ?></span>
                            </div>
                            <div class="image_item-cell image_item--block image_item-cell--bottom">
                                <div class="image_item-meta grid">
                                    <ul class="image_item-categories grid__item one-half">
                                        <?php $categories = get_the_terms($post->ID, 'lens_gallery_categories');
                                        if ($categories): ?>
                                        <li class="image_item-cat-icon"><i class="icon-folder-open"></i></li>
                                            <?php 
                                                $categories_index = 1;
                                                foreach ($categories as $cat):
                                                    if($categories_index < 3) :
                                            ?>
                                                <li class="image_item-category"><?php echo get_category($cat)->name; ?></li>
                                            <?php
                                                    else : break;
                                                    endif;
                                                $categories_index++;
                                                endforeach;
                                        endif; ?>                                      
                                    </ul><!--
                                    --><?php  
                                        // if (function_exists( 'display_pixlikes' )) {
                                        //     display_pixlikes(array('display_only' => 'true', 'class' => 'image_item-like-box likes-box grid__item one-half' ));
                                        // }  
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            // if we added 3 it's now time to add the page title box
            if ($idx == 3) : ?>
            <div class="mosaic__item  mosaic__item--page-title">
                <div class="image__item-link">
                    <div class="image__item-wrapper">
                        <?php if ($has_post_thumbnail) : ?>
                        <img
                            class="js-lazy-load"
                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                            data-src="<?php echo $post_featured_image; ?>"
                            alt=""
                            />
                        <?php endif; ?>                         
                    </div>
                    <div class="image__item-meta">
                        <div class="image_item-table">
                            <div class="image_item-cell">
                                <h1><?php _e('Galleries',wpgrade::textdomain()) ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;
            
            endwhile;
            
            // if there were less than 3 items, still add the title box
            if ($idx < 3) : ?>
            <div class="mosaic__item  mosaic__item--page-title">
                <div class="image__item-link">
                    <div class="image__item-wrapper">
                        <?php if ($has_post_thumbnail) : ?>
                        <img
                            class="js-lazy-load"
                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                            data-src="<?php echo $post_featured_image; ?>"
                            alt=""
                            />
                        <?php endif; ?>                         
                    </div>
                    <div class="image__item-meta">
                        <div class="image_item-table">
                            <div class="image_item-cell">
                                <h1><?php _e('Galleries',wpgrade::textdomain()) ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;
        ?>
    </div><!-- .mosaic -->
</div><!-- .content -->
