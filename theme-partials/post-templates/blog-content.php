<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>
<article <?php post_class('article  article--grid'); ?>>

	<?php get_template_part('theme-partials/post-templates/blog-head', get_post_format()); ?>

    <div class="article--grid__body">

        <?php 
            $has_thumb = has_post_thumbnail();
            $flush_top = $has_thumb ? '' : 'flush--top'
        ?>

        <a href="<?php the_permalink(); ?>" class="article__title  article--grid__title <?php echo $flush_top; ?>">
            <h3 class="hN"><?php the_title(); ?></h3>
        </a>

        <div class="article__content">
            <?php the_excerpt(); ?>
        </div>

        <div class="article__meta  article--grid__meta">
            <div class="split">
                <div class="split__title  article__category">
                    <?php
                        $categories = get_the_category();
                        if ($categories) {
                            $category = $categories[0];
                            echo '<a class="small-link" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s"), $category->name)) .'">'. $category->cat_name.'</a>';
                        }
                    ?>
                </div>
                <ul class="nav  article__meta-links">
                    <li><a href="#"><i class="icon-time"></i> <?php the_time('j M') ?></a></li>
                    <li><a href="#"><i class="icon-comment"></i>  <?php comments_number('0', '1', '%'); ?></a></li>
                    <li><a href="#"><i class="icon-heart"></i> 12</a></li>
                </ul>
            </div>
        </div>

    </div>

</article><!-- .article -->