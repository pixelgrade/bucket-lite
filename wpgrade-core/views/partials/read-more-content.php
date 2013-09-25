<?php
	/* @var stdClass $post */
	/* @var mixed    $more_link */
	/* @var mixed    $more_link_text */
 ?>


<div>
	<a class="btn btn-primary excerpt-read-more"
	   href="<?php echo get_permalink($post->ID) ?>"
	   title="<?php echo __('Read more about', wpgrade::textdomain()).' '.get_the_title($post->ID) ?>">

		<?php echo __('Read more', wpgrade::textdomain()) ?>

	</a>
</div>
