<?php
	global $post; // @todo CLEANUP verify this global call is required
	$html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'post_html_title', true);
?>

<?php if ( has_post_thumbnail() ): ?>
    <div class="featured-image">
        <?php the_post_thumbnail(); ?>
    </div>
<?php endif; ?>
