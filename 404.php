<?php get_header(); ?>
<div id="main" class="content djax-updatable">
<div class="page-content">
    <div class="entry__body">
        <article id="post-0" class="post">
            <header class="entry-header">
                <h2 class="entry__title"><?php _e( 'Oops! That page can&rsquo;t be found.', wpgrade::textdomain() ); ?></h2>
				<p><?php printf( __( 'This may be because of a mistyped URL, faulty referral or out-of-date search engine listing.<br />You should try the <a href="%s">homepage</a> instead or maybe do a search?', wpgrade::textdomain() ), home_url()); ?></p>
				<div class="search-form">
					<?php get_search_form(); ?>
				</div>                 
            </header>
        </article>
    </div>
</div><!-- .page-content -->
<?php get_sidebar(); ?>
</div><!-- .content -->
<?php get_footer(); ?>