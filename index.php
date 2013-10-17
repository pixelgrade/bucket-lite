<?php get_header(); ?>

<div class="container">

    <?php

    $args = array(
        'posts_per_page' => 1,
        // 'post__not_in' => get_option('sticky_posts'),
        'ignore_sticky_posts' => true,
        'offset' => 0
    );
    $myquery = new WP_Query( $args );

    if ($myquery->have_posts()):

    ?>

        <div class="featured-area">
            <?php while($myquery->have_posts()): $myquery->the_post(); ?>
                <div class="featured-area__article  article--big">
                    <?php
                        if (has_post_thumbnail()):
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                            $image_ratio = $image[2] * 100/$image[1];
                    ?>
                        <a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
                            <img src="<?php echo $image[0] ?>" />
                            <div class="article__title">
                                <h3 class="hN"><?php the_title(); ?></h3>
                            </div>
                        </a>
                    <?php endif; ?>
                    <?php post_format_icon('post-format-icon--featured'); ?>
                </div><!--
            <?php endwhile; wp_reset_postdata(); ?>
         --><div class="featured-area__aside">
                <ul class="block-list  block-list--alt">
                    <?php
                        $args = array(
                            'posts_per_page' => 3,
                            // 'post__not_in' => get_option('sticky_posts'),
                            'ignore_sticky_posts' => true,
                            'offset' => 1
                        );
                        $myquery = new WP_Query( $args );
                        while($myquery->have_posts()): $myquery->the_post();
                    ?>
                        <li class="hard--sides">
                            <article class="article  article--thumb  media  flush--bottom">
                                <div class="media__img--rev  five-twelfths">
                                    <?php
                                        if (has_post_thumbnail()):
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                                            $image_ratio = $image[2] * 100/$image[1];
                                    ?>
                                            <a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
                                                <img src="<?php echo $image[0] ?>" />
                                            </a>
                                    <?php endif; ?>
                                </div>
                                <div class="media__body">
                                    <?php
                                        $categories = get_the_category();
                                        if ($categories) {
                                            $category = $categories[0];
                                            echo '<a class="small-link" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s"), $category->name)) .'">'. $category->cat_name.'</a>';
                                        }
                                    ?>
                                    <div class="article__title  article--thumb__title">
                                        <h3 class="hN"><?php the_title(); ?></h3>
                                    </div>
                                    <ul class="nav  article__meta-links">
                                        <li><a href="#"><i class="icon-time"></i> <?php the_time('j M') ?></a></li>
                                        <li><a href="#"><i class="icon-comment"></i>  <?php comments_number('0', '1', '%'); ?></a></li>
                                        <li><a href="#"><i class="icon-heart"></i> 12</a></li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole">
            <?php if (have_posts()): ?>
                <div class="heading  heading--main">
                    <h2 class="hN">Latest Articles</h2>
                </div>
                <div class="grid" data-columns>
                    <?php while (have_posts()): the_post(); ?><!--
                     --><div><?php get_template_part('theme-partials/post-templates/content-blog'); ?></div><!--
                 --><?php endwhile; ?>
                    <?php wpgrade::pagination(); ?>
                </div>
            <?php else: get_template_part( 'no-results', 'index' ); endif; ?>
        </div><!--
        
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>
    
<?php get_footer(); ?>