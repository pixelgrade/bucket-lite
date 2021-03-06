<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<?php if ( ! empty( $audio_poster ) ) { ?>
	<img class="audio-poster-image" src="<?php echo $audio_poster ?>"/>
<?php } ?>

<audio width="100%" height="auto" controls="control" preload="none">
	<?php if ( $audio_mp3 != '' ) { ?>
		<source type="audio/mp3" src="<?php echo $audio_mp3 ?>"/>
	<?php } ?>
	<?php if ( $audio_m4a != '' ) { ?>
		<source type="audio/mp4" src="<?php echo $audio_m4a ?>"/>
	<?php } ?>
	<?php if ( $audio_oga != '' ) { ?>
		<source type="audio/ogg" src="<?php echo $audio_oga ?>"/>
	<?php } ?>
	<!-- Flash fallback for non-HTML5 browsers without JavaScript -->
	<object width="100%" height="auto" type="application/x-shockwave-flash"
		data="<?php echo wpgrade::coreresourceuri( 'general-media/flashmediaelement.swf' ) ?>">
		<param name="movie" value="<?php echo wpgrade::coreresourceuri( 'general-media/flashmediaelement.swf' ); ?>"/>
		<?php if ( $audio_m4a != '' ) { ?>
			<param name="flashvars" value="controls=true&file=<?php echo $audio_m4a; ?>"/>
		<?php } ?>
	</object>
</audio>