<?php

//let's make sure that WordPress allows the upload of our used mime types
add_filter('upload_mimes', 'wpgrade_custom_upload_mimes');
function wpgrade_custom_upload_mimes ( $existing_mimes=array() ) {
	// Add file extension 'extension' with mime type 'mime/type'
	$existing_mimes['mp3'] = 'audio/mpeg3';
	$existing_mimes['oga'] = 'audio/ogg';
	$existing_mimes['ogv'] = 'video/ogg';
	$existing_mimes['mp4a'] = 'audio/mp4';
	$existing_mimes['mp4'] = 'video/mp4';
	$existing_mimes['weba'] = 'audio/webm';
	$existing_mimes['webm'] = 'video/webm';

	return $existing_mimes;
}

//=====================================
// Post audio
//=====================================

if ( !function_exists( 'wpGrade_audio_selfhosted' ) )
{
    function wpGrade_audio_selfhosted($postID)
    {

        $audio_mp3 = get_post_meta($postID, wpgrade::prefix().'audio_mp3', TRUE);
        $audio_m4a = get_post_meta($postID, wpgrade::prefix().'audio_m4a', TRUE);
        $audio_oga = get_post_meta($postID, wpgrade::prefix().'audio_ogg', TRUE);
        $audio_poster = get_post_meta($postID, wpgrade::prefix().'audio_poster', true);

        ?>
        <?php if (!empty($audio_poster)) :?>
        <img class="audio-poster-image" src="<?php echo $audio_poster ?>" />
    <?php endif; ?>
        <audio width="100%" height="auto" controls="control" preload="none">
            <?php if($audio_mp3 != '') : ?>
                <source type="audio/mp3" src="<?php echo $audio_mp3 ?>" />
            <?php endif; ?>
            <?php if($audio_m4a != '') : ?>
                <source type="audio/mp4" src="<?php echo $audio_m4a ?>" />
            <?php endif; ?>
            <?php if($audio_oga != '') : ?>
                <source type="audio/ogg" src="<?php echo $audio_oga ?>" />
            <?php endif; ?>
            <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
            <object width="100%" height="auto" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/library/js/plugins/flashmediaelement.swf">
                <param name="movie" value="<?php echo get_template_directory_uri(); ?>/library/js/plugins/flashmediaelement.swf" />
                <?php if($audio_m4a != '') : ?>
                    <param name="flashvars" value="controls=true&file=<?php echo $audio_m4a; ?>" />
                <?php endif; ?>
            </object>
        </audio>
    <?php
    }
}

//=====================================
// Post video
//=====================================

if ( !function_exists( 'wpGrade_video_selfhosted' ) ) {

    function wpGrade_video_selfhosted($postID) {

        $video_m4v = get_post_meta($postID, wpgrade::prefix().'video_m4v', true);
        $video_webm = get_post_meta($postID, wpgrade::prefix().'video_webm', true);
        $video_ogv = get_post_meta($postID, wpgrade::prefix().'video_ogv', true);
        $video_poster = get_post_meta($postID, wpgrade::prefix().'video_poster', true); ?>

        <video <?php echo !empty($video_poster) ? 'poster="'.$video_poster.'"' : ''; ?> width="100%" height="auto" controls="controls" preload="none">
            <?php if($video_m4v != '') : ?>
                <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
                <source type="video/mp4" src="<?php echo $video_m4v; ?>" />
            <?php endif; ?>
            <?php if($video_webm != '') : ?>
                <!-- WebM/VP8 for Firefox4, Opera, and Chrome -->
                <source type="video/webm" src="<?php echo $video_webm; ?>" />
            <?php endif; ?>
            <?php if($video_ogv != '') : ?>
                <!-- Ogg/Vorbis for older Firefox and Opera versions -->
                <source type="video/ogg" src="<?php echo $video_ogv; ?>" />
            <?php endif; ?>
            <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
            <object width="100%" height="auto" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/library/js/plugins/flashmediaelement.swf">
                <param name="movie" value="<?php echo get_template_directory_uri(); ?>/library/js/plugins/flashmediaelement.swf" />
                <?php if($video_m4v != '') : ?>
                    <param name="flashvars" value="controls=true&file=<?php echo $video_m4v; ?>" />
                <?php endif; ?>
                <!-- Image as a last resort -->
                <img src="<?php echo !empty($video_poster) ? $video_poster : get_template_directory_uri().'/library/images/mediaelement/no-video-image.jpg'; ?>" title="No video playback capabilities" />
            </object>
        </video>

    <?php }
}

function wpgrade_post_videos_ids($post_id)
{
    $result = null;
    $matches = null;

    $vembed = get_post_meta($post_id, wpgrade::prefix().'vimeo_link', true);
    if (preg_match('#(src=\"[^0-9]*)?vimeo\.com/(video/)?(?P<id>[0-9]+)([^\"]*\"|$)#', $vembed, $vmatches))
    {
        $result['vimeo'] = $vmatches["id"];
    }

    $yembed = get_post_meta($post_id, wpgrade::prefix().'youtube_id', true);
    if (preg_match('/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)(?P<id>[^#\&\?\"]*).*/', $yembed, $ymatches))
    {
        $result['youtube'] = $ymatches["id"];
    }

    return $result;
}

//=====================================
// Post gallery
//=====================================

/**
 *  We check if there is a gallery shortcode in the content, extract it and display it in the form of a slideshow
 */
if(!function_exists('wpGrade_gallery_slideshow'))
{
	function wpGrade_gallery_slideshow($current_post)
	{
		//search for the first gallery shortcode
		preg_match("!\[gallery.+?\]!", $current_post->post_content, $match_gallery);

		if(!empty($match_gallery))
		{
			$gallery = $match_gallery[0];

			if(strpos($gallery, 'style') === false) $gallery = str_replace("]", " style='big_thumb' size='blog-big' link='file']", $gallery);
			//output the gallery
            echo '<div class="wp-slider gallery_format_slider">';
			echo do_shortcode($gallery);
            echo '</div>';
		}
	}
	
	//remove the first gallery shortcode from the content
	function wpGrade_gallery_slideshow_filter($content) {
		if (get_post_format() == 'gallery') {
			//search for the first gallery shortcode
			preg_match("!\[gallery.+?\]!", $content, $match_gallery);

			if(!empty($match_gallery))
			{			
				$content = str_replace($match_gallery[0], "", $content);
			}
		}

		return $content;
	}
	add_filter( 'the_content', 'wpGrade_gallery_slideshow_filter' );
}

//extract the fist image in the content
function wpgrade_get_post_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "";
  }
  return $first_img;
}