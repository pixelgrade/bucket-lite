<div id="main" class="content djax-updatable">
    <?php
    $ids = array();

    if ( class_exists('Pix_Query') ) {
        $pixquery = new Pix_Query();
        $ids = $pixquery->get_gallery_ids('main_gallery');
    }

    $attachments = get_posts( array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'orderby' => "post__in",
        'post__in'     => $ids
    ) );

    if ( $attachments ) : ?>
        <div class="pixslider js-pixslider" data-customarrows data-bullets>
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