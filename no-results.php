<?php get_header(); ?>
<div id="main" class="content djax-updatable">
<div class="page-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('theme-partials/post-templates/single-head', get_post_format()); ?>
        <div class="entry__body">
            <article id="post-0" class="post error404 not-found">
                <header class="entry-header">
                    <h1 class="heading-404"><?php _e('404', wpgrade::textdomain()); ?></h1>
                    <h1 class="entry__title"><?php _e( 'Oops! That page can&rsquo;t be found.', wpgrade::textdomain() ); ?></h1>
                    <p><?php _e( 'This may be because of a mistyped URL, faulty referral or out-of-date search engine listing. <br />
                                   You should try the <a href="'.home_url().'">homepage</a> instead or maybe do a search?', wpgrade::textdomain() ); ?></p>
                    <div class="search-form">
                        <?php get_search_form(); ?>
                    </div>                 
            </article>
        </div>
    <?php endwhile; ?>
</div><!-- .page-content -->
<?php get_sidebar(); ?>
</div><!-- .content -->
<?php get_footer(); ?>