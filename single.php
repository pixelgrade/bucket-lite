<?php get_header(); ?>

<div class="container">

    <div class="grid">

        <?php

            // let's get to know this post a little better
            $full_width_featured_image = get_post_meta(get_the_ID(), '_bucket_full_width_featured_image', true);
            $disable_sidebar = get_post_meta(get_the_ID(), '_bucket_disable_sidebar', true);

            // let's use what we know
            $content_width = $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds';
            $featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds  palm-one-whole';

        ?>

        <div class="grid__item  float--left  <?php echo $featured_image_width; ?>  article__featured-image">
            <?php get_template_part('theme-partials/post-templates/header-single', get_post_format()); ?>
        </div>

        <div class="grid__item  float--left  <?php echo $content_width; ?>">

            <?php while (have_posts()): the_post(); ?>

                <h1 class="article__title  article__title--single"><?php the_title(); ?></h1>
                <div class="article__title__meta">
                    <?php printf(__('<div class="article__author-name">%s</div>', wpgrade::textdomain()), get_the_author_link()) ?>
                    <time class="article__time" datetime="<?php the_time('c'); ?>"> on <?php the_time(__('j F, Y \a\t H:i', wpgrade::textdomain())); ?></time>
                </div>
                <?php the_content(); ?>


                <div class="grid">
                    <div class="grid__item two-eighths">
                        <?php if (get_field('enable_review_score') && get_field('score_breakdown')): ?>
                            <div class="score__average-wrapper">
                                <div class="score__average <?php echo get_field('note') ? 'average--with-note' : '' ?>">
                                    <?php
                                        echo get_average_score(); 
                                        if (get_field('note')) {
                                            echo '<div class="score__note">'.get_field('note').'</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div><!--
                 --><?php if (get_field('enable_pros_&_cons_lists')):
                        if (get_field('pros_list')): ?><!--
                         --><div class="score__pros">
                                <div class="score__pros__title">
                                    <h3 class="hN"><?php _e('Good Things', wpgrade::textdomain()); ?></h3>
                                </div>
                                <ul class="score__pros__list">
                                    <?php while(has_sub_fields('pros_list')): ?>
                                        <li class="score_pro"><?php echo get_sub_field('pros_note'); ?></li>      
                                    <?php endwhile; ?>
                                </ul>
                            </div><!--
                        <?php endif;
                        if (get_field('cons_list')): ?>
                         --><div class="score__cons">
                                <div class="score__cons__title">
                                    <h3 class="hN"><?php _e('Bad Things', wpgrade::textdomain()); ?></h3>
                                </div>
                                <ul class="score__cons__list">
                                    <?php while(has_sub_fields('cons_list')): ?>
                                        <li class="score__con"><?php echo get_sub_field('cons_note'); ?></li>      
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>


                <?php
                    if (get_field('enable_review_score')):
                        if (get_field('score_breakdown')): ?>
                            <h3>The Breakdown</h3>
                            <hr class="separator  separator--subsection">
                            <?php while (has_sub_fields('score_breakdown')): ?>
                                <div class="review__score">
                                    <div class="score__label"><?php echo get_sub_field('label'); ?></div>
                                    <span class="score__badge  badge"><?php echo get_sub_field('score'); ?></span>
                                    <div class="score__progressbar  progressbar">
                                        <div class="progressbar__progress" style="width: <?php echo get_sub_field('score')*10; ?>%;"></div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <hr class="separator  separator--subsection">
                        <?php endif;
                    endif;
                ?>

                <div class="article__meta  article--single__meta">
                    <?php
                        if (get_field('credits')):
                            while (has_sub_field('credits')): ?>
                                <div class="btn-list">
                                    <div class="btn  btn--small  btn--secondary"><?php echo get_sub_field('name'); ?></div>
                                    <a href="<?php echo get_sub_field('full_url'); ?>" class="btn  btn--small  btn--primary"><?php echo get_sub_field('label'); ?></a>
                                </div>
                            <?php endwhile;
                        endif;
                    ?>
                    <div class="btn-list">
                        <div class="btn  btn--small  btn--secondary">Categories</div>
                        <?php
                            $categories = get_the_category();
                            if ($categories) {
                                foreach ($categories as $category):
                                    echo '<a class="btn  btn--small  btn--tertiary" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s"), $category->name)) .'">'. $category->cat_name.'</a>';
                                endforeach;
                            }
                        ?>
                    </div>
                    <div class="btn-list">
                        <div class="btn  btn--small  btn--secondary">Tagged</div>
                        <?php
                            $tags = get_the_tags();
                            if ($tags):
                                foreach ($tags as $tag):
                                    echo '<a class="btn  btn--small  btn--tertiary" href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s"), $tag->name)) .'">'. $tag->name.'</a>';
                                endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <aside class="author" itemscope itemtype="http://schema.org/Person">
                    <div class="author__avatar">
                        <?php
//                            if (function_exists('get_avatar_url')) {
                                echo '<img src="'. bucket::get_avatar_url(get_the_author_meta('email'), '78') . '" itemprop="image"/>';
//                            } else if (function_exists('get_avatar')) {
//                                echo get_avatar(get_the_author_meta('email'), '78');
//                            }
                        ?>
                    </div>
                    <div class="author__text">
                        <div class="author__title">
                            <h3 class="accessibility"><?php _e('Author', wpgrade::textdomain()); ?></h3>
                            <div class="hN">
                                <span itemprop="name"><?php the_author_posts_link(); ?></span>
                            </div>
                        </div>
                        <p class="author__bio" itemprop="description"><?php the_author_meta('description'); ?></p>
                        <ul class="author__social-links">
                            <?php if ( get_the_author_meta('user_tw') ): ?>
                                <li class="author__social-links__list-item">
                                    <a class="author__social-link" href="https://twitter.com/<?php echo get_the_author_meta('user_tw') ?>" target="_blank">Twitter</a>
                                </li>
                            <?php endif; ?>
                            <?php if ( get_the_author_meta('user_fb') ): ?>
                                <li class="author__social-links__list-item">
                                    <a class="author__social-link" href="https://www.facebook.com/<?php echo get_the_author_meta('user_fb') ?>" target="_blank">Facebook</a>
                                </li>
                            <?php endif; ?>
                            <?php if ( get_the_author_meta('google_profile') ): ?>
                                <li class="author__social-links__list-item">
                                    <a class="author__social-link" href="<?php echo get_the_author_meta('google_profile') ?>" target="_blank">Google</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </aside>

                <hr class="separator  separator--subsection">
                
                <?php
                    $next_post = get_next_post();
                    $prev_post = get_previous_post();
                    if (!empty($prev_post) || !empty($next_post)):
                ?>
                    <nav class="post-nav">
                        <div class="post-nav-link  post-nav-link--prev">
                            <?php if (!empty($prev_post)): ?>
                                <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                    <div class="post-nav-link__label">
                                        <?php _e("Previous Article", wpgrade::textdomain()); ?>
                                    </div>
                                    <div class="post-nav-link__title">
                                        <div class="hN"><?php echo $prev_post->post_title; ?></div>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div><!-- 
                     --><div class="divider--pointer"></div><!--
                     --><div class="post-nav-link  post-nav-link--next">
                            <?php if (!empty($next_post)): ?>
                                <a href="<?php echo get_permalink($next_post->ID); ?>">
                                    <div class="post-nav-link__label">
                                        <?php _e("Next Article", wpgrade::textdomain()); ?>
                                    </div>
                                    <div class="post-nav-link__title">
                                        <div class="hN"><?php echo $next_post->post_title; ?></div>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div> 
                    </nav>
                <?php endif; ?>
                <hr class="separator  separator--section">
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>
            <?php endwhile; ?>

        </div><!--
        
        <?php if ($disable_sidebar != 'on'): ?>
         --><div class="grid__item  one-third  palm-one-whole  sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php else: // ugly ?>
         -->
        <?php endif; ?>

    </div>

</div>
    
<?php get_footer(); ?>