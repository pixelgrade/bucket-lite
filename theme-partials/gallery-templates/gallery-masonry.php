<div id="main" class="content djax-updatable">
    <div id="gallery">
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
        <div class="mosaic gallery js-gallery">
            <?php 
                foreach ( $attachments as $attachment ) : 
                    $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                    $img['full'] = wp_get_attachment_image_src($attachment->ID, 'full');
                    $img['big'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-big', true);
                    $img['medium'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-medium', true);
                    $img['small'] = wp_get_attachment_image_src($attachment->ID, 'portfolio-medium', true);
            ?>                
            <div class="mosaic__item photography">
                <div class="rsPreloader"></div>
                <a href="<?php echo $img['full'][0]; ?>" class="image__item-link" title="" data-effect="mfp-zoom-in">
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
                                <i class="icon-plus"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>                
            <?php endforeach; ?>
        </div>
    
        <?php endif; ?>     
    </div>
</div>