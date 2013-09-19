<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>
<div id="contact" class="content">
    <?php if (wpgrade::option('contact_gmap_link')): ?>
        <div id="gmap" class="featured-image" data-url="<?php echo wpgrade::option('contact_gmap_link'); ?>" <?php echo wpgrade::option('contact_gmap_custom_style') ? 'data-customstyle' : ''; ?>></div>
    <?php endif; ?>
    <div class="page-content entry__body">
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
                </header>
                <div class="entry__content"><?php the_content(); ?></div>

            </article>
        <?php endwhile; ?>
    </div><!-- .page-content -->
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>