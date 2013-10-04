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

    $image_scale_mode = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_image_scale_mode', true);

    if ( $attachments ) : ?>
        <div class="pixslider js-pixslider" data-customarrows="right" data-fullscreen  data-imagealigncenter  data-imagescale="<?php echo $image_scale_mode; ?>">
            <?php 
            foreach ( $attachments as $attachment ) :
                $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                $thumbimg = wp_get_attachment_image_src($attachment->ID, 'big');
                $attachment_fields = get_post_custom( $attachment->ID );

                // check if this attachment has a video url
                $video_url = ( isset($attachment_fields['_video_url'][0] ) && !empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';

                //  if there is a video let royal slider know about it
                if ( !empty($video_url) ) { ?>
	                <div class="gallery-item video">
		                <img src="<?php echo $thumbimg[0]; ?>" class="rsImg" data-rsVideo="<?php echo $video_url; ?>" />
	                </div>
                <?php } else { ?>
		            <div class="gallery-item">
		                <img src="<?php echo $thumbimg[0]; ?>" class="attachment-blog-big rsImg" alt="" />
		            </div>
                <?php }
            endforeach; ?>
        </div>

    <?php endif; ?>            
</div>