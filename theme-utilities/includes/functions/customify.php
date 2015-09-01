<?php


if ( ! function_exists('add_customify_bucket_options') ) {

	function add_customify_bucket_options( $config ) {

		$config['opt-name'] = 'bucket_options';

		$config['sections'] = array(
			'colors_section' => array(
				'title'    => __( 'Bucket Style', 'bucket_txtd' ),
				'priority' => 1,
				'description'            => __( 'The style options control the general styling of the site, like accent color and Google Web Fonts. You can choose custom fonts for various typography elements with font weight, char set, size and/or height.If you want to override these elements you can always use the CSS Editor panel.', 'bucket_txtd' ),
				'options' => array(
					'main_color'   => array(
						'type'      => 'color',
						'label'     => __( 'Main Color', 'bucket_txtd' ),
						//'desc'   => __( 'Use the color picker to change the main color of the site to match your brand color.', 'bucket_txtd' ),
						'live' => true,
						'default'   => '#fb4834',
						'css'  => array(
							array(
								'property'     => 'color',
								'selector' => 'a, blockquote, .small-link, .tabs__nav a.current,
									.popular-posts__time a.current, .tabs__nav a:hover,
									.popular-posts__time a:hover, .widget--footer__title em,
									.widget_rss .widget--footer__title .hN,
									.widget_rss .widget--footer__title .article__author-name,
									.widget_rss .widget--footer__title .comment__author-name,
									.widget_rss .widget--footer__title .widget_calendar caption,
									.widget_calendar .widget_rss .widget--footer__title caption,
									.widget_rss .widget--footer__title .score__average-wrapper,
									.widget_rss .widget--footer__title .score__label,
									.article--billboard-small .small-link em,
									.article--billboard-small .post-nav-link__label em,
									.article--billboard-small .author__social-link em,
									.small-link, .post-nav-link__label, .author__social-link,
									.article--thumb__title a:hover,
									.widget_wpgrade_twitter_widget .widget--footer__title h3:before,
									a:hover > .pixcode--icon,
									.score__pros__title, .score__cons__title,
									.comments-area-title .hN em,
									.comment__author-name, .woocommerce .amount,
									.panel__title em, .woocommerce .star-rating span:before,
									.woocommerce-page .star-rating span:before',
							),
							array(
								'property'     => 'background-color',
								'selector' => '.heading--main .hN, .widget--sidebar__title,
									.pagination .pagination-item--current span,.pagination .current, .single .pagination span,
									.pagination li a:hover, .pagination li span:hover,
									.rsNavSelected, .badge, .progressbar__progress,
									.btn:hover, .comments_add-comment:hover,
									.form-submit #comment-submit:hover,
									.widget_tag_cloud a:hover, .btn--primary,
									.comments_add-comment, .form-submit #comment-submit,
									a:hover > .pixcode--icon.circle, a:hover > .pixcode--icon.square,
									.article--list__link:hover .badge, .score__average-wrapper,
									.site__stats .stat__value:after, .site__stats .stat__title:after,
									.btn--add-to-cart, .social-icon-link:hover .square, .social-icon-link:focus .square,
									.social-icon-link:active .square,
									.site__stats .stat__value:after, .site__stats .stat__title:after'
							),
							array(
								'property'     => 'border-bottom-color',
								'selector' => '.nav--main li:hover, .nav--main li.current-menu-item',
								'media' => 'only screen and (min-width: 900px)'
							),

							array(
								'property'     => 'border-color',
								'selector' => '.back-to-top a:hover:after, .back-to-top a:hover:before',
								'media' => ' only screen and (min-width: 900px)'
							),

							array(
								'property'     => 'background-color',
								'selector' => '.article--billboard > a:hover .article__title:before,
									.article--billboard > a:hover .article--list__title:before,
									.article--billboard > a:hover .latest-comments__title:before,
									.article--grid__header:hover .article--grid__title h3,
									.article--grid__header:hover .article--grid__title:after',
								'media' => 'only screen and (min-width: 900px) '
							),

							array(
								'property'     => 'border-bottom-color',
								'selector' => '.woocommerce ul.products li.product a:hover img'
							),

							array(
								'property'     => 'border-left-color',
								'selector' => 'ol'
							),
						)
					),

					'this_divider_5349' => array(
						'type' => 'html',
						'html' => '<span class="separator" style="border:1px solid #ccc; display: block; width: 100%; height: 0; margin:25px 0 -20px 0; padding: 0; "></span>'
					),

					'google_titles_font' => array(
						'type'     => 'typography',
						'label'    => __( 'Headings', 'bucket_txtd' ),
						'desc'       => __( 'Font for titles and headings.', 'rosa_txtd' ),
						'recommended' => array(
							'Arvo',
							'PT Sans',
							'Open Sans',
						),
						//'load_all_weights' => true,
						'selector' => '.badge, h1, h2, h3, h4, h5, h6, hgroup,
									.hN, .article__author-name, .comment__author-name,
									.score__average-wrapper, .score__label,
									.widget_calendar caption, blockquote,
									.tabs__nav, .popular-posts__time,
									.heading .hN, .widget--sidebar__title .hN,
									.widget--footer__title .hN, .heading .article__author-name,
									.widget--sidebar__title .article__author-name,
									.widget--footer__title .article__author-name,
									.heading .comment__author-name,
									.widget--sidebar__title .comment__author-name,
									.widget--footer__title .comment__author-name,
									.heading .score__average-wrapper,
									.widget--sidebar__title .score__average-wrapper,
									.widget--footer__title .score__average-wrapper,
									.heading .score__label, .widget--sidebar__title .score__label,
									.widget--footer__title .score__label, .heading .widget_calendar caption,
									.widget_calendar .heading caption,
									.widget--sidebar__title .widget_calendar caption,
									.widget_calendar .widget--sidebar__title caption,
									.widget--footer__title .widget_calendar caption,
									.widget_calendar .widget--footer__title caption,
									.score-box--after-text, .latest-comments__author,
									.review__title, .share-total__value, .pagination li a, .pagination li span,
									.heading span.archive__side-title'
					),

					'google_nav_font'     => array(
						'type'    => 'typography',
						'label'   => __( 'Navigation', 'bucket_txtd' ),
						'desc'       => __( 'Font for the navigation menu.', 'rosa_txtd' ),
						'recommended' => array(
							'PT Sans',
							'Arvo',
							'Open Sans',
						),
						'selector' => 'nav'
					),

					'google_body_font'     => array(
						'type'    => 'typography',
						'label'   => __( 'Body', 'bucket_txtd' ),
						'desc'       => __( 'Font for content and widget text.', 'rosa_txtd' ),
						'recommended' => array(
							'PT Sans',
							'Arvo',
							'Open Sans',
						),
						'selector' => 'html, .wp-caption-text, .small-link,
									.post-nav-link__label, .author__social-link,
									.comment__links, .score__desc',
						'load_all_weights' => true,
					),

					'this_divider_536649' => array(
						'type' => 'html',
						'html' => '<span class="separator" style="border:1px solid #ccc; display: block; width: 100%; height: 0; margin:25px 0 -20px 0; padding: 0; "></span>'
					),

					'layout_boxed' => array(
						'type' => 'checkbox',
						'label' => __('Boxed Layout', 'bucket_txtd'),
						'desc' => __('With Boxed Layout enabled you can use an image as background (go to Appearance - Background).', 'bucket_txtd'),
						'default' => '0'
					)

				)
			),
		);

		$config['panels'] = array(

		);

		return $config;
	}
}
add_filter( 'customify_filter_fields', 'add_customify_bucket_options', 11 );

function bucket_range_negative_value( $value, $selector, $property, $unit ) {

	$output = $selector .'{
		' . $property . ': -' . $value . '' . $unit . ";\n" .
	          "}\n";

	return $output;
}

/**
 * With the new wp 43 version we've made some big changes in customizer, so we really need a first time save
 * for the old options to work in the new customizer
 */
function convert_bucket_for_wp_43_once (){
	if ( ! is_admin() || ! function_exists( 'is_plugin_active' ) || ! is_plugin_active('customify/customify.php') || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		return;
	}

	$is_not_old = get_option('wpgrade_converted_to_43');

	$this_wp_version = get_bloginfo('version');
	$this_wp_version = explode( '.', $this_wp_version );
	$is_wp43 = false;
	if ( ! $is_not_old && (int) $this_wp_version[0] >= 4 && (int) $this_wp_version[1] >= 3 ) {
		$is_wp43 = true;
		update_option('wpgrade_converted_to_43', true);
		header( 'Location: '.admin_url().'customize.php?save_customizer_once=true');
		die();
	}
}

add_action('admin_init', 'convert_bucket_for_wp_43_once');