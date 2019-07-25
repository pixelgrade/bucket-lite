<?php
if (get_the_title()): ?>
	<h1 class="article__title  article__title--single" itemprop="name headline"><?php the_title(); ?></h1>
<?php else: ?>
	<h1 class="article__title  article__title--single" itemprop="name headline"><?php _e('Untitled', 'bucket-lite'); ?></h1>
<?php endif; ?>

<div class="article__title__meta">
	<meta itemprop="datePublished" content="<?php the_time('c'); ?>" />
    <?php if ( get_the_time() != get_the_modified_time() ) : ?>
	<meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>" />
    <?php endif; ?>

		<?php $author_display_name = get_the_author_meta( 'display_name' );
		printf('<div class="article__author-name" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name">%s</span></div>', '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="'.sprintf(__('Posts by %s', 'bucket-lite'), $author_display_name).'" itemprop="sameAs">'.$author_display_name.'</a>') ?>
		<time class="article__time" datetime="<?php the_time('c'); ?>"> <?php printf(__('on %s at %s', 'bucket-lite'),get_the_date(),get_the_time()); ?></time>

</div><!-- .article__title__meta -->
