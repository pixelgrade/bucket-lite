<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<div class="container container--main">

    <div class="grid">

		<?php
		// let's get to know this post a little better
		$full_width_featured_image = get_post_meta( wpgrade::lang_post_id( get_the_ID() ), '_bucket_full_width_featured_image', true );
		$disable_sidebar           = get_post_meta( wpgrade::lang_post_id( get_the_ID() ), '_bucket_disable_sidebar', true );

		// let's use what we know
		$the_content_width    = $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';
		$featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';

		get_template_part( 'theme-partials/post-templates/header-single', get_post_format() ); ?>

        <article
                class="post-article  js-post-gallery  grid__item  main  float--left  <?php echo $the_content_width; ?>">
			<?php while ( have_posts() ) {
				the_post();

				get_template_part( 'theme-partials/post-templates/single-title' ); ?>

				<?php
				the_content();

				$args = array(
					'before'           => "<ol class=\"nav pagination\"><!--",
					'after'            => "\n--></ol>",
					'next_or_number'   => 'next_and_number',
					'previouspagelink' => esc_html__( 'Previous', 'bucket-lite' ),
					'nextpagelink'     => esc_html__( 'Next', 'bucket-lite' )
				);
				wp_link_pages( $args ); ?>

                <div class="article__meta  article--single__meta">
					<?php
					$categories = get_the_category();
					if ( $categories ) { ?>
                        <div class="btn-list">
                            <div class="btn  btn--small  btn--secondary"><?php esc_html_e( 'Categories', 'bucket-lite' ) ?></div>
							<?php
							foreach ( $categories as $category ) {
								/* translators: %s: Category name */
								echo '<a class="btn  btn--small  btn--tertiary" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( esc_attr__( 'View all posts in %s', 'bucket-lite' ), esc_html( $category->name ) ) . '">' . esc_html( $category->name ) . '</a>';
							} ?>
                        </div>
					<?php }

					$tags = get_the_tags();
					if ( $tags ) { ?>
                        <div class="btn-list">
                            <div class="btn  btn--small  btn--secondary"><?php esc_html_e( 'Tagged', 'bucket-lite' ) ?></div>
							<?php
							foreach ( $tags as $one_tag ) {
								/* translators: %s: Tag name */
								echo '<a class="btn  btn--small  btn--tertiary" href="' . esc_url( get_tag_link( $one_tag->term_id ) ) . '" title="' . sprintf( esc_attr__( 'View all posts tagged %s', 'bucket-lite' ), esc_html( $one_tag->name ) ) . '">' . esc_html( $one_tag->name ) . '</a>';
							} ?>
                        </div>
					<?php } ?>
                </div>
				<?php

				get_template_part( 'author-bio' );

				$next_post = get_next_post();
				$prev_post = get_previous_post();
				if ( ! empty( $prev_post ) || ! empty( $next_post ) ) { ?>
                    <nav class="post-nav  grid"><!--
                    <?php if ( ! empty( $prev_post ) && ! empty( $next_post ) ){ ?>
                    --><div class="post-nav-link  post-nav-link--prev  grid__item  one-whole  lap-and-up-one-half">
                            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                                <span class="post-nav-link__label">
                                    <?php esc_html_e( 'Previous Article', 'bucket-lite' ); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo esc_html( $prev_post->post_title ); ?></h3>
                                </span>
                            </a>
                        </div><!--
                    <?php } elseif ( empty( $next_post ) && ! empty( $prev_post ) ){ ?>
                    --><div class="post-nav-link  post-nav-link--prev  grid__item  one-whole  lap-and-up-one-half">
                            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                                <span class="post-nav-link__label">
                                    <?php esc_html_e( 'Previous Article', 'bucket-lite' ); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo esc_html( $prev_post->post_title ); ?></h3>
                                </span>
                            </a>
                        </div><!--
                    --><div class="post-nav-link  post-nav-link--blank  grid__item  one-whole  lap-and-up-one-half">
                            &nbsp;
                        </div><!--
                    <?php }

						if ( ! empty( $prev_post ) && ! empty( $next_post ) ){ ?>
                 --><div class="divider--pointer"></div><!--
                    <?php }

						if ( ! empty( $next_post ) && ! empty( $prev_post ) ){ ?>
                 --><div class="post-nav-link  post-nav-link--next  grid__item  one-whole  lap-and-up-one-half">
                            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                                <span class="post-nav-link__label">
                                    <?php esc_html_e( 'Next Article', 'bucket-lite' ); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo esc_html( $next_post->post_title ); ?></h3>
                                </span>
                            </a>
                        </div><!--
                    <?php } elseif ( ! empty( $next_post ) && empty( $prev_post ) ){ ?>
                    --><div class="post-nav-link  post-nav-link--blank  grid__item  one-whole  lap-and-up-one-half">
                            &nbsp;
                        </div><!--
                 --><div class="post-nav-link  post-nav-link--next  grid__item  one-whole  lap-and-up-one-half">
                            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                                <span class="post-nav-link__label">
                                    <?php esc_html_e( 'Next Article', 'bucket-lite' ); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo esc_html( $next_post->post_title ); ?></h3>
                                </span>
                            </a>
                        </div><!--
                    <?php } ?>
                --></nav>

				<?php } ?>

                <hr class="separator  separator--section">

				<?php

				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) {
					comments_template();
				}

			} ?>
        </article><!--

        <?php if ( $disable_sidebar != 'on' ){ ?>
         --><div class="grid__item  one-third  palm-one-whole  sidebar">
		    <?php get_sidebar();
		    } else { // ugly ?>
                -->
		    <?php } ?>
        </div>

    </div>
</div>

<?php get_footer();
