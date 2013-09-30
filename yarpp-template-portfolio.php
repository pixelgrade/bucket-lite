<?php
/*
YARPP Template: Portfolio Related Projects
*/
?>
    <div class="related-projects_items-list-container">
        <?php if (have_posts()):?>
            <ul class="related-projects_items-list"><!--
            <?php while (have_posts()) : the_post(); ?>
                --><li class="related-projects_item">

                  <article>
                      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="image__item-link">

                           <div class="image__item-wrapper">

                                <?php
                                    $image_src = '';
                                    if (has_post_thumbnail()) {
                                        $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-medium');
                                        $image_src = $thumb_url[0];
                                    } else {
                                        $image_src = get_template_directory_uri().'/theme-content/img/camera.png';
                                    }
                                ?>

                                <img
                                    class="js-lazy-load"
                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    data-src="<?php echo $image_src; ?>"
                                    alt="Photography"
                                />

                            </div>

                            <div class="image__item-meta image_item-meta--portfolio">
                                <div class="image_item-table">

                                    <div class="image_item-cell image_item--block image_item-cell--top">
                                        <h3 class="image_item-title"><?php echo get_the_title(); ?></h3>
                                    </div>

                                    <div class="image_item-cell image_item--block image_item-cell--bottom">
                                        <div class="image_item-meta grid">
                                            <ul class="image_item-categories grid__item one-half">
                                                <li class="image_item-cat-icon"><i class="icon-folder-open"></i></li><!--
                                                <?php $categories = get_the_terms($post->ID, 'lens_portfolio_categories');
                                                    if (count($categories)): ?>
                                                        <?php foreach ($categories as $cat): ?>
                                                            --><li class="image_item-category"><?php echo get_category($cat)->name; ?></li><!--
                                                        <?php endforeach; ?>
                                                <?php endif; ?>
                                         --></ul><!--
                                            --><?php if (function_exists( 'display_pixlikes' )) {
                                                display_pixlikes(array('display_only' => 'true', 'class' => 'image_item-like-box likes-box grid__item one-half' ));
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </a>
                  </article>

                </li><!--
            <?php endwhile; ?>
            --></ul>

        <?php else: ?>
        <p><?php _e("No related projects", wpGrade::textdomain()); ?>.</p>
        <?php endif; ?>
    </div>
