<?php get_header(); ?>
<div id="main" class="content djax-updatable">
<div class="page-content">
        <div class="page-main">
            <article id="post-0" class="post">
                <header class="entry__header">
                    <h1 class="entry__title"><?php _e( 'Oops! That page can&rsquo;t be found.', wpgrade::textdomain() ); ?></h1>
                    <div class="bleed--left"><hr class="separator separator--dotted grow"></div>
                </header>                
                <div class="entry__body">
                    <p><?php printf( __( 'This may be because of a mistyped URL, faulty referral or out-of-date search engine listing.<br />You should try the <a href="%s">homepage</a> instead or maybe do a search?', wpgrade::textdomain() ), home_url()); ?></p>
                    <div class="search-form">
                        <?php get_search_form(); ?>
                    </div>                 
                </div>
            </article>
            <?php get_sidebar(); ?>        
        </div>
</div><!-- .page-content -->
</div><!-- .content -->
<?php get_footer(); ?>