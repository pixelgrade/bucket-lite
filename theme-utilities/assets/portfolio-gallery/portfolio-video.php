<video <?php echo ! empty($video_poster) ? 'poster="'.$video_poster.'"' : ''; ?> width="100%" height="auto" controls="controls" preload="none">

	<?php if ( ! empty($video_mp4)): ?>
		<!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
		<source type="video/mp4" src="<?php echo $video_mp4; ?>" />
	<?php endif; ?>

	<?php if ( ! empty($video_webm)): ?>
		<!-- WebM/VP8 for Firefox4, Opera, and Chrome -->
		<source type="video/webm" src="<?php echo $video_webm; ?>" />
	<?php endif; ?>

	<?php if ( ! empty($video_ogv)): ?>
		<!-- Ogg/Vorbis for older Firefox and Opera versions -->
		<source type="video/ogg" src="<?php echo $video_ogv; ?>" />
	<?php endif; ?>

	<!-- Flash fallback for non-HTML5 browsers without JavaScript -->
	<object width="100%" height="auto" type="application/x-shockwave-flash"
			data="<?php echo wpgrade::coreuri('general-media/flashmediaelement.swf') ?>">

		<param name="movie" value="<?php echo wpgrade::coreuri('general-media/flashmediaelement.swf') ?>" />

		<?php if ( ! empty($video_mp4)): ?>
			<param name="flashvars" value="controls=true&file=<?php echo $video_mp4; ?>" />
		<?php endif; ?>

		<!-- Image as a last resort -->
		<img src="<?php echo ! empty($video_poster) ? $video_poster : wpgrade::coreuri('general-media/images/no-video-image.jpg'); ?>"
			 title="No video playback capabilities" />

	</object>
</video>