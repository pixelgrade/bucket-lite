<?php
if (has_post_thumbnail()):
    // $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-big' );
    // 
    $image_big = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-big' );
    $image_medium = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-medium' );

	// $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-big');
	$image_ratio = 70; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
    if (isset($image_big[1]) && isset($image_big[2]) && $image_big[1] > 0) {
		$image_ratio = $image_big[2] * 100/$image_big[1];
	}

// let's get to know this post a little better
$full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_full_width_featured_image', true);
$disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_disable_sidebar', true);

// let's use what we know
$content_width = $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds';
$featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds  palm-one-whole'; 

?>

    <div class="grid__item  float--left  <?php echo $featured_image_width; ?>  article__featured-image">
        <div class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
            <!-- <img src="<?php echo $image_big[0]; ?>" alt="<?php echo $image_big[0]; ?>" /> -->
            <img class="riloadr_single" data-src-big="<?php echo $image_big[0]; ?>" data-src-medium="<?php echo $image_medium[0]; ?>" alt="<?php echo $image_big[0]; ?>" />
        </div>
    </div>

<?php endif; ?>