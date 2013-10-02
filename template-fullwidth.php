<?php 
/*
Template Name: Full Width Page
*/ 
get_header(); ?>
<div id="main" class="content full-width djax-updatable">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php if ( has_post_thumbnail() ): ?>
            <div class="featured-image"><?php the_post_thumbnail(); ?></div>
        <?php endif; ?>
        <div class="page-content">
            <div class="page-main">
                <article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
                    <header class="entry__header">
                        <h1 class="entry__title"><?php the_title(); ?></h1>
                        <div class="bleed--left"><hr class="separator separator--dotted grow"></div>
                    </header>
                    
                    <div class="entry__body">
                        <div class="entry__content"><?php the_content(); ?></div>
                        <?php if ( comments_open() || '0' != get_comments_number() ): ?>
                            <hr class="separator separator--striped">
                            <?php comments_template(); ?>
                        <?php endif; ?>
                    </div>
                </article>
            </div>
        </div><!-- .page-content -->
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>