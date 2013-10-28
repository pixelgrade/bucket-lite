<div class="article__featured-image  flush--bottom">
    <?php
        if (has_post_thumbnail()):
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-big');
            $image_ratio = $image[2] * 100/$image[1];
    ?>
        <a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
            <img src="<?php echo $image[0] ?>" />
        </a>
    <?php endif; ?>

</div>