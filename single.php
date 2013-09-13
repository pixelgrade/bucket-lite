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
                <?php $categories = wp_get_post_categories($post->ID); ?>
                <?php if (count($categories)): ?>
                    <div class="entry__meta-box meta-box--categories">
                        <span class="meta-box__box-title">Filled under: </span>
                        <?php foreach ($categories as $cat): ?>
                                <a href="<?php echo get_category_link($cat); ?>"
                                   rel="category">
                                    <?php echo get_category($cat)->name; ?>
                                </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php $tags = wp_get_post_tags($post->ID); ?>
                <?php if (count($tags)): ?>
                    <div class="entry__meta-box meta-box--tags">
                        <span class="meta-box__box-title">Tagged: </span>
                            <?php foreach ($tags as $tag):  ?>
                                <a href="<?php echo get_tag_link($tag->term_id); ?>"
                                   rel="tag">
                                    <?php echo $tag->name; ?>
                                </a>
                            <?php endforeach; ?>
                    </div>
                <?php endif; ?>                
                <div class="social-links">
                    <span class="social-links__message">Share: </span>
                    <ul class="social-links__list">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-google-plus"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                    </ul>
                </div>
            </footer><!-- .entry-meta -->
            <hr class="separator">
            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
            ?>
        </article>
    <?php endwhile; ?>
</div><!-- .page-content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>