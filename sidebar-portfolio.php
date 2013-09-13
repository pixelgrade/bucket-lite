<?php get_header(); ?>

<div class="page-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('theme-partials/post-templates/single-head', get_post_format()); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
            <header class="entry-header">
                <h1 class="entry__title"><?php the_title(); ?></h1>
                <div class="entry__content project-entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry__content -->
            </header>
            <hr class="separator--dotted separator--full-left" />
            <footer class="entry__meta entry__meta--project cf">
                <?php $categories = wp_get_post_categories($post->ID); ?>
                <?php if (count($categories)): ?>
                    <div class="entry__meta-box meta-box--categories">
                        <span class="meta-box__box-title">Client: </span>
                        <?php foreach ($categories as $cat): ?>
                                <a href="<?php echo get_category_link($cat); ?>"
                                   rel="category">
                                    <?php echo get_category($cat)->name; ?>
                                </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>    
            </footer><!-- .entry__meta .entry__meta--project -->
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
            yarpp_related(array(
                'threshold' => 0,
                'post_type' => array('project')
            )); 
        ?>
    <?php endwhile; ?>
</div><!-- .page-content -->
<?php get_footer(); ?>