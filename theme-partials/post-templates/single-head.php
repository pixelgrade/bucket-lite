<?php
	global $post; // @todo CLEANUP verify this global call is required
	$html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'post_html_title', true);
?>

<?php if ( has_post_thumbnail() ): ?>
    <div class="featured-image-wrapper">
        <div class="featured-image-container">
            <?php the_post_thumbnail(); ?>
        </div>
    </div>
<?php endif; ?>
