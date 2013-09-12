<?php if (wpgrade::option('blog_show_featured_image') && ! is_single()): ?>
	<a class="featured-image-blog"
	   href="<?php echo get_permalink() ?>"
	   title="<?php echo esc_attr(strtr( __('Read more about :title', wpgrade::textdomain()), array(':title' => the_title_attribute('echo=0')) )) ?>"
	   rel="bookmark">

		<?php wpgrade_get_thumbnail( 'blog-big', 'entry-featured-image' ) ?>

	</a>
<?php endif; ?>
