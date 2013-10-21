<?php
/**
 * Latest Posts Component
 * Fields :
 * @number_of_posts number
 * @pagination radio (enable / disable)
 * @section_title string
 * @sidebar radio (enable / disable)
 */

$args = array(
    'posts_per_page' => get_sub_field('number_of_posts'),
    'ignore_sticky_posts' => true
);

$myquery = new WP_Query( $args );
function has_sidebar() {
    return get_sub_field('sidebar') == 'enable';
}

if ($myquery->have_posts()):
    if (has_sidebar()): ?>
        <div class="grid">
            <div class="grid__item  two-thirds  palm-one-whole">
    <?php endif; ?>
        <div class="grid <?php echo has_sidebar() ? '' : 'fullwidth' ?>" data-columns><!--
            <?php while($myquery->have_posts()): $myquery->the_post(); ?>
             --><div><?php get_template_part('theme-partials/post-templates/content-blog'); ?></div><!--
            <?php endwhile; wp_reset_postdata(); ?>
     --></div>
    <?php if (has_sidebar()): ?>
            </div><!--
         --><div class="grid__item  one-third  palm-one-whole  sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>