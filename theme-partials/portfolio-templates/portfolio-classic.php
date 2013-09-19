<div id="main" class="content djax-updatable">
    <div class="page-content">        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
            <header class="entry-header">
                <h1 class="entry__title"><?php the_title(); ?></h1>
                <div class="entry__content project-entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry__content -->
            </header>
            <hr class="separator--dotted separator--full-left" />
            <footer class="entry__meta entry__meta--project cf">
                <div class="entry__meta-box meta-box--client">
                    <span class="meta-box__box-title">Client: </span>
                    <a href="http://localhost/prism/?cat=2" title="View all posts in Ideas" rel="category">Yale House of Style</a>
                </div>                 
                <?php $categories = get_the_terms($post->ID, 'lens_portfolio_categories');
                    if (count($categories) && !is_wp_error($categories)): ?>
                    <div class="entry__meta-box meta-box--categories span-12 hand-span-6">
                        <span class="meta-box__box-title">Filled under: </span>
                        <?php foreach ($categories as $cat): ?>
                                <a href="<?php echo get_category_link($cat); ?>"
                                   rel="category">
                                    <?php echo get_category($cat)->name; ?>
                                </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>       
            </footer><!-- .entry__meta .entry__meta --project -->
            <hr class="separator separator--full-left"/>
            <footer class="entry__meta cf">
               <div class="likes-box likes-box--footer">
                    <i class="icon-heart"></i>
                    <div class="likes-text">
                        <span class="likes-count">3</span> likes
                    </div>
                </div>                                
                <div class="social-links">
                    <span class="social-links__message">Share: </span>
                    <ul class="social-links__list">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-google-plus"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                    </ul>
                </div>
            </footer><!-- .entry__meta -->
        </article>
        <?php 
            if (is_plugin_active('yet-another-related-posts-plugin/yarpp.php')) {
                yarpp_related(array(
                    'threshold' => 0,
                    'post_type' => array('lens_portfolio')
                )); 
            }
        ?>
    </div><!-- .page-content -->
</div><!-- .content -->