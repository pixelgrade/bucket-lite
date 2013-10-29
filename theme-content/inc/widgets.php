<?php

/*
 * Register Widgets areas.
 */

function wpgrade_register_sidebars() {

    register_sidebar( array(
        'id'            => 'sidebar',
        'name'          => __( 'Main Right Sidebar', 'bucket_txtd' ),
        'description'   => __( 'Main Sidebar', 'bucket_txtd' ),
        'before_title'  => '<div class="widget__title  widget--sidebar__title"><h2 class="hN">',
        'after_title'   => '</h2></div>',
        'before_widget' => '<div id="%1$s" class="widget  widget--main %2$s">',
        'after_widget'  => '</div>',
        ) 
    );

    register_sidebar( array(
        'id'            => 'sidebar-footer-first-1',
        'name'          => __( 'Footer | First Row [1]', 'bucket_txtd' ),
        'description'   => __( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket_txtd' ),
        'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
        'after_title'   => '</h3></div>',
        'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
        'after_widget'  => '</div>',
        ) 
    );

    register_sidebar( array(
        'id'            => 'sidebar-footer-first-2',
        'name'          => __( 'Footer | First Row [2]', 'bucket_txtd' ),
        'description'   => __( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket_txtd' ),
        'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
        'after_title'   => '</h3></div>',
        'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
        'after_widget'  => '</div>',
        ) 
    );

    register_sidebar( array(
        'id'            => 'sidebar-footer-first-3',
        'name'          => __( 'Footer | First Row [3]', 'bucket_txtd' ),
        'description'   => __( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket_txtd' ),
        'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
        'after_title'   => '</h3></div>',
        'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
        'after_widget'  => '</div>',
        ) 
    );

    register_sidebar( array(
        'id'            => 'sidebar-footer-second-1',
        'name'          => __( 'Footer | Second Row [1]', 'bucket_txtd' ),
        'description'   => __( 'Widgets in this area will have 2/3rd the width of the footer.', 'bucket_txtd' ),
        'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
        'after_title'   => '</h3></div>',
        'before_widget' => '<div id="%1$s" class="widget  widget-area__second  widget--footer %2$s">',
        'after_widget'  => '</div>',
        ) 
    );

    register_sidebar( array(
        'id'            => 'sidebar-footer-second-2',
        'name'          => __( 'Footer | Second Row [2]', 'bucket_txtd' ),
        'description'   => __( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket_txtd' ),
        'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
        'after_title'   => '</h3></div>',
        'before_widget' => '<div id="%1$s" class="widget  widget-area__second  widget--footer %2$s">',
        'after_widget'  => '</div>',
        ) 
    );

}
add_action('widgets_init', 'wpgrade_register_sidebars');

/*
 * Register custom widgets.
 */

/**
 * Class wpgrade_latest_comments
 */

class wpgrade_latest_comments extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget--latest-comments', 'description' => __( 'The latest comments' ) );
		parent::__construct('recent-comments', __('Bucket Latest Comments'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		add_action( 'comment_post', array($this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array($this, 'flush_widget_cache') );
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('widget_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		extract($args, EXTR_SKIP);
		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array)$comments as $comment) {

				ob_start(); ?>
				<article class="latest-comments__list">
					<a class="media__img  latest-comments__avatar" href="<?php echo get_comment_author_url($comment->comment_ID) ?>">
						<img class="img--center" src="<?php echo bucket::get_avatar_url($comment->comment_author_email, '48') ?>" alt="48x48">
					</a>
					<div class="media__body  latest-comments__body">
						<div class="comment__meta">
							<a class="latest-comments__author" href="<?php echo get_comment_author_url() ?>"><?php echo $comment->comment_author; ?></a>
							<span class="comment__date">on <?php echo date( 'd M' ,strtotime($comment->comment_date)); ?></span>
						</div>
						<a class="latest-comments__title" href="<?php echo $comment->guid; ?>"><?php echo $comment->post_title; ?></a>
						<div class="latest-comments__content">
							<p><?php echo $comment->comment_content; ?></p>
						</div>
					</div>
				</article>
				<?php
				$output .= ob_get_clean();
			}
		}
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option('widget_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5; ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<?php
	}
}

/*
 * The social icons widget
 */
class wpgrade_latest_reviews extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_latest_reviews', __( wpgrade::themename() .' Latest Reviews', wpgrade::textdomain() ), array('description' => __( "Display the latest posts with reviews", wpgrade::textdomain() )) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		$social_links = wpgrade::option('social_icons');

		$query_args = array(
			'posts_per_page' => $number,
			'meta_query' => array(
				array(
					'key' => 'enable_review_score',
					'value' => '1',
//					'compare' => 'IN',
				)
			)
		);

		$reviews_query = new WP_Query($query_args);

		echo $before_widget;
		if ($reviews_query->have_posts()): ?>
			<?php if ($title): ?>
				<div class="widget__title  widget--sidebar__title  flush--bottom">
					<h2 class="hN"><?php echo $title; ?></h2>
				</div>
			<?php endif; ?>
			<ol class="reviews">
				<?php while ( $reviews_query->have_posts() ) : $reviews_query->the_post(); ?>
					<li class="review">
						<article>
							<a class="review__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php $average_score = bucket::get_average_score(); ?>
                            <span class="badge  badge--review"><?php echo $average_score ? $average_score : '&nbsp;' ?></span>
							<div class="progressbar"><div class="progressbar__progress" style="width: <?php echo bucket::get_average_score() * 10;  ?>%;"></div></div>
						</article>
					</li>
				<?php endwhile; ?>
			</ol>
		<?php endif;

		// Reset Post Data
		wp_reset_postdata();
		wp_reset_query();
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;
	}

	function form($instance) {
		!empty($instance['title'])  ? $title = esc_attr($instance['title']) : $title = __('Latest Reviews',wpgrade::textdomain());
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', wpgrade::textdomain()); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of reviews to show:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

	<?php }
}

/*
 * The social icons widget
 */
class wpgrade_social_links_widget extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_social_links', __( wpgrade::themename() .' Social Links', wpgrade::textdomain() ), array('description' => __( "Display the social links defined in the theme's options", wpgrade::textdomain() )) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);

		$social_links = wpgrade::option('social_icons');
		$target = '';
		if ( wpgrade::option('social_icons_target_blank') ) {
			$target = 'target="_blank"';
		}
		// Reset Post Data
		wp_reset_postdata();

		echo $before_widget;
		if (count($social_links)): ?>
        <?php if ($title): echo $before_title . $title . $after_title; endif; ?>
            <ul class="site-social-links">
                <?php foreach ($social_links as $domain => $value): if ($value): ?>
                    <li class="site-social-links__social-link">
                        <a href="<?php echo $value ?>"<?php echo $target ?>>
                            <i class="pixcode  pixcode--icon  icon-e-<?php echo $domain; ?>"></i>
                        </a>
                    </li>
                <?php endif; endforeach ?>
            </ul>
        <?php endif;
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form($instance) {
		!empty($instance['title'])  ? $title = esc_attr($instance['title']) : $title = __('We Are Social',wpgrade::textdomain()); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', wpgrade::textdomain()); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
	<?php }
}

class wpgrade_dribbble_widget extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_dribbble_widget', __( wpgrade::themename() .' Dribbble Widget',wpgrade::textdomain()), array('description' => __('Display Dribbble images in your sidebar or footer', wpgrade::textdomain())) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title']);
		$username 	= $instance['username'];

	    require_once('vendor/dribbble/src/Dribbble/Dribbble.php');
	    require_once('vendor/dribbble/src/Dribbble/Exception.php');
	    $dribbble = new Dribbble();

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

		try {
			//limit the number of images
			$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 4;

		    $my_shots = $dribbble->getPlayerShots($username, 0, $count);
			// $my_shots = array_slice( $my_shots, 0, $count );

		    echo '<ul class="wpgrade-dribbble-items">';

		    foreach ($my_shots->shots as $shot) {
		        echo '<li class="wpgrade-dribbble-item"><a class="wpgrade-dribbble-link" href="' . $shot->url . '"><img src="' . $shot->image_teaser_url . '" alt="' . $shot->title . '"></a></li>';
		    }

		    echo '</ul>';
		}
		catch (DribbbleException $e) {
		    echo 'Upss... Something is wrong. Check the widget settings.';
		}

		echo $after_widget;
	}

	/**
	 * Validate and update widget options.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

	function form($instance) {
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Dribbble shots',wpgrade::textdomain());
		$username = isset ($instance['username']) ? esc_attr($instance['username']) : '';
		//default to 8 images
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 4;
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', wpgrade::textdomain()); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Dribbble username', wpgrade::textdomain()); ?>:</label>
			<input id="<?php echo $this->get_field_id('username'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $username; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of images',wpgrade::textdomain()); ?>:</label><br />
			<input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>
		<?php
	}
}

class wpgrade_instagram_widget extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_instagram_widget', __( wpgrade::themename() .' Instagram Widget',wpgrade::textdomain()), array('description' => __('Display Instagram images in your sidebar or footer', wpgrade::textdomain())) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title']);
		$username 	= $instance['username'];

		wp_register_script( 'instagram_photostream', WPGRADE_SCRIPT_URL."instagram_photostream_widget.js", array('jquery'), wpgrade::themeversion(), true );
        wp_enqueue_script( 'instagram_photostream' );

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

		//limit the number of images
		$count = isset( $args['count'] ) ? absint( $args['count'] ) : 8;

		$unique_id =  $username . $count ;
		$unique_id = preg_replace("/[^A-Za-z0-9]/", '', $unique_id);
		$html = '<ul id="' . $unique_id  .'" class="wpgrade-instagram-items"></ul>';
		$html .= '<script type="text/javascript"> jQuery(document).ready(function($){ ';
		$html .= '$("#' . $unique_id .'").instagram_photostream({user: "' . $username . '", limit:' . $count . '});';
		$html .= '});</script>';
		echo $html;

		echo $after_widget;
	}

	/**
	 * Validate and update widget options.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

	function form($instance) {
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Instagram shots',wpgrade::textdomain());
		$username = isset ($instance['username']) ? esc_attr($instance['username']) : '';
		//default to 8 images
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 8;
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', wpgrade::textdomain()); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Instagram username', wpgrade::textdomain()); ?>:</label>
			<input id="<?php echo $this->get_field_id('username'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $username; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of images',wpgrade::textdomain()); ?>:</label><br />
			<input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>
		<?php
	}
}

class wpgrade_contact_widget extends WP_Widget {

    public function __construct()
    {
        parent::__construct( 'wpgrade_contact_widget', __( wpgrade::themename() .' Contact Widget',wpgrade::textdomain()), array('description' => __('Display your contact information', wpgrade::textdomain())) );
    }

    function widget($args, $instance) {
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $social_label = $instance['social_label'];
        $social_name = $instance['social_name'];
        $social_link = $instance['social_link'];

        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title;

        $contactinfo = array();
        $contactinfo['address'] = wpgrade::option('contact_address');
        $contactinfo['phone'] = wpgrade::option('contact_phone');
        $contactinfo['email'] = wpgrade::option('contact_email');
        $contactinfo['social'] = array(
            'label' => $social_label,
            'name' => $social_name,
            'link' => $social_link,
        );

        if (count($contactinfo) > 0) {
            echo '<ul class="widget-contact-details">';
            foreach ($contactinfo as $info => $value) {
                echo '<li class="widget-contact-detail">';
                    switch ($info) {
                        case 'email':
                            echo '<span class="widget-contact-value"><a href="mailto:'. $value .'">'. $value .'</a></span>';
                            break;
                        case 'social':
                            echo '<span class="widget-contact-value"><a href="'.$value['link'].'" target="_blank">'. $value['name'] .'</a></span>';
                            break;
                        default:
                            echo '<span class="widget-contact-value">'. $value .'</span>';
                            break;
                    }
                echo '</li>';
            }
            echo '</ul>';
        } else {
            _e('No contact info to be displayed', wpgrade::textdomain());
        }

        echo $after_widget;
    }

    /**
     * Validate and update widget options.
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['social_label'] = strip_tags($new_instance['social_label']);
        $instance['social_name'] = strip_tags($new_instance['social_name']);
        $instance['social_link'] = strip_tags($new_instance['social_link']);
        return $instance;
    }

    function form($instance) {
        $title = isset( $instance['title'] ) ? $instance['title'] : __('Contact us',wpgrade::textdomain());
        $social_label = isset( $instance['social_label'] ) ? $instance['social_label'] : '';
        $social_name = isset( $instance['social_name'] ) ? $instance['social_name'] : '';
        $social_link = isset( $instance['social_link'] ) ? $instance['social_link'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', wpgrade::textdomain()); ?>:</label>
            <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <h4>Display a social link (optional)</h4>
        <p>
            <label for="<?php echo $this->get_field_id('social_label'); ?>"><?php _e('Label', wpgrade::textdomain()); ?>:</label>
            <input id="<?php echo $this->get_field_id('social_label'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('social_label'); ?>" value="<?php echo $social_label; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_name'); ?>"><?php _e('Name', wpgrade::textdomain()); ?>:</label>
            <input id="<?php echo $this->get_field_id('social_name'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('social_name'); ?>" value="<?php echo $social_name; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_link'); ?>"><?php _e('Link', wpgrade::textdomain()); ?>:</label>
            <input id="<?php echo $this->get_field_id('social_link'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('social_link'); ?>" value="<?php echo $social_link; ?>" />
        </p>
    <?php
    }
}

/*
 * Display the tag cloud
 */
function custom_tag_cloud_widget($args)
{
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 19; //largest tag
	$args['smallest'] = 19; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );

/*
 * Display the Latest Posts Slider
 */
class wpgrade_posts_slider_widget extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_posts_slider_widget', __(wpgrade::themename().' Latest Posts Slider',wpgrade::textdomain()), array('description' => __('Display the latest blog posts in your sidebar or footer', wpgrade::textdomain())) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title']);
		// default to 4 posts
		$number 	= isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;

		// The Query
		$options = array( 'posts_per_page' => $number );
		$latest_posts = new WP_Query( $options );

		// Reset Post Data
		wp_reset_postdata();

		echo $before_widget;

		if ($title) echo $before_title . $title . $after_title;

		if ($latest_posts->have_posts()): ?>
			<div class="pixslider  js-pixslider" data-autoheight data-arrows>
				<?php while ($latest_posts->have_posts()): $latest_posts->the_post(); ?>
                    <div class="article  article--slider">
                        <div class="image-wrap">
                        <?php 
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-medium');

						        		$image_ratio = 0.7; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
						        		if (isset($image[1]) && isset($image[2])) {
						        			$image_ratio = $image[2] * 100/$image[1];
						        		}
						            ?>
						            
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo $image[0] ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="article__title  article--slider__title">
                            <h3 class="hN"><?php the_title(); ?></h3>
                        </div>
                        <div class="article__meta  article--slider__meta">
                            <div class="split">
                                <div class="split__title  article__category">
                                    <?php
                                        $categories = get_the_category();
                                        if ($categories) {
                                            $category = $categories[0];
                                            echo '<a class="small-link" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s"), $category->name)) .'">'. $category->cat_name.'</a>';
                                        }
                                    ?>
                                </div>
                                <ul class="nav  article__meta-links">
                                    <li><i class="icon-time"></i> <?php the_time('j M') ?></li>
                                    <li><i class="icon-comment"></i>  <?php comments_number('0', '1', '%'); ?></li>
                                    <li><i class="icon-heart"></i> 12</li>
                                </ul>
                            </div>
                        </div>
                    </div>
				<?php endwhile; ?>
			</div>
		<?php endif;
		echo $after_widget;

		wp_reset_query();
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint($new_instance['number']);
		return $instance;
	}

	function form($instance) {
		!empty($instance['title'])  ? $title = esc_attr($instance['title']) : $title = __('Latest Posts',wpgrade::textdomain());
		// default to 4 posts
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4; ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php __('Title:', wpgrade::textdomain()); ?>
			</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">
				<?php __('Number of posts:', wpgrade::textdomain()); ?>
			</label>
			<input id="<?php echo $this->get_field_id('number'); ?>" class="widefat" type="number" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" />
		</p>
		<?php
	}
}

/*
 * Display a Flickr photo stream
 */
class wpgrade_flickr_widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct( 'wpgrade_flickr_widget', __( wpgrade::themename() .' Flickr Widget',wpgrade::textdomain()), array('description' => __('Display Flickr images in your sidebar or footer (maximum 20 but we recommend less).',wpgrade::textdomain()),) );
	}

	/**
	 * The widget contents
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
		{
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$photos = $this->get_photos( array(
			'username' => $instance['username'],
			'count' => $instance['count'],
			'tags' => $instance['tags'],
		) );

		if ( is_wp_error( $photos ) )
		{
			echo $photos->get_error_message();
		}
		else
		{
			echo '<ul class="wpgrade-flickr-items">';
			foreach ( $photos as $photo )
			{
				$link = esc_url( $photo->link );
				$src = esc_url($this->resize($photo->media->m));
				$title = esc_attr( $photo->title );
				$item = sprintf( '<a class="wpgrade-flickr-link" href="%s"><img src="%s" alt="%s" /></a>', $link, $src, $title );
				$item = sprintf( '<li class="wpgrade-flickr-item">%s</li>', $item );
				echo $item;
			}
			echo '</ul>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Returns an array of photos
	 */
	private function get_photos( $args = array() )
	{
		// do some caching to prevent Flickr from banning us
		$transient_key = md5( 'wpgrade-flickr-cache-' . print_r( $args, true ) );
		$cached = get_transient( $transient_key );

		//if there is a cached version use that one
		if ( $cached )
		{
			return $cached;
		}

		$username = isset( $args['username'] ) ? $args['username'] : '';
		$tags = isset( $args['tags'] ) ? $args['tags'] : '';
		$count = isset( $args['count'] ) ? absint( $args['count'] ) : 8;
		$query = array('tagmode' => 'any','tags' => $tags);

		// If username is actually an RSS feed
		if ( preg_match( '#^https?://api\.flickr\.com/services/feeds/photos_public\.gne#', $username ) )
		{
			$url = parse_url( $username );
			$url_query = array();
			// wp_parse_str( $url['query'], $url_query );
			$query = array_merge( $query, $url_query );
		}
		else
		{
			$user = $this->request( 'flickr.people.findByUsername', array( 'username' => $username ) );
			if ( is_wp_error( $user ) )
			{
				return $user;
			}

			$user_id = $user->user->id;
			$query['id'] = $user_id;
		}

		$photos = $this->request_feed( 'photos_public', $query );

		if ( ! $photos )
		{
			return new WP_Error( 'error', 'Something went wrong.' );
		}

		$photos = array_slice( $photos, 0, $count );
		//cache the photos for an hour
		set_transient( $transient_key, $photos, apply_filters( 'wpgrade_flickr_widget_cache_timeout', 3600 ) );
		return $photos;
	}

	/**
	 * Make a request to the Flickr API.
	 */
	private function request( $method, $args )
	{
		$args['method'] = $method;
		$args['format'] = 'json';
		// the api key we've aquired from Flickr
		$args['api_key'] = 'cf07a23ac8100c1b53c0fb164941bf62';
		$args['nojsoncallback'] = 1;
		$url = esc_url_raw( add_query_arg( $args, 'http://api.flickr.com/services/rest/' ) );

		$response = wp_remote_get( $url );
		if ( is_wp_error( $response ) )
		{
			return false;
		}

		$body = wp_remote_retrieve_body( $response );
 		$obj = json_decode( $body );

		if ( $obj && $obj->stat == 'fail' )
		{
			return new WP_Error( 'error', $obj->message );
		}

		return $obj ? $obj : false;
	}

	/**
	 * Fetch items from the Flickr Feed API.
	 */
	private function request_feed( $feed = 'photos_public', $args = array() )
	{
		$args['format'] = 'json';
		$args['nojsoncallback'] = 1;
		$url = sprintf( 'http://api.flickr.com/services/feeds/%s.gne', $feed );
		$url = esc_url_raw( add_query_arg( $args, $url ) );

		$response = wp_remote_get( $url );
		if ( is_wp_error( $response ) )
		{
			return false;
		}

		$body = wp_remote_retrieve_body( $response );
		$body = preg_replace( "#\\\\'#", "\\\\\\'", $body );
 		$obj = json_decode( $body );

		return $obj ? $obj->items : false;

	}

	/**
	 * Modify the url to get a new size of the image
	 */
	private function resize($url, $size = 'square')
	{
		$url_array = explode('/', $url);
		//strip the filename
		$photo = array_pop($url_array);

		switch($size)
		{
		  case 'square': $suffix = '_s.';  break;
		  case 'thumbnail': $suffix = '_t.';  break;
		  case 'small': $suffix = '_m.';  break;
		  case 'm640': $suffix = '_z.';  break;
		  case 'm800': $suffix = '_c.';  break;
		  case 's320': $suffix = '_n.';  break;
		  case 's150': $suffix = '_q.';  break;
		  case 'large': $suffix = '_b.';  break;
		  default:  $suffix = '.';  break; // Medium
		}

		// replace the old size marker with the needed one
		$url_array[] =  preg_replace('/(_(s|t|c|n|q|m|b|z))?\./i', $suffix, $photo);
		return implode('/', $url_array);
	}

	/**
	 * Validate and update widget options.
	 */
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['tags'] = strip_tags( $new_instance['tags'] );
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

	/**
	 * Render widget controls.
	 */
	public function form( $instance )
	{
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Flickr Shots',wpgrade::textdomain());
		$username = isset( $instance['username'] ) ? $instance['username'] : '';
		$tags = isset( $instance['tags'] ) ? $instance['tags'] : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 8;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title',wpgrade::textdomain()); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username or RSS url',wpgrade::textdomain()); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e( 'Tags' ,wpgrade::textdomain()); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" type="text" value="<?php echo esc_attr( $tags ); ?>" /><br />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of images',wpgrade::textdomain()); ?>:</label><br />
			<input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>

		<?php
	}
}

class wpgrade_twitter_widget extends WP_Widget {

    public function __construct()
    {

        parent::__construct( 'wpgrade_twitter_widget', __( wpgrade::themename() . ' Twitter Widget',wpgrade::textdomain()), array('description' => __('Display Latest Tweets', wpgrade::textdomain())) );
    }

    function widget($args, $instance) {

        extract( $args );

        $username 	= $instance['username'];

        echo $before_widget;
        if ( isset($instance['title']) && $instance['title'] != '') echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;

        $count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 5;
	    $nr_per_slide = isset( $instance['nr_per_slide'] ) ? absint( $instance['nr_per_slide'] ) : 1;

        include_once('vendor/twitter-api/StormTwitter.class.php');

        $config['key'] = wpgrade::option('twitter_consumer_key');
        $config['secret'] = wpgrade::option('twitter_consumer_secret');
        $config['token'] = wpgrade::option('twitter_oauth_access_token');
        $config['token_secret'] = wpgrade::option('twitter_oauth_access_token_secret');
        $config['screenname'] = $instance['username'];
        if ( isset($config['cache_expire']) && $config['cache_expire'] < 1) $config['cache_expire'] = 3600;
        $config['directory'] = plugin_dir_path(__FILE__) . 'vendor/twitter-api/cache';

        $twitter = new StormTwitter($config);
        $results = $twitter->getTweets($count, $username);

        $link = 'https://twitter.com/'. $username;
		$slide_count = 1;
	    $tweets_nr = count($results);
        if ( $results ){
            echo '<div class="wp-slider widget-content"><ul class="widget-tweets__list pixslider js-pixslider" data-bullets data-slidesspacing="24" data-autoheight><li class="widget-tweets__tweet">';
            foreach ($results as $key => $result) { ?>
			<div class="tweet__block">
                <div class="tweet__content"><?php echo $this->get_parsed_tweet($result); ?></div>
                    <?php
                    echo
                    	'<div class="tweet__meta">' .
                        //'<span class="twitter-screenname">' . ucwords($config['screenname']) . '</span>' .
                        '<span class="tweet__meta-username"><a href="'.$link.'">@' . $config['screenname'] . '</a></span>';
	                if ( isset( $result["created_at"] ) ) {
	                    echo '<span class="tweet__meta-date">' . wpgrade_convert_twitter_date($result["created_at"]) . '</span></div></div>';
	                }

	                if ( $slide_count == $tweets_nr ){
		                echo '</li>';
	                } elseif ( $slide_count % $nr_per_slide == 0 ) {
		                echo '</li><li class="widget-tweets__tweet">';
                    }
	            $slide_count++;
            }
            echo '</ul></div>';
        }
        echo $after_widget;
    }

    /**
     * Validate and update widget options.
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['username'] = strip_tags($new_instance['username']);
        $instance['count'] = absint( $new_instance['count'] );
	    $instance['nr_per_slide'] = absint( $new_instance['nr_per_slide'] );
        return $instance;
    }

    function form($instance) {
        $title = isset( $instance['title'] ) ? $instance['title'] : __('Tweets',wpgrade::textdomain());
        $username = isset ($instance['username']) ? esc_attr($instance['username']) : '';
        $count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 5;
	    $nr_per_slide = isset( $instance['nr_per_slide'] ) ? absint( $instance['nr_per_slide'] ) : 1;?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', wpgrade::textdomain()); ?>:</label>
            <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter username', wpgrade::textdomain()); ?>:</label>
            <input id="<?php echo $this->get_field_id('username'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $username; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of tweets',wpgrade::textdomain()); ?>:</label><br />
            <input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
        </p>
	    <p>
		    <label for="<?php echo $this->get_field_id( 'nr_per_slide' ); ?>"><?php _e( 'Number of tweets per slide',wpgrade::textdomain()); ?>:</label><br />
		    <input type="number" min="1" max="20" value="<?php echo esc_attr( $nr_per_slide ); ?>" id="<?php echo $this->get_field_id( 'nr_per_slide' ); ?>" name="<?php echo $this->get_field_name( 'nr_per_slide' ); ?>" />
	    </p>
    <?php
    }

	function get_parsed_tweet ($tweet) {
		// check if any entites exist and if so, replace then with hyperlinked versions

		if ( !isset($tweet['text']) ) return;

		$tweet_text = $tweet['text'];
		if (!empty($tweet['entities']['urls']) || !empty($tweet['entities']['hashtags']) || !empty($tweet['entities']['user_mentions'])) {
			foreach ($tweet['entities']['urls'] as $url) {
					$find = $url['url'];
					$replace = '<a href="'.$find.'" target="_blank" rel="nofollow">'.$find.'</a>';
					$tweet_text = str_replace($find,$replace,$tweet_text);
			}

			foreach ($tweet['entities']['hashtags'] as $hashtag) {
					$find = '#'.$hashtag['text'];
					$replace = '<a href="http://twitter.com/#!/search/%23'.$hashtag['text'].'" target="_blank" rel="nofollow">'.$find.'</a>';
					$tweet_text = str_replace($find,$replace,$tweet_text);
			}

			foreach ($tweet['entities']['user_mentions'] as $user_mention) {
					$find = "@".$user_mention['screen_name'];
					$replace = '<a href="http://twitter.com/'.$user_mention['screen_name'].'" target="_blank" rel="nofollow">'.$find.'</a>';
					$tweet_text = str_ireplace($find,$replace,$tweet_text);
			}
		} else {
			//lets try some other way to properly autolink and shit the tweet text
			include_once('vendor/twitter-api/Autolink.php');
			$autolinker = new Twitter_Autolink($tweet_text);

			$tweet_text = $autolinker->addLinks();
		}

		return $tweet_text;
	}
}

class wpgrade_popular_posts extends WP_Widget {

	protected $defaults;
	protected $popular_days = 0;
	private static $_days = 0;
	private static $_stats_enabled = false;
	private static $current_instance = null;
	const _tablename = 'popularpostsdata';

	function __construct(){

		/**
		 * Check if Jetpack is connected to WordPress.com and Stats module is enabled
		 */
		// Currently, this widget depends on the Stats Module
		if (
			( !defined( 'IS_WPCOM' ) || !IS_WPCOM )
			&&
			!function_exists( 'stats_get_csv' )
		) {
			self::$_stats_enabled = false;
		} else {
			self::$_stats_enabled = true;
		}

		/* Set up some default widget settings. */
		$this->defaults = array(
			'number' => 5,
			'thumb_size' => 45,
			'order' =>'pop',
			'days' => '60',
			'show_views' => '',
			'show_date' => '',
			'pop' => 'on',
			'popular_range' => 'all',
		);

		/* Widget settings. */
		$widget_ops = array(
			'classname' => 'wpgrade_popular_posts',
			'description' => __( 'This widget is the Tabs that classically goes into the sidebar. It contains the Popular posts, Latest Posts and Recent comments.', wpgrade::textdomain() )
		);

		/* Widget control settings. */
		$control_ops = array(
			'width' => 240,
			'height' => 300,
			'id_base' => 'wpgrade_popular_posts'
		);

		/* Create the widget. */
		parent::__construct( 'wpgrade_popular_posts', __( wpgrade::themename() . ' Popular Posts', wpgrade::textdomain() ), $widget_ops, $control_ops );

	}

	function update ( $new_instance, $old_instance ) {

		$defaults = $this->defaults;
		$instance = $old_instance;
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['number'] = intval( $new_instance['number'] );

		return $instance;

	} // End update()

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = isset( $instance['title'] ) ?esc_attr($instance['title']) : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', wpgradE::textdomain()); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts:', wpgrade::textdomain() ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo isset( $instance['number'] ) ? $instance['number'] : ''; ?>" />
			</label>
		</p>

		<?php if( !self::$_stats_enabled ) : ?>
			<div class="pptwj-require-error" style="background: #FFEBE8; border: 1px solid #c00; color: #333; margin: 1em 0; padding: 3px 5px; "><?php _e('Popular Posts tab requires the <a href="http://wordpress.org/extend/plugins/jetpack/" target="_blank">Jetpack plugin</a> to be activated and connected. It also requires the Jetpack Stats module to be enabled.', 'pptwj' ); ?></div>
		<?php endif; ?>

	<?php
	} // End form()

	function widget($args, $instance) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );
		self::$current_instance = $instance;

		extract( $args );

		$number = isset( $instance['number'] ) ? $instance['number'] : 5;

		$filter_links = array(
			'daily' => __('Today', wpgrade::textdomain()),
			'weekly' => __('Week', wpgrade::textdomain()),
			'monthly' => __('Month', wpgrade::textdomain()),
			'all' => __('All', wpgrade::textdomain())
		);
		$thumb_size = 72;
		$data = array(
			'time' => '',
			'tab' => '',
			'numberposts' => $number,
			'thumb' => $thumb_size
		);

		$title = $instance['title'];
		echo $before_widget;

		/* If a title was input by the user, display it. */
		if ( !empty( $title ) ){
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		} ?>

		<ul class="tabs__nav  popular-posts__time">
			<?php
                $index = 0;
                foreach( $filter_links as $key => $val ): ?>
				<li><a class="<?php echo $index++ == 0 ? 'current' : '' ?>" href="#<?php echo $key; ?>" data-time="<?php echo $key; ?>" data-numberposts="<?php echo $number; ?>" data-thumb="<?php echo $thumb_size; ?>" data-tab="popular"><?php echo $val; ?></a></li>
			<?php endforeach; ?>
		</ul>

        <div class="tabs__content">
    		<?php
            $index = 0;
    		foreach( $filter_links as $key => $val ) {
                if ($index++ == 0) {
                    $hidden = '';
                } else {
                    $hidden = 'hide';
                }
    			echo '<div class="tabs__pane '. $hidden .'" id="'. $key .'">';
    			echo self::showMostViewed( $number, $thumb_size, $key );
    			echo '</div>';
    		} ?>
        </div>

		<?php echo $after_widget;

	}

	/**
	 * Display most viewed
	 */
	static function showMostViewed( $posts = 5, $size = 45, $days = 'all' ) {
		global $post;

		$args = array(
			'limit' => $posts,
			'range' => $days
		);

		$popular = self::get_posts_by_wp_com( $args );

		ob_start();

		if( !$popular ):
			$message = !self::$_stats_enabled ? __('<a href="http://wordpress.org/extend/plugins/jetpack/" target="_blank">Jetpack plugin</a> with Stats module needs to be enabled.', 'pptwj') : __('Sorry. No data yet.', 'pptwj');
			?>
			<li><?php echo $message; ?></li>
			<?php
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		endif;

		$count = $i = 1;
		foreach($popular as $key => $p) :

			if ($size <> 0){
				$imageArgs = array(
					'width' => $size,
					'height' => $size,
					'image_class' => 'thumbnail',
					'format' => 'array',
					'default_image' => 'http://placehold.it/72x54'
				);

				$postImage = wpgrade_get_the_image($imageArgs, $p['id']);
			} ?>
			<article class="article  article--list  media">
				<a href="<?php echo $p['permalink']; ?>" title="<?php echo $p['title']; ?>" class="article--list__link">
					<?php if ( !empty( $postImage['src'] ) ){ ?>
						<div class="media__img  push-half--right">
							<img src="<?php echo $postImage['src']; ?>" alt="<?php echo $postImage['alt']; ?>" width="<?php echo $postImage['width']; ?>" height="<?php echo $postImage['height']; ?>" />
						</div>
					<?php } ?>
					<div class="media__body">
						<div class="article__title  article--list__title">
							<h5 class="hN"><?php echo $p['title']; ?></h5>
						</div>
					</div>
					<div class="badge  badge--article  badge--article--list"><?php echo $i; ?></div>
				</a>
			</article>
		<?php $i++; endforeach;

		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}


	/**
	 * Uses data gathered by Jetpack stats and stored in WordPress.com servers
	 */
	static function get_posts_by_wp_com( $args ){

		if( !self::$_stats_enabled || !function_exists('stats_get_csv'))
			return array();

		$defaults = array(
			'limit' => 5,
			'range' => 'all', //daily|weekly|monthly|all
			'post_type' => 'post',
			'date_format' => get_option('date_format')
		);
		$args = wp_parse_args( (array) $args, $defaults );

		$limit = intval( $args['limit'] );

		/** TODO: limit $limit to 100? **/

		$days = 2;
		switch( $args['range'] ){
			case 'weekly':  $days = 7; break;
			case 'monthly': $days = 30; break;
			case 'daily' :  $days = 2; break; //make this 2 days to account for timezone differences
			case 'all':
			default:        $days = -1; break; //get all
		}

		/** we only limit to 50 posts. but change this if you want **/
		$top_posts = stats_get_csv( 'postviews', array( 'days' => $days, 'limit' => 50 ) );

		if( !$top_posts ){
			return array();
		}

		/** Store post_id into array **/
		$post_view_ids = array_filter( wp_list_pluck( $top_posts, 'post_id' ) );
		if ( !$post_view_ids ) {
			return array();
		}

		// cache
		get_posts( array( 'include' => join( ',', array_unique( $post_view_ids ) ) ) );

		// return posts list
		$posts = array();
		$counter = 0;
		foreach( $top_posts as $top_post ){

			//should only trigger for homepage
			if(empty($top_post['post_id']))
				continue;

			$post = get_post( $top_post['post_id'] );

			if ( !$post )
				continue;

			if( $args['post_type'] != $post->post_type )
				continue;

			$permalink = get_permalink( $post->ID );
			$postdate = date_i18n( $args['date_format'], strtotime( $post->post_date ) );
			$views = number_format_i18n( $top_post['views'] );

			if ( empty( $post->post_title ) ) {
				$title_source = $post->post_content;
				$title = wp_html_excerpt( $title_source, 50 );
				$title .= '&hellip;';
			} else {
				$title = $post->post_title;
			}

			$data = array(
				'title' => $title,
				'permalink' => $permalink,
				'views' => $views,
				'id' => $post->ID,
				'postdate' => $postdate
			);

			$posts[] = $data;
			$counter++;

			if( $counter == $limit )
				break;

		}

		return $posts;

	}

} // End Class


function wpgrade_convert_twitter_date( $time ) {
    $date = strtotime( $time );
	//return util::human_time_diff($date);
	return gbs_relative_time($date);
}

/**
 * Format timestamp into relative date, with proper i18n
 */
function gbs_relative_time( $timestamp ){

	$difference = current_time( 'timestamp' ) - $timestamp;

	if ( $difference >= 60*60*24*365 ){        // if more than a year ago
		$int = intval( $difference / ( 60*60*24*365 ) );
		$r = sprintf( _n( '%d year ago', '%d years ago', $int, wpgrade::textdomain() ), $int );
	} elseif ( $difference >= 60*60*24*7*5 ){  // if more than five weeks ago
		$int = intval( $difference / ( 60*60*24*30 ) );
		$r = sprintf( _n( '%d month ago', '%d months ago', $int, wpgrade::textdomain() ), $int );
	} elseif ( $difference >= 60*60*24*7 ){        // if more than a week ago
		$int = intval( $difference / ( 60*60*24*7 ) );
		$r = sprintf( _n( '%d week ago', '%d weeks ago', $int, wpgrade::textdomain() ), $int );
	} elseif ( $difference >= 60*60*24){      // if more than a day ago
		$int = intval( $difference / ( 60*60*24 ) );
		$r = sprintf( _n( '%d day ago', '%d days ago', $int, wpgrade::textdomain() ), $int );
	} elseif ( $difference >= 60*60 ){         // if more than an hour ago
		$int = intval( $difference / ( 60*60 ) );
		$r = sprintf( _n( '%d hour ago', '%d hours ago', $int, wpgrade::textdomain() ), $int );
	} elseif ( $difference >= 60 ){            // if more than a minute ago
		$int = intval( $difference / ( 60 ) );
		$r = sprintf( _n( '%d minute ago', '%d minutes ago', $int, wpgrade::textdomain() ), $int );
	} else {                                // if less than a minute ago
		$r = __( 'moments ago', wpgrade::textdomain() );
	}

	return $r;
}

// Register the widgets

add_action('widgets_init', create_function('', 'return register_widget("wpgrade_social_links_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_contact_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_dribbble_widget");'));
//add_action('widgets_init', create_function('', 'return register_widget("wpgrade_instagram_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_contact_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_posts_slider_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_flickr_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_twitter_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_latest_comments");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_latest_reviews");'));
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_popular_posts");'));


