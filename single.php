<?php get_header(); ?>
<div id="main" class="content djax-updatable">
<div class="page-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('theme-partials/post-templates/single-head', get_post_format()); ?>
        <div class="entry__body">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                <header class="entry-header">
                    <div class="entry-header__meta">
                        <div class="article-timestamp article-timestamp--single">
                            <div class="article-timestamp__date"><?php the_time('j'); ?></div>
                            <div class="article-timestamp__right-box">
                                <span class="article-timestamp__month"><?php the_time('M'); ?></span>
                                <span class="article-timestamp__year"><?php the_time('Y'); ?></span>
                            </div>
                        </div><!-- .article-timestamp -->
                        <?php if (function_exists( 'display_pixlikes' )) {
                                display_pixlikes(array('class' => 'likes-box--article' ));
                            } 
                        ?><!-- .likes-box -->
                    </div><!-- .entry-header__meta -->
                    <h1 class="entry__title"><?php the_title(); ?></h1>
                    <hr class="separator separator--dotted separator--full-left grow">
                </header>
                
                <div class="entry__content">
                    <?php
                        $my_content = apply_filters('the_content', get_the_content());
                        $start = strpos($my_content, '<p>') + 3;
                        $end = strpos($my_content, '</p>');
                        echo '<div class="first-paragraph">' . wpgrade_callback_theme_general_filters(substr($my_content, $start, $end - $start)) . '</div>';
                        echo substr($my_content, $end + 4);
                    ?>
                </div>
                
                <footer class="entry__meta cf">
                    <?php $categories = wp_get_post_categories($post->ID); ?>
                    <?php if (count($categories)): ?>
                        <div class="entry__meta-box meta-box--categories">
                            <span class="meta-box__box-title"><?php _e("Filled under", wpGrade::textdomain()); ?>: </span>
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
                            <span class="meta-box__box-title"><?php _e("Tagged", wpGrade::textdomain()); ?>: </span>
                                <?php foreach ($tags as $tag):  ?>
                                    <a href="<?php echo get_tag_link($tag->term_id); ?>"
                                       rel="tag">
                                        <?php echo $tag->name; ?>
                                    </a>
                                <?php endforeach; ?>
                        </div>
                    <?php endif; ?>                
                    <div class="social-links">
                        <span class="social-links__message"><?php _e("Share", wpGrade::textdomain()); ?>: </span>
                        <ul class="social-links__list">
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                            <li><a href="#"><i class="icon-google-plus"></i></a></li>
                            <li><a href="#"><i class="icon-pinterest"></i></a></li>
                        </ul>
                    </div>
                </footer><!-- .entry-meta -->
                <hr class="separator separator--striped">
                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>
            </article>
        </div>
    <?php endwhile; ?>
</div><!-- .page-content -->
<?php get_sidebar(); ?>
</div><!-- .content -->
<?php get_footer(); ?>