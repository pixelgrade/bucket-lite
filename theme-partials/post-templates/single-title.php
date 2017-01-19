<?php
if (!isset($is_review)) {
	$is_review = bucket::has_average_score();
}
if (get_the_title()): ?>
	<h1 class="article__title  article__title--single" <?php echo $is_review ? 'itemprop="name itemreviewed"' : 'itemprop="name headline"'; ?>><?php the_title(); ?></h1>
<?php else: ?>
	<h1 class="article__title  article__title--single" <?php echo $is_review ? 'itemprop="name itemreviewed"' : 'itemprop="name headline"'; ?>><?php _e('Untitled', 'bucket'); ?></h1>
<?php endif; ?>

<div class="article__title__meta">
	<meta <?php echo $is_review ? 'itemprop="dtreviewed"' : 'itemprop="datePublished"'; ?> content="<?php the_time('c'); ?>" />
    <?php if ( get_the_time() != get_the_modified_time() ) : ?>
	<meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>" />
    <?php endif; ?>

	<?php if (wpgrade::option('blog_single_show_title_meta_info')):?>
		<?php $author_display_name = get_the_author_meta( 'display_name' );
		printf('<div class="article__author-name" ' . ( $is_review ? 'itemprop="reviewer author"' : 'itemprop="author"' ) .' itemscope itemtype="http://schema.org/Person"><span itemprop="name">%s</span></div>', '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="'.sprintf(__('Posts by %s', 'bucket'), $author_display_name).'" itemprop="sameAs">'.$author_display_name.'</a>') ?>
		<time class="article__time" datetime="<?php the_time('c'); ?>"> <?php printf(__('on %s at %s', 'bucket'),get_the_date(),get_the_time()); ?></time>
	<?php endif; ?>
</div><!-- .article__title__meta -->
<?php
$share_buttons_settings = wpgrade::option('share_buttons_settings');
if ( ! empty( $share_buttons_settings ) && (wpgrade::option('blog_single_share_links_position', 'bottom') == 'top' || wpgrade::option('blog_single_share_links_position', 'bottom') == 'both') ) {
	get_template_part('theme-partials/post-templates/share-box-top');
} ?>