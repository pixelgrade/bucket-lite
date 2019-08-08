<?php
/**
 * The default template for a blog post/page, appearing when the post format is 'video'.
 * Requested by page.php and single.php.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// let's get to know this post a little better
$full_width_featured_image = get_post_meta( wpgrade::lang_post_id( get_the_ID() ), '_bucket_full_width_featured_image', true);
$disable_sidebar = get_post_meta( wpgrade::lang_post_id(get_the_ID() ), '_bucket_disable_sidebar', true);

// let's use what we know
$content_width = $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds';
$featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds  palm-one-whole';

$video_embed = get_post_meta( wpgrade::lang_post_id( get_the_ID() ), wpgrade::prefix() . 'video_embed', true);
if ( ! empty( $video_embed ) ){ ?>
	<div class="grid__item  float--left  <?php echo $featured_image_width; ?>  article__featured-image">
        <div class="featured-image">
            <div class="page-header-video">
                <div class="video-wrap">
                    <?php echo stripslashes( htmlspecialchars_decode( $video_embed ) ); ?>
                </div>
            </div>
        </div>
	</div>
<?php }
