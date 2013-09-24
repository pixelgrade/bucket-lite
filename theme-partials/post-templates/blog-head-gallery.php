<?php global $post; ?>
<div class="article-timestamp">
    <div class="article-timestamp__date"><?php the_time('j'); ?></div>
    <div class="article-timestamp__right-box">
        <span class="article-timestamp__month"><?php the_time('M'); ?></span>
        <span class="article-timestamp__year"><?php the_time('Y'); ?></span>
    </div>
</div><!-- .article-timestamp -->

<h2 class="entry__title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h2>
<hr class="separator separator--dotted grow">
<div class="featured-image">
    <?php wpGrade_gallery_slideshow($post); ?>     
</div>