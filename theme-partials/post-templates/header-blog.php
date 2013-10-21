<div class="article__featured-image">
    <?php
    if (has_post_thumbnail()):
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $image_ratio = $image[2] * 100/$image[1];
    ?>
        <a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
            <img src="<?php echo $image[0] ?>" />
        </a>
    <?php
    endif;
    ?>

    <?php post_format_icon();
	if ( bucket::has_avarage_score() ) { ?>
        <div class="badge  badge--article"><?php echo bucket::get_average_score();?> <span class="badge__text">score</span></div>
	<?php } ?>
</div>