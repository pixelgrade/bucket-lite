<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header();

?>

    <div class="container container--main">

    <div class="grid">

    <?php
    // let's get to know this post a little better
    $full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_full_width_featured_image', true);
    $disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_disable_sidebar', true);

    // let's use what we know
    $the_content_width = $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';
    $featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';

    get_template_part('theme-partials/post-templates/header-single', get_post_format()); ?>

    <article class="post-article  js-post-gallery  grid__item  main  float--left  <?php echo $the_content_width; ?>">
    <?php while (have_posts()): the_post();

    get_template_part('theme-partials/post-templates/single-title'); ?>

    <?php
    the_content();

    $args = array(
        'before' => "<ol class=\"nav pagination\"><!--",
        'after' => "\n--></ol>",
        'next_or_number' => 'next_and_number',
        'previouspagelink' => __('Previous', 'bucket-lite'),
        'nextpagelink' => __('Next', 'bucket-lite')
    );
    wp_link_pages( $args ); ?>

        <div class="article__meta  article--single__meta">
            <?php
            $categories = get_the_category();
            if ($categories): ?>
                <div class="btn-list">
                    <div class="btn  btn--small  btn--secondary"><?php _e('Categories', 'bucket-lite') ?></div>
                    <?php
                    foreach ($categories as $category):
                        echo '<a class="btn  btn--small  btn--tertiary" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s", 'bucket-lite'), $category->name)) .'">'. $category->cat_name.'</a>';
                    endforeach; ?>
                </div>
            <?php endif;

            $tags = get_the_tags();
            if ($tags): ?>
                <div class="btn-list">
                    <div class="btn  btn--small  btn--secondary"><?php _e('Tagged', 'bucket-lite') ?></div>
                    <?php
                    foreach ($tags as $tag):
                        echo '<a class="btn  btn--small  btn--tertiary" href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s", 'bucket-lite'), $tag->name)) .'">'. $tag->name.'</a>';
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        $share_buttons_settings = wpgrade::option('share_buttons_settings');
        if ( ! empty( $share_buttons_settings ) && (wpgrade::option('blog_single_share_links_position', 'bottom') == 'bottom' || wpgrade::option('blog_single_share_links_position', 'bottom') == 'both') ) {
            get_template_part('theme-partials/post-templates/share-box');
        }

        get_template_part( 'author-bio' );

        $next_post = get_next_post();
        $prev_post = get_previous_post();
        if (!empty($prev_post) || !empty($next_post)): ?>

            <nav class="post-nav  grid"><!--
                    <?php if (!empty($prev_post) && !empty($next_post)): ?>
                    --><div class="post-nav-link  post-nav-link--prev  grid__item  one-whole  lap-and-up-one-half">
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                <span class="post-nav-link__label">
                                    <?php _e('Previous Article', 'bucket-lite' ); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo $prev_post->post_title; ?></h3>
                                </span>
                    </a>
                </div><!--
                    <?php elseif (empty($next_post) && !empty($prev_post)): ?>
                    --><div class="post-nav-link  post-nav-link--prev  grid__item  one-whole  lap-and-up-one-half">
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                <span class="post-nav-link__label">
                                    <?php _e('Previous Article', 'bucket-lite' ); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo $prev_post->post_title; ?></h3>
                                </span>
                    </a>
                </div><!--
                    --><div class="post-nav-link  post-nav-link--blank  grid__item  one-whole  lap-and-up-one-half">
                    &nbsp;
                </div><!--
                    <?php endif;

                if(!empty($prev_post) && !empty($next_post)) : ?>
                 --><div class="divider--pointer"></div><!--
                    <?php endif;

                if (!empty($next_post) && !empty($prev_post)): ?>
                 --><div class="post-nav-link  post-nav-link--next  grid__item  one-whole  lap-and-up-one-half">
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                                <span class="post-nav-link__label">
                                    <?php _e("Next Article", 'bucket-lite'); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo $next_post->post_title; ?></h3>
                                </span>
                    </a>
                </div><!--
                    <?php elseif (!empty($next_post) && empty($prev_post)): ?>
                    --><div class="post-nav-link  post-nav-link--blank  grid__item  one-whole  lap-and-up-one-half">
                    &nbsp;
                </div><!--
                 --><div class="post-nav-link  post-nav-link--next  grid__item  one-whole  lap-and-up-one-half">
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                                <span class="post-nav-link__label">
                                    <?php _e("Next Article", 'bucket-lite'); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo $next_post->post_title; ?></h3>
                                </span>
                    </a>
                </div><!--
                    <?php endif; ?>
                --></nav>

        <?php endif; ?>

        <hr class="separator  separator--section">

        <?php
        if ( function_exists('related_posts') ) {
            related_posts();
        }

        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() )
            comments_template();

        endwhile; ?>
    </article><!--

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
