<?php
if ( wpgrade::options('blog_single_show_share_links')) : ?>
	<div id="share-box">
		<ul class="nav">
			<li id="pixlikes" class="share-item">
				<div class="share-item__icon"><i class="pixcode pixcode--icon icon-e-heart  circle  small"></i></div>
				<div class="share-item__value">17</div>
			</li>
			<?php if ( wpgrade::options('blog_single_share_links_twitter')) { ?>
				<li id="twitter" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt_rss() ?>" data-title="Tweet"></li>
			<?php }
			if ( wpgrade::options('blog_single_share_links_facebook')) { ?>
				<li id="facebook" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt() ?>" data-title="Like"></li>
			<?php }
			if ( wpgrade::options('blog_single_share_links_googleplus')) {?>
				<li id="gplus" class="share-item" data-url="<?php the_permalink() ?>" data-text="<?php the_excerpt() ?>" data-title="+1"></li>
			<?php } ?>
			<li class="share-item share-total">
				<div class="share-total__value">48</div>
				<div class="share-total__title">Shares</div>
			</li>
		</ul>
	</div>
	<hr class="separator  separator--subsection">
<?php endif;
