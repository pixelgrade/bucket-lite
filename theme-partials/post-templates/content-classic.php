<?php
/**
 * Template to display the article in archives in a clasic way
 */
?>
<article <?php post_class('article  article--thumb media flush--bottom'); ?>>
	<div class="media__img--rev  four-twelfths">
		<?php
		if (has_post_thumbnail()):
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-small');
			$image_ratio = $image[2] * 100/$image[1]; ?>
			<a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
				<img src="<?php echo $image[0] ?>" />
			</a>
		<?php endif; ?>
	</div>
	<div class="media__body">
		<?php
		$categories = get_the_category();
		if ($categories) {
			$category = $categories[0];
			echo '<div class="article__category">
                                            <a class="small-link" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s", wpgrade::textdomain()), $category->name)) .'">'. $category->cat_name.'</a>
                                          </div>';
		} ?>
		<div class="article__title  article--thumb__title">
			<a href="<?php the_permalink(); ?>"><h3 class="hN"><?php the_title(); ?></h3></a>
		</div>
		<ul class="nav  article__meta-links">
			<li><i class="icon-time"></i> <?php the_time('j M') ?></li>
			<li><i class="icon-comment"></i>  <?php comments_number('0', '1', '%'); ?></li>
			<li><i class="icon-heart"></i> <?php if ( function_exists('get_pixlikes') ) {echo get_pixlikes(wpgrade::lang_original_post_id(get_the_ID()));} ?></li>
		</ul>
	</div>
</article>