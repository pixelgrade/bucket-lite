<?php 
/*
YARPP Template: Simple
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?>
<section class="related-projects_container">
<header class="related-projects_header">
   <h4 class="related-projects_title">Related projects</h4>
   <nav class="related-projects_nav">
       <ul class="related-projects_nav-list">
           <li class="related-projects_nav-item"><a href="#" class="related-projects_nav-link"><i class="icon-arrow-left"></i>Previous</a></li>
           <li class="related-projects_nav-item"><a href="#" class="related-projects_nav-link">All projects</a></li>
           <li class="related-projects_nav-item"><a href="#" class="related-projects_nav-link">Next<i class="icon-arrow-right"></i></a></li>
       </ul>
   </nav>
</header>
<div class="related-projects_items-list-container">
<?php if (have_posts()):?>
    <ul class="related-projects_items-list"><!--
    <?php while (have_posts()) : the_post(); ?>
        --><li class="related-projects_item">
          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="image__item-link">
               <div class="image__item-wrapper">
                    <?php 
                        if(has_post_thumbnail()) the_post_thumbnail(); 
                        $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) )
                    ?>
                    <img
                        class="js-lazy-load"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                        data-src="<?php echo $feat_image; ?>"
                        alt="Photography"
                    />>
                </div>                                        
                <div class="image__item-meta image_item-meta--portfolio">
                    <div class="image_item-table">
                        <div class="image_item-cell image_item--block image_item-cell--top">
                            <h3 class="image_item-title"><?php short_text(get_the_title($post->ID), 13, 13); ?></h3>
                            <span class="image_item-description"><?php short_text(get_the_excerpt(), 13, 13); ?></span>
                        </div>
                        <div class="image_item-cell image_item--block image_item-cell--bottom">
                            <div class="image_item-meta grid">
                                <ul class="image_item-categories grid__item one-half">
                                    <li class="image_item-cat-icon"><i class="icon-folder-open"></i></li><!--
                                    <?php $categories = get_the_terms($post->ID, 'portfolio_cat');
                                        if (count($categories)): ?>
                                            <?php foreach ($categories as $cat): ?>
                                                --><li class="image_item-category"><?php echo get_category($cat)->name; ?></li><!--
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>                                      
                                --></ul><!--
                                --><div class="image_item-like-box likes-box grid__item one-half">
                                    <i class="icon-heart"></i>
                                    <div class="likes-text">
                                        <span class="likes-count">3</span> likes
                                    </div>                                            
                                </div>
                            </div>
                        </div>                                
                    </div>
                </div>
            </a>
        </li><!--
    <?php endwhile; ?>
    --></ul>

<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
</section>
