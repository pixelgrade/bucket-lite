<?php get_header(); ?>

<div class="page-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php if ( has_post_thumbnail() ): ?>
            <div class="featured-image-wrapper">
                <div class="featured-image-container">
                    <?php the_post_thumbnail(); ?>
                </div>
            </div>
        <?php endif; ?>
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