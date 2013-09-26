<?php while (have_posts()): the_post(); ?>

	<?php
		$html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'post_html_title', true);
	?>

	<?php if (get_post_format() == 'gallery'): ?>
		<div class="wrapper-featured-image">
			<div class="featured-image-container" style="background-color: <?php echo get_post_meta(get_the_ID(), wpgrade::prefix().'header_background_color', true); ?>;">
				<div class="featured-image-container-wrapper content-bigger s-inverse">
					<?php get_template_part('theme-partials/post-templates/single-head', get_post_format() ); ?>
				</div>
			</div>
		</div>

	<?php elseif (get_post_format() == 'image'): ?>

		<?php
		$featured_id = wpgrade_get_attachment_id_from_src(wpgrade_get_post_first_image());
		$featured_image = wp_get_attachment_image_src($featured_id, 'full');
		if (empty($height) && empty($html_title)) {
			$height = 'data-width="'. $featured_image[1] .'" data-height="'. $featured_image[2] .'"';
		}
		?>

		<div class="wrapper-featured-image">
			<div class="parallax-container" <?php echo $height ?>>
				<div class="parallax-item header-image"
					 style="background-image: url(<?php echo $featured_image[0] ?>);">
				</div>
			</div>
		</div>
	<?php elseif (get_post_format() == 'video'): ?>
		<div class="wrapper-featured-image">
			<div class="featured-image-container" style="background-color: <?php echo get_post_meta(get_the_ID(), wpgrade::prefix().'header_background_color', true); ?>;min-height: 500px;">
				<div class="featured-image-container-wrapper content-bigger s-inverse">
					<?php get_template_part('theme-partials/post-templates/single-head', get_post_format() ); ?>
				</div>
			</div>
		</div>
	<?php else: # not video format ?>

		<?php
			$header_height = absint(wpgrade::option('nocontent_header_height'));
			$height = '';

			if ($header_height && empty($html_title)) {
				$height = 'data-height="'.$header_height.'"';
			}
		?>

		<?php if (has_post_thumbnail()): ?>

			<?php
				$featured_id = get_post_thumbnail_id();
				$featured_image = wp_get_attachment_image_src($featured_id, 'full');
				if (empty($height) && empty($html_title)) {
					$height = 'data-width="'. $featured_image[1] .'" data-height="'. $featured_image[2] .'"';
				}
			?>

			<div class="wrapper-featured-image">
				<div class="parallax-container" <?php echo $height ?>>
					<div class="parallax-item header-image"
						 style="background-image: url(<?php echo $featured_image[0] ?>);">
					</div>
				</div>
				<div class="page-header">
					<?php if ( ! empty($html_title) || get_post_format() != false): ?>
						<?php get_template_part('theme-partials/post-templates/single-head', get_post_format()); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php elseif ( ! empty($html_title) || get_post_format() != false): ?>
			<div class="wrapper-featured-image">
				<div class="featured-image-container"
					 style="background-color: <?php echo get_post_meta(get_the_ID(), wpgrade::prefix().'header_background_color', true); ?>">

					<div class="featured-image-container-wrapper content-bigger s-inverse">
						<div class="page-header-wrapper">
							<?php get_template_part('theme-partials/post-templates/single-head', get_post_format()); ?>
						</div>
					</div>

				</div>
			</div>
		<?php else: # get_post_format == false && empty html_title ?>
			<div class="wrapper-featured-image no-image"></div>
		<?php endif; ?>
	<?php endif; ?>

	<div class="wrapper">
		<div class="container container-content">
			<div class="main main-content" role="main">
				<article id="post-<?php the_ID(); ?>"
						 <?php post_class('clearfix content-wrap'); ?>
						 role="article"
						 itemscope itemtype="http://schema.org/Article">

					<div class="pre-article-box">
						<div class="article-date">
							<span class="article-date-text">Published </span>
							<span class="publication-date"><?php the_date(); ?></span>
						</div>
						<nav class="article-control">
							<ul class="article-control-list">
								<?php previous_post_link('<li class="article-control-item">%link</li>',  __('Previous post', wpgrade::textdomain() ), true); ?>
								<?php next_post_link('<li class="article-control-item">%link</li>',  __('Next post', wpgrade::textdomain() ), true ); ?>
							</ul>
						</nav>
					</div>

					<div class="article-details">
						<h1 class="article-title">
							<?php echo get_the_title(); ?>
						</h1>
					</div>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					</div>

					<div class="article-meta">
						<?php $categories = wp_get_post_categories($post->ID); ?>
						<?php if (count($categories)): ?>
							<div class="meta-list-container meta-container_categories">
								<h3 class="meta-list-title">Categories:</h3>
								<ul class="article-tags article-meta-list">
									<?php foreach ($categories as $cat): ?>
										<li class="article-category-item">
											<a href="<?php echo get_category_link($cat); ?>"
											   class="article-category-item-link">
												<?php echo get_category($cat)->name; ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>

						<?php $tags = wp_get_post_tags($post->ID); ?>
						<?php if (count($tags)): ?>
							<div class="meta-list-container meta-container_tags">
								<h3 class="meta-list-title">Tags:</h3>
								<ul class="article-categories article-meta-list">
									<?php foreach ($tags as $tag):	?>
										<li class="article-tag-item">
											<a href="<?php echo get_tag_link($tag->term_id); ?>"
											   class="article-tag-item-link">
												<?php echo $tag->name; ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
					<?php if (wpgrade::option('blog_single_show_share_links')): ?>
					<div class="meta-list-container meta-container_links">
						<h3 class="meta-list-title">
							<?php _e("Share on:", wpgrade::textdomain()); ?>
						</h3>

						<ul class="article-meta-list">
								<?php if (wpgrade::option('blog_single_share_links_twitter')): ?>
									<li class="article-link">
										<a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;source=tweetbutton&amp;text=<?php echo urlencode(get_the_title())?>&amp;url=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;via=<?php echo wpgrade::option( 'twitter_card_site' ) ?>" onclick="return popitup(this.href, this.title)"
										   title="<?php _e('Share on Twitter!', wpgrade::textdomain()) ?>">
											Twitter
										</a>
									</li>
								<?php endif;
								if (wpgrade::option('blog_single_share_links_facebook')): ?>
									<li class="article-link">
										<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)"
										   title="<?php _e('Share on Facebook!', wpgrade::textdomain()) ?>">
											Facebook
										</a>
									</li>
								<?php endif;
								if (wpgrade::option('blog_single_share_links_googleplus')): ?>
									<li class="article-link">
										<a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)"
										   title="<?php _e('Share on Google+!', wpgrade::textdomain()) ?>">
											Google+
										</a>
									</li>
								<?php endif; ?>
							</ul>


						<div class="article-link to-top">
							<a href="#top" title="<?php _e("Jump to the top of the page", wpgrade::textdomain()); ?>">
								&uarr; <?php _e("Back to top", wpgrade::textdomain()); ?>
							</a>
						</div>
					</div>
					<?php endif; ?>
					<?php comments_template(); ?>

				</article>
			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php endwhile; ?>
