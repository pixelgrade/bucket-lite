<?php
	/* @var stdClass $post */
	/* @var mixed    $more */
 ?>

<div>
	<a class="btn btn-primary excerpt-read-more"
	   href="<?php echo get_permalink($post->ID) ?>"
	   title="<?php echo __('Read more about', wpgrade::textdomain()).' '.get_the_title($post->ID) ?>">

		<?php echo __('Read more', wpGrade_txtd) ?>

	</a>
</div>