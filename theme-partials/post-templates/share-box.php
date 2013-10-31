<?php
if ( wpgrade::options('blog_single_show_share_links')) : ?>
	<div id="share-box">
		<?php if ( wpgrade::options('blog_single_share_links_twitter')) { ?>
			<div id="twitter" data-url="<?php the_permalink() ?>" data-text="Make your sharing widget with Sharrre (jQuery Plugin)" data-title="Tweet"></div>
		<?php }
		if ( wpgrade::options('blog_single_share_links_facebook')) { ?>
			<div id="facebook" data-url="<?php the_permalink() ?>" data-text="Make your sharing widget with Sharrre (jQuery Plugin)" data-title="Like"></div>
		<?php }
		if ( wpgrade::options('blog_single_share_links_googleplus')) {?>
			<div id="googleplus" data-url="<?php the_permalink() ?>" data-text="Make your sharing widget with Sharrre (jQuery Plugin)" data-title="+1"></div>
		<?php } ?>
</div>
<?php endif;
