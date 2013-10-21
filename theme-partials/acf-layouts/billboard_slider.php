<?php
/**
 * Created by JetBrains PhpStorm.
 * Fields available:
 * @posts_source select (featured / latest / latest_by_cat / latest_by_format / latest_by_reviews)
 * @number_of_posts number
 * @read_more_label string
 */

$args = array(
    'posts_per_page' => 9,
    'ignore_sticky_posts' => true
);

$myquery = new WP_Query( $args );
$index = 0;
$closed_group = true;
if ($myquery->have_posts()):
?>

<div class="billboard pixslider js-pixslider">
    <?php while($myquery->have_posts()): $myquery->the_post(); ?>
        <?php if ($index++ % 3 == 0): ?>
            <?php
                if (!$closed_group):
                    echo '</div><div>';
                else:
                    echo '<div>';
                    $closed_group = false;
                endif;
            ?>
                <article class="article article--billboard">
                    <div class="image-wrap">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="article__header article--billboard__header">
                        <div class="billboard__category">Featured</div>
                        <h2 class="article__title article--billboard__title">
                            <div class="hN"><?php the_title(); ?></div>
                        </h2>
                        <a class="small-link" href="<?php the_permalink(); ?>">Read Full Story &raquo;</a>
                    </div>
                </article>
        <?php else: ?>
            <article class="article article--billboard-small">
                <div class="image-wrap">
                    <?php the_post_thumbnail(); ?>
                </div>
                <h2 class="article__title article--billboard-small__title">
                    <div class="hN"><?php the_title(); ?></div>
                </h2>
                <a class="small-link" href="<?php the_permalink(); ?>">Read More <em>+</em></a>
            </article>
        <?php endif; ?>
    <?php endwhile; wp_reset_postdata();
        if (!$closed_group):
            echo '</div>';
            $closed_group = false;
        endif;
    ?>
</div>

<?php endif; ?>