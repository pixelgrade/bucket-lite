<div id="main" class="content djax-updatable">
	<?php
    $password = false;
    if ( isset( $_POST['submit_password']) ) { // when we have a submision check the password and its submision
        if ( isset( $_POST['submit_password_nonce'] ) && wp_verify_nonce( $_POST['submit_password_nonce'], 'password_protection') ) {
            if ( isset ( $_POST['post_password'] ) && !empty($_POST['post_password']) ) { // some simple checks on password
                // finally test if the password submitted is correct
                if ( $post->post_password ===  $_POST['post_password'] ) {
                    $password = true;
                } else {
                    echo '<h3 class="text--error">Wrong Password</h3>';
                }
            }
        }
    }

    if ( post_password_required() && !$password ) { // password protection ?>
    <div class="page-content">
        <div class="page-main">
            <header class="entry__header">
                <h1 class="entry__title">Password <?php the_title(); ?></h1>
                <div class="bleed--left"><hr class="separator separator--dotted grow"></div>
            </header>
            <div class="entry__body">
                <form method="post" action="<?php the_permalink() ?>" class="comment-respond">
                    <?php wp_nonce_field('password_protection','submit_password_nonce'); ?>
                    <input type="hidden" name="submit_password" value="1" />
                    <p>To view it please enter your password below:</p>
                    <h4 class="text--error">Wrong Password</h4>
                    <p>Please enter your password again:</p>
                    <div class="row">
                        <div class="col-6 hand-span-6">
                            <input type="password" required="required" size="20" id="pwbox-531" name="post_password" placeholder="Password.."/></label><br/>
                        </div>
                        <div class="col-6 hand-span-6">
                            <input type="submit" name="Submit" class="btn btn--huge"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <?php
    } else { // password protection

        $gallery_ids = array();
        $gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'main_gallery', true );
        if (!empty($gallery_ids)) {
            $gallery_ids = explode(',',$gallery_ids);
        }

        $thumb_orientation = get_post_meta( $post->ID, wpgrade::prefix() . 'thumb_orientation', true );
        if(empty($thumb_orientation)) $thumb_orientation = 'horizontal';

        $attachments = get_posts( array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'orderby' => "post__in",
            'post__in'     => $gallery_ids
        ) );

        $show_gallery_title = get_post_meta( $post->ID, wpgrade::prefix() . 'show_gallery_title', true );
        if (empty($show_gallery_title)) {
            $show_gallery_title = false;
        }

        $has_post_thumbnail = has_post_thumbnail();
        if ($has_post_thumbnail) {
            if($thumb_orientation == 'portrait')
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big-v', true);
            else
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big', true);
            $featured_image = $featured_image[0];
        }

        $index = 0;
        if ( $attachments ) : ?>
            <div class="mosaic gallery js-gallery">
                <div class="mosaic__item <?php if($thumb_orientation == 'portrait') echo 'mosaic__item--portrait'; ?> mosaic__item--page-title-mobile">
                    <div class="image__item-link">
                        <div class="image__item-wrapper">
                        <?php if ($has_post_thumbnail) : ?>
                        <img
                            class="js-lazy-load"
                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                            data-src="<?php echo $featured_image; ?>"
                            alt=""
                            />
                        <?php endif; ?>
                        </div>
                        <div class="image__item-meta">
                            <div class="image_item-table">
                                <div class="image_item-cell">
                                    <h1><?php the_title(); ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                foreach ( $attachments as $attachment ) :
                    $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                    $attachment_fields = get_post_custom( $attachment->ID );

                    if ($thumb_orientation == 'portrait') {
                        $img['full'] = wp_get_attachment_image_src($attachment->ID, 'full');
                        $img['big'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-big-v', true);
                        $img['medium'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-medium-v', true);
                        $img['small'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-medium-v', true);
                    } else {
                        $img['full'] = wp_get_attachment_image_src($attachment->ID, 'full');
                        $img['big'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-big', true);
                        $img['medium'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-medium', true);
                        $img['small'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-medium', true);
                    }

                    // check if this attachment has a video url
                    $video_url = ( isset($attachment_fields['_video_url'][0] ) && !empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';
                    $is_video = false;
                    //  if there is one let royal slider know about it
                    if ( !empty($video_url) ) {
                        $img['full'][0] = $video_url;
                        $is_video = true;
                    } ?>
                    <div class="mosaic__item <?php if($thumb_orientation == 'portrait') echo 'mosaic__item--portrait'; ?>">
                        <a href="<?php echo $img['full'][0]; ?>" class="<?php if ($is_video) { echo 'mfp-iframe mfp-video'; } else { echo 'mfp-image'; } ?> image__item-link" title="" data-effect="mfp-zoom-in">
                            <div class="image__item-wrapper">
                                <img
                                    class="js-lazy-load"
                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    data-src="<?php echo $img['big'][0]; ?>"
                                    data-big="<?php echo $img['big'][0]; ?>"
                                    data-medium="<?php echo $img['medium'][0]; ?>"
                                    data-small="<?php echo $img['small'][0]; ?>"
                                    alt=""
                                    />
                            </div>
                            <div class="image__item-meta">
                                <div class="image_item-table">
                                    <div class="image_item-cell">
                                        <?php if ( $is_video ) { ?>
                                            <i class="icon-play"></i>
                                        <?php } else { ?>
                                            <div class="image__plus-icon">+</div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php

                    // if we added 3 it's now time to add the gallery title box

                    if (++$index == 3 && $show_gallery_title) : ?>
                        <div class="mosaic__item<?php if($thumb_orientation == 'portrait') echo ' mosaic__item--portrait'; ?> mosaic__item--page-title">
                            <div class="image__item-link">
                                <div class="image__item-wrapper">
                                <?php if ($has_post_thumbnail) : ?>
                                <img
                                    class="js-lazy-load"
                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    data-src="<?php echo $featured_image; ?>"
                                    alt=""
                                    />
                                <?php endif; ?>
                                </div>
                                <div class="image__item-meta">
                                    <div class="image_item-table">
                                        <div class="image_item-cell">
                                            <h1><?php the_title(); ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;
                endforeach;
                // if there were less than 3, still add the title
                if ($index < 3 && $show_gallery_title) : ?>
                    <div class="mosaic__item<?php if($thumb_orientation == 'portrait') echo ' mosaic__item--portrait'; ?> mosaic__item--page-title">
                        <div class="image__item-link">
                            <div class="image__item-wrapper">
                                <?php if ($has_post_thumbnail) : ?>
                                <img
                                    class="js-lazy-load"
                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    data-src="<?php echo $featured_image; ?>"
                                    alt=""
                                    />
                                <?php endif; ?>
                            </div>
                            <div class="image__item-meta">
                                <div class="image_item-table">
                                    <div class="image_item-cell">
                                        <h1><?php the_title(); ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif;
    } // password protection ?>
</div>