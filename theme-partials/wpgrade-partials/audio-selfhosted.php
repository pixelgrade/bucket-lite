<?php
defined( 'ABSPATH' ) or die;

if ( ! empty( $audio_poster ) ): ?>
	<img class="audio-poster-image" src="<?php echo $audio_poster ?>"/>
<?php endif;

$mp3_attr = '';
$ogg_attr = '';

if(!empty($audio_mp3)) {
	$mp3_attr = 'mp3="'.$audio_mp3 .'"';
}

if(!empty($audio_ogg)) {
	$ogg_attr = 'ogg="'.$audio_ogg .'"';
}

echo(do_shortcode('[audio '.$mp3_attr.' '.$ogg_attr.'][/audio]'));

