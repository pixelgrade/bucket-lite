<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment-article  media">
		<aside class="comment__avatar  media__img">
			<?php echo get_avatar( $GLOBALS['comment'], $size='60' ); ?>
		</aside>

		<div class="media__body">

			<?php if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>

				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) ?>">
					<span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
				</div>

			<?php endif; ?>
			
			<header class="comment__meta comment-author">
				<?php printf('<cite class="comment__author-name">%s</cite>', comment_author() ); ?>
				<time class="comment__time" datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date(__( get_option('date_format'), 'woocommerce' )); ?></time>
			</header>
			<?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
				<div class="alert info">
					<p><?php _e('Your comment is awaiting moderation.', wpgrade::textdomain()) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment__content comment">
				<?php comment_text() ?>
			</section>


		</div>
		<div class="clear"></div>
	</article>
