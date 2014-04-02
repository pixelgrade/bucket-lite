<?php

/*
 * The latest reviews widget
 */
class wpgrade_latest_reviews extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_latest_reviews', wpgrade::themename() .' '.__('Latest Reviews', wpgrade::textdomain() ), array('description' => __( "Display the latest posts with reviews", wpgrade::textdomain() )) );
	}

	function widget($args, $instance) {
		global $post;
		
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

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

		$reviews_posts = get_posts($query_args);

		echo $before_widget;
		if (count($reviews_posts)): ?>
			<?php if ($title): ?>
				<div class="widget__title  widget--sidebar__title  flush--bottom">
					<h2 class="hN"><?php echo $title; ?></h2>
				</div>
			<?php endif; ?>
			<ol class="reviews">
				<?php foreach ( $reviews_posts as $post ) : setup_postdata( $post ); ?>
					<li class="review">
						<article>
							<a class="review__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php $average_score = bucket::get_average_score(); ?>
							<span class="badge  badge--review"><?php echo $average_score ? $average_score : '&nbsp;' ?></span>
							<div class="progressbar"><div class="progressbar__progress" style="width: <?php echo ( $average_score ? $average_score : 0 ) * 10;  ?>%;"></div></div>
						</article>
					</li>
				<?php endforeach; ?>
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
		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of reviews to show:',wpgrade::textdomain() ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

	<?php }
}

add_action('widgets_init', create_function('', 'return register_widget("wpgrade_latest_reviews");'));
