<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to wpgrade_comment() which is
 * located in the functions.php file.
 *
 * @package wpGrade
 * @since wpGrade 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
} ?>

    <div id="comments" class="comments-area">
        <div class="comments-area-title">
            <h4 class="hN">
                <?php
                    if ( have_comments() ) {
                        echo '<span class="comment-number total">' . esc_html( number_format_i18n( get_comments_number() ) ) . '</span>' . esc_html( _n( ' Comment', ' Comments', get_comments_number(), 'bucket-lite' ) );
                    } else {
	                    esc_html_e('There are no comments', 'bucket-lite');
                    } ?>
            </h4>
            <?php echo '<a class="comments_add-comment" href="#reply-title">' . esc_html__('Add yours', 'bucket-lite') .'</a>'; ?>
        </div>

        <?php // You can start editing here -- including this comment! ?>

        <?php if ( have_comments() ){ ?>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
            <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
                <h4 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'bucket-lite' ); ?></h4>
                <div class="grid  push--bottom">
                    <div class="grid__item  one-half">
                        <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'bucket-lite' ) ); ?></div>
                    </div><!-- 
                    --><div class="grid__item  one-half  text--right">
                        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'bucket-lite' ) ); ?></div>
                    </div>
                </div>
            </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
            <?php } // check for comment navigation ?>

            <ol class="commentlist">
                <?php
                    /* Loop through and list the comments. Tell wp_list_comments()
                     * to use wpgrade_comment() to format the comments.
                     * If you want to overload this in a child theme then you can
                     * define wpgrade_comment() and that will be used instead.
                     * See wpgrade_comment() in inc/template-tags.php for more.
                     */
                    wp_list_comments( array( 'callback' => 'wpgrade_comments','short_ping'  => true ) );
                ?>
            </ol><!-- .commentlist -->

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
            <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
                <h4 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'bucket-lite' ); ?></h4>
                <div class="grid  push--bottom">
                    <div class="grid__item  one-half">
                        <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'bucket-lite' ) ); ?></div>
                    </div><!-- 
                    --><div class="grid__item  one-half  text--right">
                        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'bucket-lite' ) ); ?></div>
                    </div>
                </div>
            </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
            <?php } // check for comment navigation ?>
            
            <hr class="separator separator--subsection" />

        <?php } // have_comments()

            // If comments are closed and there are comments, let's leave a little note, shall we?
            if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && !is_page() ){
        ?>
            <p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'bucket-lite' ); ?></p>
        <?php } ?>

    </div><!-- #comments .comments-area -->
    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $comments_args = array(
            // change the title of send button
            'title_reply'=> esc_html__('Post a new comment', 'bucket-lite'),
            // remove "Text or HTML to be displayed after the set of comment fields"
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<p class="comment-form-author"><label for="author" class="show-on-ie8">' . esc_html__('Name', 'bucket-lite') . '</label><input id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" type="text" placeholder="' . esc_html__('Name', 'bucket-lite') . '..." size="30" ' .  $aria_req . ' /></p>',
                'email' => '<p class="comment-form-email"><label for="email" class="show-on-ie8">' . esc_html__('Email', 'bucket-lite') . '</label><input id="email" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" type="text" placeholder="' . esc_html__('Email', 'bucket-lite') . '..." ' . $aria_req . ' /></p>' ) ),
            'id_submit' => 'comment-submit',
            'label_submit' => esc_html__('Send', 'bucket-lite'),
            // redefine your own textarea (the comment body)
            'comment_field' => '<p class="comment-form-comment"><label for="comment" class="show-on-ie8">' . esc_html__('Comment', 'bucket-lite') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__( 'Message', 'bucket-lite' ) . '"></textarea></p>');
    } else {
        $comments_args = array(
        // change the title of send button
        'title_reply'=> esc_html__('Post a new comment', 'bucket-lite'),
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'fields' => apply_filters( 'comment_form_default_fields',
            array(
                'author' => '<p class="comment-form-author"><label for="author" class="show-on-ie8">' . esc_html__('Name', 'bucket-lite') . '</label><input id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" type="text" placeholder="' . esc_html__('Name', 'bucket-lite') . '..." size="30" ' .  $aria_req . ' /></p><!--',
                'email' => '--><p class="comment-form-email"><label for="name" class="show-on-ie8">' . esc_html__('Email', 'bucket-lite') . '</label><input id="email" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" type="text" placeholder="' . esc_html__('Email', 'bucket-lite') . '..." ' . $aria_req . ' /></p><!--',
                'url' => '--><p class="comment-form-url"><label for="url" class="show-on-ie8">' . esc_html__('Url', 'bucket-lite') . '</label><input id="url" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_html__('Website', 'bucket-lite') .'..." type="text"></p>'
            )
        ),
        'id_submit' => 'comment-submit',
        'label_submit' => esc_html__('Send', 'bucket-lite'),
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment" class="show-on-ie8">' . esc_html__('Comment', 'bucket-lite') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__( 'Message', 'bucket-lite' ) . '"></textarea></p>');
    }
	
	//if we have no comments then we don't need a second title, one is enough
	if ( !have_comments() ){
		$comments_args['title_reply'] = '';
	}
	
    comment_form( $comments_args );
