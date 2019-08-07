<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( has_post_thumbnail() ){
	$featured_image_ID = get_post_thumbnail_id( $post->ID );
    $image = wp_get_attachment_image_src( $featured_image_ID, 'blog-big' );

    // bail if the image is empty
    if (  empty( $image ) ) {
        return;
    }

    $image_medium = wp_get_attachment_image_src( $featured_image_ID, 'blog-medium' );

	$image_ratio = bucket::get_image_aspect_ratio( $image );

	// let's get to know this post a little better
	$full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_full_width_featured_image', true);
	$disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_disable_sidebar', true);

	// let's use what we know
	$content_width = $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds';
	$featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds  palm-one-whole';
?>

    <div class="grid__item  float--left  <?php echo $featured_image_width; ?>  article__featured-image" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        <meta itemprop="url" content="<?php echo $image[0]; ?>"/>
        <meta itemprop="width" content="<?php echo $image[1]; ?>"/>
        <meta itemprop="height" content="<?php echo $image[2]; ?>"/>
        <div class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
	        <?php if (wpgrade::option('enable_lazy_loading_images')) { ?>
                <img class="riloadr-single" data-src-big="<?php echo $image[0]; ?>" data-src-small="<?php echo $image_medium[0]; ?>" alt="<?php echo esc_attr( get_the_title($featured_image_ID) ); ?>" />
			<?php } else { ?>
		        <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr( get_the_title( $featured_image_ID ) ); ?>" />
			<?php } ?>
        </div>
    </div><!-- .article__featured-image -->

<?php }