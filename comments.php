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
 * @since wpGrade 1.0
 */
?>

<?php
    /*
     * If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if (post_password_required()) return;
?>

    <div id="comments" class="comments-area">
        <div class="comments-area-title">
            <h4 class="hN">
                <?php
                    if (have_comments()):
                        printf( _n('There is <em>1</em> comment', 'There are <em>%1$s</em> comments', get_comments_number(), wpgrade::textdomain()),  number_format_i18n(get_comments_number()));
                    else:
                        _e('There are no comments', wpgrade::textdomain());
                    endif;
                ?>
            </h4>
            <?php echo '<a class="comments_add-comment" href="#reply-title">'. __('Add yours', wpgrade::textdomain()) .'</a>'; ?>
        </div>

        <?php // You can start editing here -- including this comment! ?>

        <?php if ( have_comments() ) : ?>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php _e( 'Comment navigation', wpgrade::textdomain() ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', wpgrade::textdomain() ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', wpgrade::textdomain() ) ); ?></div>
            </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
            <?php endif; // check for comment navigation ?>

            <ol class="commentlist">
                <?php
                    /* Loop through and list the comments. Tell wp_list_comments()
                     * to use wpgrade_comment() to format the comments.
                     * If you want to overload this in a child theme then you can
                     * define wpgrade_comment() and that will be used instead.
                     * See wpgrade_comment() in inc/template-tags.php for more.
                     */
                    wp_list_comments( array( 'callback' => 'wpgrade_comments' ) );
                ?>
            </ol><!-- .commentlist -->

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php _e( 'Comment navigation', wpgrade::textdomain() ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', wpgrade::textdomain() ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', wpgrade::textdomain() ) ); ?></div>
            </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
            <?php endif; // check for comment navigation ?>
            
            <hr class="separator separator--subsection" />

        <?php endif; // have_comments() ?>
        <?php
            // If comments are closed and there are comments, let's leave a little note, shall we?
            if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && !is_page() ) :
        ?>
            <p class="nocomments"><?php _e( 'Comments are closed.', wpgrade::textdomain() ); ?></p>
        <?php endif; ?>

    </div><!-- #comments .comments-area -->
    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $comments_args = array(
            // change the title of send button
            'title_reply'=> __('Post a new comment', wpgrade::textdomain()),
            // remove "Text or HTML to be displayed after the set of comment fields"
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<p class="comment-form-author"><label for="author" class="show-on-ie8">Name</label><input id="author" name="author" type="text" placeholder="Name..." size="30" ' .  $aria_req . ' /></p>',
                'email' => '<p class="comment-form-email"><label for="email" class="show-on-ie8">Email</label><input id="email" name="email" size="30" type="text" placeholder="Email..." '. $aria_req .' /></p>' ) ),
            'id_submit' => 'comment-submit',
            'label_submit' => __('Send', wpgrade::textdomain()),
            // redefine your own textarea (the comment body)
            'comment_field' => '<p class="comment-form-comment"><label for="comment" class="show-on-ie8">Comment</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . _x( 'Message', 'noun', wpgrade::textdomain() ) . '"></textarea></p>');
    } else {
        $comments_args = array(
        // change the title of send button
        'title_reply'=> __('Post a new comment', wpgrade::textdomain()),
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<p class="comment-form-author"><label for="author" class="show-on-ie8">Name</label><input id="author" name="author" type="text" placeholder="Name..." size="30" ' .  $aria_req . ' /></p><!--',
                'email' => '--><p class="comment-form-email"><label for="name" class="show-on-ie8">Email</label><input id="email" name="email" size="30" type="text" placeholder="Email..." '. $aria_req .' /></p><!--',
                'url' => '--><p class="comment-form-url"><label for="url" class="show-on-ie8">Url</label><input id="url" name="url" size="30" placeholder="Website..." type="text"></p>') ),
        'id_submit' => 'comment-submit',
        'label_submit' => __('Send', wpgrade::textdomain()),
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment" class="show-on-ie8">Comment</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . _x( 'Message', 'noun', wpgrade::textdomain() ) . '"></textarea></p>');
    }
    comment_form($comments_args); ?>