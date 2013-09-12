<?php if (wpgrade::option('blog_show_featured_image') && !is_single() && has_post_thumbnail()): ?>
	<a class="featured-image-blog" rel="bookmark"
	   href="<?php echo get_permalink() ?>"
	   title="<?php echo esc_attr(strtr( __('Read more about :title', wpgrade::textdomain()), array(':title' => the_title_attribute('echo=0')) )) ?>">

		<?php wpgrade_get_thumbnail( 'blog-big', 'entry-featured-image' ) ?>

	</a>
<?php endif; ?>