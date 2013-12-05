<?php
/**
 * The template for displaying the footer widget areas.
 * @package Bucket
 * @since   Bucket 1.0
**/
?>   
    </div><!-- .wrapper --> 
    
    <?php if (wpgrade::option('posts_stats')): ?>
    <div class="site__stats">
        <div class="container">
            <ul class="stat-group nav nav--banner">
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:10%">1</dd>
                        <dt class="stat__title">Nov</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:100%">10</dd>
                        <dt class="stat__title">Dec</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:60%">6</dd>
                        <dt class="stat__title">Jan</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:30%">3</dd>
                        <dt class="stat__title">Feb</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:10%">1</dd>
                        <dt class="stat__title">Nov</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:100%">10</dd>
                        <dt class="stat__title">Dec</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:60%">6</dd>
                        <dt class="stat__title">Jan</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:30%">3</dd>
                        <dt class="stat__title">Feb</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:10%">1</dd>
                        <dt class="stat__title">Nov</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:100%">10</dd>
                        <dt class="stat__title">Dec</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:60%">6</dd>
                        <dt class="stat__title">Jan</dt>
                    </a>
                </li>
                <li>
                    <a href="#" class="stat">
                        <dd class="stat__value" style="height:30%">3</dd>
                        <dt class="stat__title">Feb</dt>
                    </a>
                </li>
            </ul>
            
            <?php if (wpgrade::option('posts_stats')): ?>
            <div class="back-to-top"><a href="#">Back to Top</a></div>
            <?php endif; ?>
            
        </div>
    </div>
    <?php endif; ?>
    
    <footer class="site__footer">
        
        <h2 class="accessibility"><?php __('Footer', wpgrade::textdomain()) ?></h2>
		
    	<?php

    	/* The footer widget area is triggered if any of the areas
    	 * have widgets. So let's check that first.
    	 *
    	 * If none of the sidebars have widgets, then let's bail early.
    	 */
    	if (is_active_sidebar('sidebar-footer-first-1')
    	 || is_active_sidebar('sidebar-footer-first-2')
    	 || is_active_sidebar('sidebar-footer-first-3')
    	 || is_active_sidebar('sidebar-footer-second-1')
    	 || is_active_sidebar('sidebar-footer-second-2')
    	):

    	// If we get this far, we have widgets. Let do this.
    	?>

            <div class="footer__sidebar">

                <div class="container">
                    
                    <div class="footer__widget-area  grid"><!--
                        <?php if ( is_active_sidebar( 'sidebar-footer-first-1' ) ) : ?>
                         --><div class="grid__item one-third  palm-one-whole">
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
                            </div><!--
                        <?php endif; ?>
                 --></div>
                    
                    <div class="footer__widget-area  grid"><!--

                        <?php if ( is_active_sidebar( 'sidebar-footer-second-1' ) ) : ?>
                         --><div class="grid__item two-thirds  palm-one-whole">
                                <?php dynamic_sidebar( 'sidebar-footer-second-1' ); ?>
                            </div><!--
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'sidebar-footer-second-2' ) ) : ?>
                            --><div class="grid__item one-third  palm-one-whole">
                                <?php dynamic_sidebar( 'sidebar-footer-second-2' ); ?>
                            </div><!--
                        <?php endif; ?>
                        
                 --></div>

                </div>

            </div>

    	<?php endif; ?>
		
        <div class="footer__copyright">
            <div class="container">
                <div class="flexbox">
                    <div class="footer-copyright flexbox__item"><?php echo wpgrade::option('copyright_text') ?></div>
                    <div class="footer-menu flexbox__item "><?php wpgrade_footer_nav() ?></div>
                </div>
            </div>
        </div>

    </footer><!-- .site__footer -->
    
    </div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>