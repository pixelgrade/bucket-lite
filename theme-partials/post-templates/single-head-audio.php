<?php
	$html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'post_html_title', true);
	$audio_embed = get_post_meta($post->ID, wpgrade::prefix().'audio_embed', true)
?>

<div class="page-header">
	<div class="container">

		<?php if( ! empty($audio_embed)): ?>
			<div class="audio-wrap">
				<?php echo stripslashes(htmlspecialchars_decode($audio_embed)) ?>
			</div>
		<?php else: # audio_embed is empty ?>
			<?php wpGrade_audio_selfhosted($post->ID); ?>
		<?php endif; ?>

		<div class="page-header-videohtml-wrap">
			<?php if ( ! empty($html_title)): ?>
				<?php wpgrade::display_content($html_title); ?>
			<?php endif; ?>
		</div>

	</div>
</div>
