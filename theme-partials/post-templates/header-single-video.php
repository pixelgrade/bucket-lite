<div class="article__featured-image  grid__item one-whole flush--bottom">
    
    <?php
        $video_embed = get_post_meta($post->ID, wpgrade::prefix().'video_embed', true);
    ?>

    <?php if ( ! empty($video_embed)): ?>
        <div class="featured-image">
            <div class="page-header-video">
                <div class="video-wrap">
                    <?php echo stripslashes(htmlspecialchars_decode($video_embed)) ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>