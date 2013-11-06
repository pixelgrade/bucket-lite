<?php
class wpgrade_contact_widget extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_contact_widget', wpgrade::themename().' '.__('Contact Widget',wpgrade::textdomain()), array('description' => __('Display your contact information', wpgrade::textdomain())) );
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
			echo '<ul class="widget-contact-details nav">';
			foreach ($contactinfo as $info => $value) {
				if($value != ''){
					echo '<li class="widget-contact-detail">';
					switch ($info) {
						case 'email':
							echo '<span class="widget-contact-value widget-contact__email"><a href="mailto:'. $value .'">'. $value .'</a></span>';
							break;
						case 'social':
							echo '<span class="widget-contact-value widget-contact__social"><a href="'.$value['link'].'" target="_blank">'. $value['name'] .'<br/> - <small>' . $value['label'] . '</small></a></span>';
							break;
						default:
							echo '<span class="widget-contact-value">'. $value .'</span>';
							break;
					}
					echo '</li>';
				}
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

add_action('widgets_init', create_function('', 'return register_widget("wpgrade_contact_widget");'));