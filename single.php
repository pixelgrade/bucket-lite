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

                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>

                <div class="article__meta  article--single__meta">
                    <div class="btn-list">
                        <div class="btn  btn--small  btn--secondary">Source</div>
                        <a href="#" class="btn  btn--small  btn--primary">The Verge</a>
                    </div>
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