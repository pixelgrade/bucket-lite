<?php
    global $post;
    $quote = get_post_meta($post->ID, wpgrade::prefix().'quote', true);
    $quote_author = get_post_meta($post->ID, wpgrade::prefix().'quote_author', true);
    $quote_author_title = get_post_meta($post->ID, wpgrade::prefix().'quote_author_title', true);
    $quote_author_link = get_post_meta($post->ID, wpgrade::prefix().'quote_author_link', true);
?>

<div class="entry__content  entry--quote__content  entry__body">
    <a class="entry__permalink" href="<?php the_permalink(); ?>">
        <blockquote class="pixcode--testimonial testimonial--medium-text">
            <?php if ($quote != ''): ?>
                <div class="testimonial__content">
                    <p class="quote__content"><?php echo $quote ?></p>
                </div>
            <?php if ($quote_author != ''): ?>
                <div class="testimonial__author-name"><?php echo $quote_author; ?></div>
            <?php endif; ?>
            <?php if ($quote_author_title != ''): ?>
                <div class="testimonial__author-title"><?php echo $quote_author_title; ?></div>
            <?php endif;
            endif; ?>
        </blockquote>
    </a>
</div>