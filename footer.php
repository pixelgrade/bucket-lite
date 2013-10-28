<?php
/**
 * The template for displaying the footer widget areas.
 * @package Bucket
 * @since   Bucket 1.0
**/
?>

<?php
    /* The footer widget area is triggered if any of the areas
     * have widgets. So let's check that first.
     *
     * If none of the sidebars have widgets, then let's bail early.
     */
    if (   ! is_active_sidebar( 'sidebar-footer-first-1' )
        && ! is_active_sidebar( 'sidebar-footer-first-2' )
        && ! is_active_sidebar( 'sidebar-footer-first-3' )
        && ! is_active_sidebar( 'sidebar-footer-second-1' )
        && ! is_active_sidebar( 'sidebar-footer-second-2'  )
    )
        return;
    // If we get this far, we have widgets. Let do this.
?>
    
    <footer class="site-footer">
        <h2 class="accessibility">Footer</h2>
        <div class="widget-area">
            <div class="container">
                <div class="grid widget-area__first">
                    <?php if ( is_active_sidebar( 'sidebar-footer-first-1' ) ) : ?>
                        <div class="grid__item one-third  palm-one-whole">
                            <?php dynamic_sidebar( 'sidebar-footer-first-1' ); ?>
                        </div><!--
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'sidebar-footer-first-2' ) ) : ?>
                        --><div class="grid__item one-third  palm-one-whole">
                            <?php dynamic_sidebar( 'sidebar-footer-first-2' ); ?>
                        </div><!--
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'sidebar-footer-first-3' ) ) : ?>
                        --><div class="grid__item one-third  palm-one-whole">
                            <?php dynamic_sidebar( 'sidebar-footer-first-3' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                 <div class="grid widget-area__second">
                    <?php if ( is_active_sidebar( 'sidebar-footer-second-1' ) ) : ?>
                        <div class="grid__item two-thirds  palm-one-whole">
                            <?php dynamic_sidebar( 'sidebar-footer-second-1' ); ?>
                        </div><!--
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'sidebar-footer-second-2' ) ) : ?>
                        --><div class="grid__item one-third  palm-one-whole">
                            <?php dynamic_sidebar( 'sidebar-footer-second-2' ); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="colophon">
            <div class="container">
                <div class="flexbox">
                    <div class="flexbox__item"><?php echo wpgrade::option('copyright_text') ?></div>
                    <div class="flexbox__item  text--right"><?php wpgrade_footer_nav() ?></div>
                </div>
            </div>
        </div>
    </footer><!-- .site-footer -->

    <!-- Google Analytics tracking code -->
    <?php echo wpgrade::option( 'google_analytics' ) . "\n"; ?>
    </div>
<?php wp_footer(); ?>
</body>
</html>