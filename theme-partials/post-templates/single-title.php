<?php
if (get_the_title()): ?>
	<h1 class="article__title  article__title--single" itemtype="name"><?php the_title(); ?></h1>
<?php else: ?>
	<h1 class="article__title  article__title--single" itemtype="name"><?php _e('Untitled', wpgrade::textdomain()); ?></h1>
<?php endif; ?>

<div class="article__title__meta">
	<?php $author_display_name = get_the_author_meta( 'display_name' );
	printf('<div class="article__author-name">%s</div>', '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="'.sprintf(__('Posts by %s', wpgrade::textdomain()), $author_display_name).'">'.$author_display_name.'</a>') ?>
	<time class="article__time" datetime="<?php the_time('c'); ?>"> <?php printf(__('on %s', wpgrade::textdomain()),get_the_time(__('j F, Y \a\t H:i', wpgrade::textdomain()))); ?></time>
</div>

