<?php
	$html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'post_html_title', true);
	$audio_embed = get_post_meta($post->ID, wpgrade::prefix().'audio_embed', true)
?>

<div class="featured-image">
    <?php if( ! empty($audio_embed)): ?>
		<?php echo stripslashes(htmlspecialchars_decode($audio_embed)) ?>
    <?php else: # audio_embed is empty ?>
    	<?php wpGrade_audio_selfhosted($post->ID); ?>
    <?php endif; ?>
</div>