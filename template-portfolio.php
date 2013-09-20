<?php 
/*
Template Name: Portfolio
*/
get_header(); ?>
<div id="main" class="content djax-updatable">
    <div class="mosaic">

        <?php
        $args = array(
            'post_type' => 'lens_portfolio',
            'posts_per_page' => -1
        );

        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            $categories = get_the_terms($post->ID, 'portfolio_cat'); ?>
            <div class="mosaic__item slide-in photography <?php if(!has_post_thumbnail()) echo 'project-no-image '; if($categories) foreach($categories as $cat) { echo strtolower($cat->name) . ' '; }?>">
                <a href="<?php the_permalink(); ?>" class="image__item-link">
                   <div class="image__item-wrapper">
                        <?php 
                            if(has_post_thumbnail()) :
                                $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-archive');
                        ?>                        
                            <img
                                class="js-lazy-load"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                data-src="<?php echo $thumb_url[0]; ?>"
                                alt="Photography"
                            />
                        <?php  
                            else :
                        ?>
                            <img
                                class="js-lazy-load"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                data-src="<?php echo get_template_directory_uri().'/wpgrade-content/img/camera.png'; ?>" 
                                alt="Photography"
                            /> 
                        <?php endif; ?>                           
                    </div>                                        
                    <div class="image__item-meta image_item-meta--portfolio">
                        <div class="image_item-table">
                            <div class="image_item-cell image_item--block image_item-cell--top">
                                <h3 class="image_item-title"><?php the_title(); //short_text(get_the_title($post->ID), 20, 20); ?></h3>
                                <span class="image_item-description"><?php short_text(get_the_excerpt(), 50, 50); ?></span>
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
                                            </div>
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
            </div>            
            <?php
        endwhile; endif;
        /* Restore original Post Data */
        wp_reset_postdata();
        ?>
    </div><!-- .mosaic -->
</div><!-- .content -->
<?php get_footer(); ?>