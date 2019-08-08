<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<article <?php post_class('article  article--grid'); ?>>
	<?php get_template_part('theme-partials/post-templates/header-blog', get_post_format()); ?>
    <div class="article--grid__body">
        <div class="article__content">
            <?php the_excerpt(); ?>
        </div>
    </div>
    <div class="article__meta  article--grid__meta">
        <div class="split">
            <div class="split__title  article__category">
                <?php
                    $categories = get_the_category();
                    if ($categories) {
                        $category = $categories[0];
                        /* translators: %s: Category name. */
                        echo '<a class="small-link" href="'. esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( esc_html__( "View all posts in %s", 'bucket-lite'), esc_html( $category->name ) ) .'">'. esc_html( $category->cat_name ) . '</a>';
                    }
                ?>
            </div>
			<ul class="nav  article__meta-links">
				<li class="xpost_date"><i class="icon-time"></i> <?php the_time('j M') ?></li>
				<?php if ( comments_open() ){ ?>
					<li class="xpost_comments"><i class="icon-comment"></i>  <?php comments_number('0', '1', '%'); ?></li>
				<?php } ?>
			</ul>
        </div>
    </div>

</article><!-- .article -->
