<?php get_header(); ?>
<div id="main" class="content djax-updatable">

<div class="page-content  page-content--with-sidebar">

    <div class="page-main entry__body">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part('theme-partials/post-templates/single-head', get_post_format()); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/Article">
                    <header class="entry-header">
                        <div class="entry-header__meta">
                            <div class="article-timestamp article-timestamp--single">
                                <div class="article-timestamp__date"><?php the_time('j'); ?></div>
                                <div class="article-timestamp__right-box">
                                    <span class="article-timestamp__month"><?php the_time('M'); ?></span>
                                    <span class="article-timestamp__year"><?php the_time('Y'); ?></span>
                                </div>
                            </div><!-- .article-timestamp -->
                        </div><!-- .entry-header__meta -->
                        <h1 class="entry__title"><?php the_title(); ?></h1>
                        <hr class="separator separator--dotted separator--full-left grow">
                    </header>

                    
                    <div class="entry__wrap">
                        <div class="entry__likes">
                            <?php if (function_exists( 'display_pixlikes' )) {
                                display_pixlikes(array('class' => 'likes-box--article' ));
                            } ?><!-- .likes-box -->
                        </div>
                        <div class="entry__content"><?php the_content(); ?></div>
                    </div>

	                <?php wp_link_pages(); // pagination for posts with <!--nextpage--> ?>

                    <footer class="entry__meta cf">
                        <?php $categories = wp_get_post_categories($post->ID); ?>
                        <?php if ($categories && count($categories)): ?>
                            <div class="entry__meta-box meta-box--categories">
                                <span class="meta-box__box-title"><?php _e("Filled under", wpgrade::textdomain()); ?>: </span>
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
                                <span class="meta-box__box-title"><?php _e("Tagged", wpgrade::textdomain()); ?>: </span>
                                    <?php foreach ($tags as $tag):  ?>
                                        <a href="<?php echo get_tag_link($tag->term_id); ?>"
                                           rel="tag">
                                            <?php echo $tag->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
    	                <?php if (wpgrade::option('portfolio_single_show_share_links')): ?>
                        <div class="social-links">
                            <span class="social-links__message"><?php _e("Share", wpgrade::textdomain()); ?>: </span>
                            <ul class="social-links__list">
                                <?php if (wpgrade::option('portfolio_single_share_links_twitter')): ?>
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;source=tweetbutton&amp;text=<?php echo urlencode(get_the_title())?>&amp;url=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;via=<?php echo wpgrade::option( 'twitter_card_site' ) ?>" onclick="return popitup(this.href, this.title)"
                                           title="<?php _e('Share on Twitter!', wpgrade::textdomain()) ?>">
                                            <i class="icon-e-twitter-circled"></i>
                                        </a>
                                    </li>
                                <?php endif;
                                if (wpgrade::option('portfolio_single_share_links_facebook')): ?>
                                    <li>
                                        <a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)"
                                           title="<?php _e('Share on Facebook!', wpgrade::textdomain()) ?>">
                                            <i class="icon-e-facebook-circled"></i>
                                        </a>
                                    </li>
                                <?php endif;
                                if (wpgrade::option('portfolio_single_share_links_googleplus')): ?>
                                    <li>
                                        <a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)"
                                           title="<?php _e('Share on Google+!', wpgrade::textdomain()) ?>">
                                            <i class="icon-e-gplus-circled"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    </footer><!-- .entry-meta -->
                    <hr class="separator separator--striped">
                    <?php

	                // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                            comments_template();
                    ?>
                </article>
        <?php endwhile; ?>

    </div><!-- .page-main -->

    <div class="page-side">
        <?php get_sidebar(); ?>
    </div>

</div><!-- .page-content -->

</div><!-- .content -->
<?php get_footer(); ?>