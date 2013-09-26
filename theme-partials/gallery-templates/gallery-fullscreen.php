<div id="main" class="content djax-updatable">            
    <?php

	$gallery_ids = array();
	$gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'main_gallery', true );
	if (!empty($gallery_ids)) {
		$gallery_ids = explode(',',$gallery_ids);
	}
    $attachments = get_posts( array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'orderby' => "post__in",
        'post__in'     => $gallery_ids
    ) );

    if ( $attachments ) : ?>
        <div class="pixslider js-pixslider" data-fullscreen data-customarrows="right">
            <?php 
                foreach ( $attachments as $attachment ) : 
                    $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                    $thumbimg = wp_get_attachment_image_src($attachment->ID, 'big');                            
            ?>                
            <div class="gallery-item">
                <img src="<?php echo $thumbimg[0]; ?>" class="attachment-blog-big rsImg" alt="" />
            </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>            
</div>