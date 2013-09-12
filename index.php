<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="masonry">
            <article class="masonry__item">
                <div class="article-timestamp">
                    <div class="article-timestamp__date"><?php the_time('j'); ?></div>
                    <div class="article-timestamp__right-box">
                        <span class="article-timestamp__month"><?php the_time('M'); ?></span>
                        <span class="article-timestamp__year"><?php the_time('Y'); ?></span>
                    </div>
                </div><!-- .article-timestamp -->

                <h2 class="entry__title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="entry__content"><?php the_content(); ?></div>
                <?php

                if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                }

                $post_categories = wp_get_post_categories( get_the_ID() );
                $cats = array();

                foreach( $post_categories as $c ) {
                    $cat = get_category( $c );
                    $cats[] = array( 'name' => $cat->name, 'url' => get_category_link($c) );
                }

                ?>

                <?php if ( count($cats) ) { ?>
                    <div class="entry__meta">
                        <div class="image_item-meta grid">
                            <ul class="image_item-categories grid__item one-half">
                                <li class="image_item-cat-icon"><i class="icon-folder-open"></i></li>
                                <?php foreach( $cats as $category ) { ?>
                                    <li class="image_item-category">
                                        <a href="<?php echo $category['url']; ?>">
                                            <?php echo $category['name']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul><!-- .image_item-categories -->
                            <div class="image_item-like-box likes-box grid__item one-half">
                                <i class="icon-heart"></i>
                                <div class="likes-text">
                                    <span class="likes-count">10</span> likes
                                </div>
                            </div><!-- .image_item-like-box -->
                        </div><!-- .image_item-meta -->
                    </div><!-- .entry__meta -->
                <?php } ?>

            </article><!-- .masonry__item -->
        </div><!-- .masonry -->

    <?php endwhile; ?>

<?php else : ?>

    <?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>