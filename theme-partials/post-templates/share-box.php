<?php
if ( wpgrade::option('blog_single_show_share_links')) : ?>
	<div id="share-box">
		<ul class="nav">
			<?php
			if ( function_exists( 'display_pixlikes' ) ) {
				display_pixlikes();
			}
			if ( wpgrade::option('blog_single_share_links_twitter')) { ?>
			<li id="twitter" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php echo get_the_title(); ?>" data-title="Tweet" <?php if (wpgrade::option('twitter_card_site')) echo 'data-via="'.wpgrade::option('twitter_card_site').'"' ?>></li>
			<?php }
			if ( wpgrade::option('blog_single_share_links_facebook')) { ?>
				<li id="facebook" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt_rss() ?>" data-title="Like"></li>
			<?php }
			if ( wpgrade::option('blog_single_share_links_googleplus')) {?>
				<li id="gplus" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt_rss() ?>" data-title="+1"></li>
			<?php } ?>
			<?php if ( wpgrade::option('blog_single_share_links_pinterest')) {?>
				<li id="pinterest" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt_rss() ?>" data-title="PinIt"></li>
			<?php } ?>
			<li class="share-item share-total">
				<div class="share-total__value">0</div>
				<div class="share-total__title"><?php _e('Shares', wpgrade::textdomain()); ?></div>
			</li>
		</ul>
	</div>
	<hr class="separator  separator--subsection">
<?php endif;
