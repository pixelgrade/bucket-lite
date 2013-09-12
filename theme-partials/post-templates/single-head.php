<?php
	global $post; // @todo CLEANUP verify this global call is required
	$html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'post_html_title', true);
?>

<div class="container">
	<?php if ( ! empty($html_title)): ?>
		<?php wpgrade::display_content($html_title); ?>
	<?php endif; ?>
</div>
