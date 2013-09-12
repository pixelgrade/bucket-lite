<?php
	$video_embed = get_post_meta($post->ID, wpgrade::prefix().'video_embed', true);
?>

<?php if ( ! empty($video_embed)): ?>
	<div class="page-header-video">
		<div class="video-wrap">
			<?php echo stripslashes(htmlspecialchars_decode($video_embed)) ?>
		</div>
	</div>
<?php else: # video_ember is empty ?>
	<?php wpGrade_video_selfhosted($post->ID); ?>
<?php endif; ?>