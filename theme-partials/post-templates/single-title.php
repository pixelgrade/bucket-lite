<?php
if ( get_the_title() ) { ?>
    <h1 class="article__title  article__title--single" itemprop="name headline"><?php the_title(); ?></h1>
<?php } else { ?>
    <h1 class="article__title  article__title--single"
        itemprop="name headline"><?php esc_html_e( 'Untitled', 'bucket-lite' ); ?></h1>
<?php } ?>

<div class="article__title__meta">
    <meta itemprop="datePublished" content="<?php the_time( 'c' ); ?>"/>
	<?php if ( get_the_time() != get_the_modified_time() ) { ?>
        <meta itemprop="dateModified" content="<?php the_modified_time( 'c' ); ?>"/>
	<?php } ?>

	<?php $author_display_name = get_the_author_meta( 'display_name' );
	/* translators: %s: Author name. */
	printf( '<div class="article__author-name" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name">%s</span></div>',
            '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . sprintf( esc_html__( 'Posts by %s', 'bucket-lite' ), $author_display_name ) . '" itemprop="sameAs">' . $author_display_name . '</a>' ); ?>
    <time class="article__time"
          datetime="<?php the_time( 'c' ); ?>"> <?php printf( /* translators: %1$s: The date, %2$s: The time. */
                                                                esc_html__( 'on %1$s at %2$s', 'bucket-lite' ),
                                                                get_the_date(),
                                                                get_the_time() ); ?>
    </time>

</div><!-- .article__title__meta -->
