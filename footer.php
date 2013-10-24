    <footer class="site-footer">
        <h2 class="accessibility">Footer</h2>
        <div class="widget-area">
            <div class="container">
                <?php if (is_active_sidebar('sidebar-footer')): ?>
                    <div class="grid">
                        <?php dynamic_sidebar('sidebar-footer'); ?>
                    </div>
                <?php else: ?>
                <?php endif; ?>
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