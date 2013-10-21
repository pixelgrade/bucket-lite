<?php
/**
 * Posts Grid Card Component
 * Fields available:
 * @posts_source select (featured / latest / latest_by_cat / latest_by_format / latest_by_reviews)
 * @number_of_posts number
 */

$args = array(
    'posts_per_page' => get_sub_field('number_of_posts'),
    'ignore_sticky_posts' => true
);

$myquery = new WP_Query( $args );

if ($myquery->have_posts()): ?>
    <div class="grid fullwidth" data-columns><!--
        <?php while($myquery->have_posts()): $myquery->the_post(); ?>
         --><div><?php get_template_part('theme-partials/post-templates/content-blog'); ?></div><!--
        <?php endwhile; wp_reset_postdata(); ?>
 --></div>
<?php endif; ?>