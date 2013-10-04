<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>
<article <?php post_class('masonry__item'); ?>>
	<?php 
	get_template_part('theme-partials/post-templates/blog-head', get_post_format());

	$post_categories = wp_get_post_categories( get_the_ID() );
	$cats = array();

	foreach( $post_categories as $c ) {
		$cat = get_category( $c );
		$cats[] = array( 'name' => $cat->name, 'url' => get_category_link($c) );
	}
	if ( count($cats) ) { ?>
		<div class="entry__meta">
			<div class="image_item-meta grid cf"><!--
			 --><ul class="image_item-categories grid__item one-half">
					<li class="image_item-cat-icon"><i class="icon-folder-open"></i></li>
					<?php foreach( $cats as $category ) { ?>
						<li class="image_item-category">
							<a href="<?php echo $category['url']; ?>">
								<?php echo $category['name']; ?>
							</a>
						</li>
					<?php } ?>
				</ul><!--
				 --><?php if (function_exists( 'display_pixlikes' )) {
								display_pixlikes(array('display_only' => 'true', 'class' => 'image_item-like-box grid__item one-half' ));
							} 
						?><!-- .image_item-like-box -->
			</div><!-- .image_item-meta -->
		</div><!-- .entry__meta -->
	<?php } ?>
</article><!-- .masonry__item -->