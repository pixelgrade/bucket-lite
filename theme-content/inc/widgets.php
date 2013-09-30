<?php

/*
 * Register Widgets areas.
 */

function wpgrade_register_sidebars() {

    register_sidebar( array(
        'id'            => 'sidebar-blog',
        'name'          => __( 'Blog Sidebar', 'lens_txtd' ),
        'description'   => __( 'Blog Sidebar', 'lens_txtd' ),
        'before_title'  => '<h4 class="widget__title widget--sidebar-blog__title">',
        'after_title'   => '</h4>',
        'before_widget' => '<div id="%1$s" class="widget widget--sidebar-blog %2$s">',
        'after_widget'  => '</div>',
        ) 
    );

    register_sidebar( array(
        'id'            => 'sidebar-header',
        'name'          => __( 'Header Sidebar', 'lens_txtd' ),
        'description'   => __( 'Header Sidebar', 'lens_txtd' ),
        'before_title'  => '<h4 class="widget__title widget--header__title">',
        'after_title'   => '</h4>',
        'before_widget' => '<div id="%1$s" class="widget widget--header %2$s">',
        'after_widget'  => '</div>',
        ) 
    );

}
add_action('widgets_init', 'wpgrade_register_sidebars');

/*
 * Register custom widgets.
 */

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
        <?php if ($title): ?><h4 class="widget__title"><?php echo $title; ?></h4><?php endif; ?>
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
		if ( $title ) echo $before_title . $title . $after_title;
		if ( $latest_posts->have_posts() ): ?>
			<div class="latest-posts-slider wp-slider">
				<ul class="latest-posts slides">
					<?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
						<li class="latest-posts-post slide row">
              <div class="desk-span6">
                <?php if ( has_post_thumbnail() ) { ?>
                  <a href="<?php the_permalink(); ?>" class="latest-posts-thumnail-wrapper">
                    <?php the_post_thumbnail('homepage-portfolio'); ?>
                  </a>
                <?php } else { ?>
                  <a href="<?php the_permalink(); ?>" class="latest-posts-thumnail-wrapper no-image">
                    <span><?php _e('No Image', wpgrade::textdomain()); ?></span>
                  </a>
                <?php } ?>
              </div>
              <div class="desk-span6">
								<div class="latest-posts-date"><?php the_time('F j, Y'); ?></div>
                <h4 class="latest-posts-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="latest-posts-excerpt">
                  <p>
                    <?php
                      // $excerpt = get_the_excerpt();
                      $excerpt = substr(get_the_excerpt(), 0, 160);
                      echo $excerpt.'&hellip;';
                    ?>
                  </p>
                  <a class="btn btn-small btn-more" href="<?php the_permalink(); ?>">Read More</a>
              </div>
						</li>
					<?php endwhile; ?>
				</ul>
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
		!empty($instance['title'])  ? $title = esc_attr($instance['title']) : $title = __('From the Blog',wpgrade::textdomain());
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