<?php get_header(); ?>

<?php if ( have_posts() ) : ?>


    <div class="masonry" data-columns>
        <?php while ( have_posts() ) : the_post(); ?>
            <article class="masonry__item">

                <?php get_template_part('theme-partials/post-templates/blog-head', get_post_format()); ?>
                
                <?php

                $post_categories = wp_get_post_categories( get_the_ID() );
                $cats = array();

                foreach( $post_categories as $c ) {
                    $cat = get_category( $c );
                    $cats[] = array( 'name' => $cat->name, 'url' => get_category_link($c) );
                }

                ?>

                <?php if ( count($cats) ) { ?>
                    <div class="entry__meta">
                        <div class="image_item-meta grid"><!--
                         --><ul class="image_item-categories grid__item one-half">
                                <li class="image_item-cat-icon"><i class="icon-folder-open"></i></li>
                                <?php foreach( $cats as $category ) { ?>
                                    <li class="image_item-category">
                                        <a href="<?php echo $category['url']; ?>">
                                            <?php echo $category['name']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul><!--
                            .image_item-categories
                         --><div class="image_item-like-box likes-box grid__item one-half">
                                <i class="icon-heart"></i>
                                <div class="likes-text">
                                    <span class="likes-count">10</span> likes
                                </div>
                            </div><!-- .image_item-like-box -->
                        </div><!-- .image_item-meta -->
                    </div><!-- .entry__meta -->
                <?php } ?>

            </article><!-- .masonry__item -->
        <?php endwhile; ?>
    </div><!-- .masonry -->

<?php else : ?>

    <?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>

<?php get_footer(); ?>