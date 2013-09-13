<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>
<div id="gmap">
    <div class="contact-info-wrapper" data-gmap-url="https://maps.google.com/maps?hl=en&ll=40.700797,-73.782163&spn=0.015861,0.033023&sll=47.167718,27.502856&sspn=0.028447,0.066047&t=m&z=16" data-custom-style="1">
        <div class="contact-info">
            <div class="pin_ring pin_ring--outer">
                <div class="pin_ring pin_ring--inner"></div>
            </div>
        </div>
    </div>
    <div id="map_canvas" style="width: 100%; height: 100%"></div>
</div>
<div class="page-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
            <header class="entry-header">
                <div class="entry-header__meta">
                    <div class="article-timestamp article-timestamp--single">
                        <div class="article-timestamp__date"><?php the_time('j'); ?></div>
                        <div class="article-timestamp__right-box">
                            <span class="article-timestamp__month"><?php the_time('M'); ?></span>
                            <span class="article-timestamp__year"><?php the_time('Y'); ?></span>
                        </div>
                    </div><!-- .article-timestamp -->
                    <div class="likes-box likes-box--article">
                        <i class="icon-heart"></i>
                        <div class="likes-text">
                            <span class="likes-count">10</span> likes
                        </div>
                    </div><!-- .image_item-like-box -->
                </div><!-- .entry-header__meta -->
                <h1 class="entry__title"><?php the_title(); ?></h1>
                <div class="entry__content"><?php the_content(); ?></div>
            </header>
            
            <footer class="entry__meta cf">
            </footer>

            <?php if ( comments_open() || '0' != get_comments_number() ): ?>
                <hr class="separator">
                <?php comments_template(); ?>
            <?php endif; ?>
        </article>
    <?php endwhile; ?>
</div><!-- .page-content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>