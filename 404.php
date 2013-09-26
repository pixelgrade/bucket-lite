<?php get_header(); ?>
<div id="main" class="content djax-updatable">
<div class="page-content">
    <?php get_template_part('theme-partials/post-templates/single-head', get_post_format()); ?>
    <div class="entry__body">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
            <header class="entry-header">
                <h2 class="entry__title"><?php _e( 'Oops! That page can&rsquo;t be found.', wpgrade::textdomain() ); ?></h2>
            </header>
        </article>
    </div>
</div><!-- .page-content -->
<?php get_sidebar(); ?>
</div><!-- .content -->
<?php get_footer(); ?>