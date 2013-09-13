<?php
	$quote = get_post_meta($post->ID, wpgrade::prefix().'quote', true);
	$quote_author = get_post_meta($post->ID, wpgrade::prefix().'quote_author', true);
	$quote_author_link = get_post_meta($post->ID, wpgrade::prefix().'quote_author_link', true);
?>

<div class="featured-image-wrapper">
    <div class="featured-image-container">
        <div class="entry-content header-quote-content">
            <blockquote>
				<?php echo $quote; ?>
				<?php if ( ! empty($quote_author)): ?>
					<div class="testimonial_author">
						<?php if ( ! empty($quote_author_link)): ?>
							<a href="<?php echo $quote_author_link ?>"
							   title="<?php echo strtr(__('See more about :author', wpgrade::textdomain()), array(':author' => $quote_author)) ?>">
								<span class="author_name">
									<?php echo $quote_author ?>
								</span>
							</a>
						<?php else: # no author link ?>
							<span class="author_name">
								<?php echo $quote_author ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>				
<!--                 <div class="testimonial_author">
                    <a href="http://en.wikipedia.org/wiki/Thomas_Edison" title="See more about Thomas not Edison">
                        <span class="author_name">Thomas not Edison</span>
                    </a>
                    <span class="author_description">Theoretician</span>
                </div> -->
            </blockquote>
        </div>
    </div>
</div>