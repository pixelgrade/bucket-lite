<?php
/**
 * The template for displaying Author bios.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<aside class="author" itemscope itemtype="http://schema.org/Person">
	<div class="author__avatar">
		<?php echo '<img src="'. util::get_avatar_url(get_the_author_meta('email'), '80') . '" itemprop="image" alt="avatar" />'; ?>
	</div>
	<div class="author__text">
		<div class="author__title">
			<h3 class="accessibility"><?php esc_html_e('Author', 'bucket-lite'); ?></h3>
			<div class="hN">
				<span itemprop="name"><?php bucket::the_author_posts_link(); ?></span>
			</div>
		</div>
		<p class="author__bio" itemprop="description"><?php the_author_meta('description'); ?></p>
		<ul class="author__social-links">
			<?php if ( get_the_author_meta('url') ){ ?>
				<li class="author__social-links__list-item">
					<a class="author__social-link" href="<?php echo get_the_author_meta('url') ?>" target="_blank"><?php esc_html_e('Website', 'bucket-lite'); ?></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta('user_tw') ){ ?>
				<li class="author__social-links__list-item">
					<a class="author__social-link" href="https://twitter.com/<?php echo get_the_author_meta('user_tw') ?>" target="_blank">Twitter</a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta('user_fb') ){ ?>
				<li class="author__social-links__list-item">
					<a class="author__social-link" href="https://www.facebook.com/<?php echo get_the_author_meta('user_fb') ?>" target="_blank">Facebook</a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta('google_profile') ){ ?>
				<li class="author__social-links__list-item">
					<a class="author__social-link" href="<?php echo get_the_author_meta('google_profile') ?>" target="_blank">Google+</a>
				</li>
			<?php } ?>
		</ul>
	</div>
</aside>
 <hr class="separator  separator--subsection">
