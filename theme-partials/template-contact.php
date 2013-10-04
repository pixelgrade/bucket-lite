<?php
/*
Template Name: Contact Page
*/

get_header(); ?>

<div id="main" class="content content--contact djax-updatable">
    <?php if (wpgrade::option('contact_gmap_link')): ?>
        <div id="gmap" data-url="<?php echo wpgrade::option('contact_gmap_link'); ?>" <?php echo wpgrade::option('contact_gmap_custom_style') ? 'data-customstyle' : ''; ?>></div>
    <?php endif; ?>
    <div class="page-content entry__body">
        <div class="page-main">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry__title"><?php the_title(); ?></h1>
                        <div class="bleed--left"><hr class="separator separator--dotted grow"></div>
                    </header>
                    <div class="entry__content"><?php the_content(); ?></div>
                </article>
            <?php endwhile; ?>
        </div>
    </div><!-- .page-content -->
</div>
<?php get_footer(); ?>