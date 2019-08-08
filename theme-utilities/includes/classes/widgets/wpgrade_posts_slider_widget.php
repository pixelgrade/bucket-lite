<?php
/*
 * Display the Latest Posts Slider
 */
class wpgrade_posts_slider_widget extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_posts_slider_widget', wpgrade::themename() . ' '. esc_html__('Latest Posts Slider','bucket-lite'), array('description' => esc_html__('Display the latest blog posts in your sidebar or footer', 'bucket-lite')) );
	}

	function widget( $args, $instance) {
		extract( $args );
		$title 		= isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : '';
		// default to 4 posts
		$number 	= isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;

		// The Query
		$options = array( 'posts_per_page' => $number );
		$latest_posts = new WP_Query( $options );

		echo $before_widget;

		if ( $title) echo $before_title . $title . $after_title;

		if ( $latest_posts->have_posts() ){ ?>
			<div class="pixslider  js-pixslider" data-autoheight data-arrows>
				<?php while ($latest_posts->have_posts()){
				    $latest_posts->the_post(); ?>
					<div class="article  article--slider">
						<div class="image-wrap">
							<?php
							if( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-medium');

								$image_ratio = bucket::get_image_aspect_ratio( $image );
								?>
								<img src="<?php echo $image[0] ?>" alt="<?php echo esc_attr( the_title() ); ?>" />
							<?php } else { ?>
								<div class="post-format-icon  post-format-icon__icon">
									<i class="icon-camera"></i>
								</div>
							<?php } ?>
						</div>
						<div class="article__title  article--slider__title">
							<h3 class="hN"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h3>
						</div>
						<div class="article__meta  article--slider__meta">
							<div class="split">
								<div class="split__title  article__category">
									<?php
									$categories = get_the_category();
									if ($categories) {
										$category = $categories[0];
										/* translators: %s: Category name. */
										echo '<a class="small-link" href="'. get_category_link($category->term_id) . '" title="' .  sprintf( esc_attr__("View all posts in %s", 'bucket-lite'), $category->name) .'">'. $category->cat_name.'</a>';
									}
									?>
								</div>
								<ul class="nav  article__meta-links">
									<li class="xpost_date"><i class="icon-time"></i> <?php the_time('j M') ?></li>
									<?php if ( comments_open() ){ ?>
									<li class="xpost_comments"><i class="icon-comment"></i>  <?php comments_number('0', '1', '%'); ?></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php }
		echo $after_widget;

		// Reset Post Data
		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;
	}

	function form( $instance ) {
		!empty($instance['title'])  ? $title = esc_attr($instance['title']) : $title = esc_html__('Latest Posts','bucket-lite');
		// default to 4 posts
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4; ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php esc_html_e('Title:', 'bucket-lite'); ?>
			</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">
				<?php esc_html_e('Number of posts:', 'bucket-lite'); ?>
			</label>
			<input id="<?php echo $this->get_field_id('number'); ?>" class="widefat" type="number" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" />
		</p>
	<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("wpgrade_posts_slider_widget");'));
