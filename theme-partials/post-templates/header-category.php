<?php
/**
 * The default template for the slider that contains posts from a specific category.
 * Requested by category.php.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$post_args = array( 
		'numberposts' => -1,
		'offset'=> 0,
		'post_type'     => 'post',
		'post_status'   => 'publish',
	);
$post_args['category'] = get_query_var('cat');

$post_args['meta_query'] = 
	array(
		array(
			'key' => wpgrade::prefix() . 'category_slide',
			'value' => 'on'
		)
	);

$slideposts = get_posts( $post_args );

//hold the post slides ids so we exclude them from the rest of the posts
$slideposts_ids = array();
//catch the output so we can prevent the slider if no post with thumbnails found
ob_start();
if ( count( $slideposts ) ){ ?>
<div class="category__featured-posts">
	<div class="pixslider js-pixslider"
		data-arrows
		data-fullscreen
		data-imagealigncenter
		data-autoscalesliderwidth="692"
		data-autoscalesliderheight="400"
		data-imagescale="fill"
		data-slidertransition="move">
		<?php
		foreach( $slideposts as $post ) {
		    setup_postdata( $post );
			$post_title = get_the_title();
			$post_link = get_permalink();
			$thumb_id = get_post_thumbnail_id( $post->ID );
			$thumb_img = wp_get_attachment_image_src( $thumb_id, "post-big" );
			if (!empty($thumb_id)){
				//add the id to the array
				$slideposts_ids[] = $post->ID;
			?>
			<article class="featured-area__article article--big">
				<a href="<?php echo esc_url( $post_link ); ?>" class="image-wrap">
					<div class="gallery__item" itemscope itemtype="http://schema.org/ImageObject" >
						<img src="<?php echo $thumb_img[0]; ?>" class="attachment-blog-big  rsImg  invisible" alt="" itemprop="contentURL" />
					</div>
					<div class="article__title">
						 <h2 class="hN"><?php echo esc_html( $post_title ); ?></h2>
					</div>
				</a>
            </article>
		<?php
            }
        }
		wp_reset_postdata();
		wp_reset_query(); ?>
	</div>
</div>
<?php 
}

//if we had posts that have thumbnails then we desperately need to output something
if ( !empty( $slideposts_ids ) ) {
	ob_end_flush();
} else {
	ob_end_clean();
}
