<?php get_header(); ?>

<div class="container">

    <div class="grid">

        <div class="grid__item  float--left  two-thirds  article__featured-image">
            <div class="image-wrap"></div>
        </div>
        <div class="grid__item  float--left  two-thirds  palm-one-whole">

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
        
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>

</div>
    
<?php get_footer(); ?>