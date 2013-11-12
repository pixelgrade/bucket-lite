<?php
if ( wpgrade::option('blog_single_show_share_links')) : ?>
	<div id="share-box">
		<ul class="nav">
			<?php
			if ( function_exists( 'display_pixlikes' ) ) {
				display_pixlikes();
			}
			if ( wpgrade::option('blog_single_share_links_twitter')) { ?>
				<li id="twitter" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt_rss() ?>" data-title="Tweet"></li>
			<?php }
			if ( wpgrade::option('blog_single_share_links_facebook')) { ?>
				<li id="facebook" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt() ?>" data-title="Like"></li>
			<?php }
			if ( wpgrade::option('blog_single_share_links_googleplus')) {?>
				<li id="gplus" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt() ?>" data-title="+1"></li>
			<?php } ?>
			<li class="share-item share-total">
				<div class="share-total__value">0</div>
				<div class="share-total__title"><?php _e('Shares', wpgrade::textdomain()); ?></div>
			</li>
		</ul>
	</div>
	<hr class="separator  separator--subsection">
<?php endif;
