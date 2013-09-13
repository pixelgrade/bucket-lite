<?php
	$video_embed = get_post_meta($post->ID, wpgrade::prefix().'video_embed', true);
?>

<?php if ( ! empty($video_embed)): ?>
    <div class="featured-image-wrapper">
        <div class="featured-image-container">
            <div class="page-header-video">
                <div class="video-wrap">
                    <?php echo stripslashes(htmlspecialchars_decode($video_embed)) ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>