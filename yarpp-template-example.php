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
        <?php if (function_exists('yapb_is_photoblog_post')): if (yapb_is_photoblog_post()):?>

        --><li class="related-projects_item">
          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="image__item-link">
               <div class="image__item-wrapper">
                    <?php if(has_post_thumbnail()) the_post_thumbnail(); ?>
                    <!-- <img
                        class="js-lazy-load"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                        data-src="img/medium-1.jpg"
                        alt="Photography"
                    /> -->
                </div>                                        
                <div class="image__item-meta image_item-meta--portfolio">
                    <div class="image_item-table">
                        <div class="image_item-cell image_item--block image_item-cell--top">
                            <h3 class="image_item-title">New York City</h3>
                            <span class="image_item-description">Drive by shooting</span>
                        </div>
                        <div class="image_item-cell image_item--block image_item-cell--bottom">
                            <div class="image_item-meta grid">
                                <ul class="image_item-categories grid__item one-half">
                                    <li class="image_item-cat-icon"><i class="icon-folder-open"></i></li>
                                    <li class="image_item-category">Models</li>
                                    <li class="image_item-category">Traveling</li>
                                </ul><!--
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
        <?php endif; endif; ?>
    <?php endwhile; ?>
    --></ul>

<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
</section>
