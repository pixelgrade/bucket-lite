<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php if ( comments_open() ) : ?><div id="reviews"><?php

	echo '<div id="comments">';

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$count = $product->get_rating_count();

		if ( $count > 0 ) {

			$average = $product->get_average_rating();

			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

			echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', wpgrade::textdomain() ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', wpgrade::textdomain() ).'</span></div>';
			echo '<div  class="reviews-title">'.sprintf( _n('%s review for %s', '%s reviews for %s', $count,  wpgrade::textdomain()), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</div>';

			echo '</div>';

		} else {

			echo '<h2>'.__( 'Reviews', wpgrade::textdomain() ).'</h2>';

		}

	} else {

		echo '<h2>'.__( 'Reviews', wpgrade::textdomain() ).'</h2>';

	}

	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', wpgrade::textdomain() ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', wpgrade::textdomain() ) ); ?></div>
			</div>
		<?php endif;

		// echo '<p class="add_review"><a href="#review_form" class="inline show_review_form btn  " title="' . __( 'Add Your Review', wpgrade::textdomain() ) . '">' . __( 'Add Review', wpgrade::textdomain() ) . '</a></p>';

		$title_reply = __( 'Add a review', wpgrade::textdomain() );

	else :

		$title_reply = __( 'Be the first to review', wpgrade::textdomain() ).' &ldquo;'.$post->post_title.'&rdquo;';

		echo '<p class="noreviews">'.__( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', wpgrade::textdomain() ).'</p>';

	endif;

	$commenter = wp_get_current_commenter();

	echo '</div><div id="review_form_wrapper1"><div id="review_form">';

	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<div class="grid"><div class="grid__item  one-whole  lap-and-up-one-half">'.
			            '<input id="author" class="push-half--bottom" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="'. __( 'Name', wpgrade::textdomain() ) .'"/></div><!--',
			'email'  => '--><div class="grid__item  one-whole  lap-and-up-one-half">'.
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="'. __( 'Email', wpgrade::textdomain() ) .'"/></div></div>',
		),
		'id_submit' => 'woo-review-submit',
		'label_submit' => __( 'Submit Review', wpgrade::textdomain() ),
		'logged_in_as' => '',
		'comment_field' => ''
	);

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$comment_form['comment_field'] = '<p class="comment-form-rating  soft--left  push--top  push--bottom"><label for="rating">' . __( 'Rating', wpgrade::textdomain() ) .'</label><select name="rating" id="rating">
			<option value="">'.__( 'Rate&hellip;', wpgrade::textdomain() ).'</option>
			<option value="5">'.__( 'Perfect', wpgrade::textdomain() ).'</option>
			<option value="4">'.__( 'Good', wpgrade::textdomain() ).'</option>
			<option value="3">'.__( 'Average', wpgrade::textdomain() ).'</option>
			<option value="2">'.__( 'Not that bad', wpgrade::textdomain() ).'</option>
			<option value="1">'.__( 'Very Poor', wpgrade::textdomain() ).'</option>
		</select></p>';

	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment1" name="comment" cols="45" rows="16" aria-required="true" placeholder="'.  __( 'Your Review', wpgrade::textdomain() ) .'"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);

	comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

	echo '</div></div>';

?><div class="clear"></div></div>
<?php endif; ?>