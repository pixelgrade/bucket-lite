<?php
/*
 * Register Widgets areas.
 */

function wpgrade_register_sidebars() {

	register_sidebar( array(
			'id'            => 'sidebar',
			'name'          => esc_html__( 'Main Right Sidebar', 'bucket-lite' ),
			'description'   => esc_html__( 'Main Sidebar', 'bucket-lite' ),
			'before_title'  => '<div class="widget__title  widget--sidebar__title"><h2 class="hN">',
			'after_title'   => '</h2></div>',
			'before_widget' => '<div id="%1$s" class="widget  widget--main %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-first-1',
			'name'          => esc_html__( 'Footer | First Row [1]', 'bucket-lite' ),
			'description'   => esc_html__( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket-lite' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-first-2',
			'name'          => esc_html__( 'Footer | First Row [2]', 'bucket-lite' ),
			'description'   => esc_html__( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket-lite' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-first-3',
			'name'          => esc_html__( 'Footer | First Row [3]', 'bucket-lite' ),
			'description'   => esc_html__( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket-lite' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-second-1',
			'name'          => esc_html__( 'Footer | Second Row [1]', 'bucket-lite' ),
			'description'   => esc_html__( 'Widgets in this area will have 2/3rd the width of the footer.', 'bucket-lite' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="widget  widget-area__second  widget--footer %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-second-2',
			'name'          => esc_html__( 'Footer | Second Row [2]', 'bucket-lite' ),
			'description'   => esc_html__( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket-lite' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="widget  widget-area__second  widget--footer %2$s">',
			'after_widget'  => '</div>',
		)
	);

	// Use shortcodes in text widgets.
	add_filter('widget_text', 'do_shortcode');

}
add_action('widgets_init', 'wpgrade_register_sidebars');
