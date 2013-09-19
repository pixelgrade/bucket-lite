<?php
    global $post;
    $quote = get_post_meta($post->ID, wpgrade::prefix().'quote', true);
    $quote_author = get_post_meta($post->ID, wpgrade::prefix().'quote_author', true);
    $quote_author_title = get_post_meta($post->ID, wpgrade::prefix().'quote_author_title', true);
    $quote_author_link = get_post_meta($post->ID, wpgrade::prefix().'quote_author_link', true);
?>

<div class="entry__content  entry--quote__content  entry__body">
    <a class="entry__permalink" href="<?php the_permalink(); ?>">
        <blockquote class="pixcode--testimonial testimonial--big-text">
            <?php if ($quote != ''): ?>
                <p class="quote__content"><?php echo $quote ?></p>
            <?php endif; ?>
            <?php if ($quote_author != ''): ?>
                <p class="author__name"><?php echo $quote_author; ?></p>
            <?php endif; ?>
            <?php if ($quote_author_title != ''): ?>
                <p class="author__title"><?php echo $quote_author_title; ?></p>
            <?php endif; ?>
        </blockquote>
    </a>
</div>