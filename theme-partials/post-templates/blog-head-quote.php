<?php
	$quote = get_post_meta($post->ID, wpgrade::prefix().'quote', true);
	$quote_author = get_post_meta($post->ID, wpgrade::prefix().'quote_author', true);
	$quote_author_link = get_post_meta($post->ID, wpgrade::prefix().'quote_author_link', true);
?>

<div class="content-wrap entry-content">
	<div class="testimonial shc">
		<blockquote>

			<a class="quote-post-link"
			   rel="bookmark"
			   href="<?php echo get_permalink() ?>"
			   title="<?php echo esc_attr(strtr( __('Read more about :title', wpgrade::textdomain()), array(':title' => the_title_attribute('echo=0')) )) ?>">

				<?php echo $quote; ?>

			</a>

			<?php if ( ! empty($quote_author)): ?>
				<div class="testimonial_author">
					<?php if ( ! empty($quote_author_link)): ?>
						<a href="<?php echo $quote_author_link ?>"
						   title="<?php echo strtr( __('See more about :author', wpgrade::textdomain()), array(':author' => $quote_author) ) ?>">

							<span class="author_name">
								<?php echo $quote_author ?>
							</span>

						</a>
					<?php else: # no link ?>
						<span class="author_name">
							<?php echo $quote_author ?>
						</span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

		</blockquote>
	</div>
</div>
