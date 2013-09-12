<?php
	$video_embed = get_post_meta($post->ID, wpgrade::prefix().'video_embed', true);
?>

<div class="featured-image-blog">
	<?php if ( ! empty($video_embed)): ?>
		<div class="video-wrap">
			<?php echo stripslashes(htmlspecialchars_decode($video_embed)) ?>
		</div>
	<?php else: # video_embed is empty ?>
		<?php wpGrade_video_selfhosted($post->ID); ?>
	<?php endif; ?>
</div>
