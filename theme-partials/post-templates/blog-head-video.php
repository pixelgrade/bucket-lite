<div class="article-timestamp">
    <div class="article-timestamp__date"><?php the_time('j'); ?></div>
    <div class="article-timestamp__right-box">
        <span class="article-timestamp__month"><?php the_time('M'); ?></span>
        <span class="article-timestamp__year"><?php the_time('Y'); ?></span>
    </div>
</div><!-- .article-timestamp -->

<div class="entry__header">
    <h2 class="entry__title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <hr class="separator separator--dotted grow">    
    <div class="entry__content"><?php the_excerpt(); ?></div>
</div>
<?php if ( has_post_thumbnail() ) : ?>
    <div class="entry__featured-image">
        <a href="<?php the_permalink(); ?>" class="image__item-link mfp-video">
            <div class="image__item-wrapper">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="image__item-meta">
                <div class="image_item-table">
                    <div class="image_item-cell">
                        <i class="icon-play"></i>
                    </div>
                </div>
            </div>            
        </a>
    </div>
<?php endif; ?>