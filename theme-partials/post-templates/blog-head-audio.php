<?php
	$audio_embed = get_post_meta($post->ID, wpgrade::prefix().'audio_embed', true)
?>

<div class="featured-image-blog">
	<?php if ( ! empty($audio_embed)): ?>
		<div class="audio-wrap">
			<?php echo stripslashes(htmlspecialchars_decode($audio_embed)) ?>
		</div>
	<?php else: # audio_embed is empty ?>
		<?php wpGrade_audio_selfhosted($post->ID); ?>
	<?php endif; ?>
</div>
