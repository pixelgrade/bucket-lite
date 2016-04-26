<?php
//deal with the excerpt
$excerpt = apply_filters( 'the_excerpt', get_the_excerpt() );

// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
$allowed_tags = '<a><strong><i>';
$excerpt = htmlentities(strip_tags($excerpt, $allowed_tags));
?>

<div id="share-box">
	<?php
	get_template_part('theme-partials/wpgrade-partials/addthis-social-buttons'); ?>
	<ul class="nav">
		<?php
		if ( function_exists( 'display_pixlikes' ) ) {
			display_pixlikes();
		}
		/**
		if ( wpgrade::option('blog_single_share_links_twitter')) { ?>
		<li id="twitter" class="share-item twitter-share" data-url="<?php the_permalink() ?>" data-text="<?php echo get_the_title(); ?>" data-title="Tweet" <?php if (wpgrade::option('twitter_card_site')) echo 'data-via="'.wpgrade::option('twitter_card_site').'"' ?>></li>
		<?php }
		if ( wpgrade::option('blog_single_share_links_facebook')) { ?>
			<li id="facebook" class="share-item facebook-share" data-url="<?php the_permalink() ?>" data-text="<?php echo $excerpt ?>" data-title="Like"></li>
		<?php }
		if ( wpgrade::option('blog_single_share_links_googleplus')) {?>
			<li id="gplus" class="share-item gplus-share" data-url="<?php the_permalink() ?>" data-text="<?php echo $excerpt ?>" data-title="+1"></li>
		<?php } ?>
		<?php if ( wpgrade::option('blog_single_share_links_pinterest')) {?>
			<li id="pinterest" class="share-item pinterest-share" data-url="<?php the_permalink() ?>" data-text="<?php echo $excerpt ?>" data-title="PinIt"></li>
		<?php }
		 *
		 *
		 */?>
		<li class="share-item share-total">
			<div class="share-total__value">0</div>
			<div class="share-total__title"><?php _e('Shares', 'bucket'); ?></div>
		</li>
	</ul>
</div>
<hr class="separator  separator--subsection">