<?php header("Content-type: text/css; charset: UTF-8");

function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	// return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

if ( isset($_GET["color"]) ){
	$main_color = '#'.$_GET["color"];
	$rgb = implode(",", hex2rgb($main_color)); ?>
	.sidebar-footer-container a:hover, .team-member-position,
	.wpgrade_pagination a:hover, #comment-submit, .entry-content a,
	.sidebar-footer_right-container .widget_wpgrade_twitter_widget .widget-tweets-tweet-content a,
	.side-content .widget li a:hover, .author-link, .wpcf7 input[type="submit"],
	.sub-menu li:hover > a, a, a:hover > i.shc, .testimonial-content:before,
	.sidebar-footer-container .widget_wpgrade_twitter_widget .flex-prev:hover, .sidebar-footer-container .widget_wpgrade_twitter_widget .flex-next:hover, .sidebar-footer-container .latest-posts-slider .flex-prev:hover, .sidebar-footer-container .latest-posts-slider .flex-next:hover,
	.post.sticky .entry-title a, .icon-twitter_footer, .widget_categories a:hover, .widget_tag_cloud a:hover, .portfolio-item_cat-link:hover, .previous-project-link a:hover, .next-project-link a:hover, .load_more a:hover, .previous-project-link span, .next-project-link span, .load_more span, .post-footer_meta a:hover, .comment.bypostauthor .comment-author, .pingback.bypostauthor .comment-author, .trackback.bypostauthor .comment-author, .block-dark a, .tab-titles-list li.active a, .tab-titles-list a:hover, i.shc.big:hover,
	.latest-posts-excerpt .btn-more:hover, .widget_wpgrade_contact_widget a,
	.article-control-button:hover
	{ color: <?php echo $main_color; ?>; }

	.navigation-control-menu a, .filter-by-container .list-active,
	.background-color, .btn, .header_search-form.is-active #searchform,
	.main-footer_twitter:before, .main-footer_twitter:after, .homepage-slider .flex-control-paging > li > a.flex-active, .gallery_format_slider .flex-direction-nav a:hover, .block-color, .progressbar-progress, .mejs-container .mejs-controls .mejs-time-rail .mejs-time-current, .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
	.homepage-slider .flex-direction-nav > li > a,
	.site-navigation .header_search-form #searchform .field.is-visible,
	.newsletter_subscribe .submit,
	.homepage-slider .flex-direction-nav a:hover, .wrapper-body .flex-direction-nav a:hover, .portfolio-container .flex-direction-nav a:hover,
	.cl-effect-2 a span, .csstransforms3d .cl-effect-2 a span::before,
	.csstransforms3d .cl-effect-2 a:hover span::before, .csstransforms3d .cl-effect-2 a:focus span::before,
	.sidebar-footer-container .widget_wpgrade_twitter_widget .flex-control-paging > li > a.flex-active, .sidebar-footer-container .latest-posts-slider .flex-control-paging > li > a.flex-active,
	.testimonial-author_name, .testimonials-slider .flex-direction-nav .flex-prev, .testimonials-slider .flex-direction-nav .flex-next,
	.filter-by-container > a span, .direction-nav-container li a:hover,
	.homepage-slider .flex-direction-nav > li > a .slide-thumb,
	.homepage-slider .flex-direction-nav > li > a .slide-arrow-container .slide-arrow-bg,
	.direction-nav-container li a span:hover,
	.lt-ie9 .project-no-image .portfolio-item-info
	{ background-color: <?php echo $main_color; ?>; }

	.border-color
	{ border-color: <?php echo $main_color; ?>; }

	.border-top-color,
	.sub-menu li:first-child
	{ border-top-color: <?php echo $main_color; ?>; }

	.border-right-color
	{ border-right-color: <?php echo $main_color; ?>; }

	.border-bottom-color,
	.homepage-slider
	{ border-bottom-color: <?php echo $main_color; ?>; }

	.border-left-color,
	.previous-project-link a:before, .previous-project-link a:before,
	.type-post .entry-content ul, .type-post .entry-content ul,
	.type-post .entry-content ol, .type-post .entry-content ol,
	.type-post .entry-content blockquote, article .pre-article-box,
	.entry-content blockquote, .type-post .entry-content blockquote,
	.type-post .entry-content q, .type-post .entry-content q
	{ border-left-color: <?php echo $main_color; ?>; }

	@media only screen and (max-width: 1024px) {
		.wrapper-header-small {
			background-color: <?php echo $main_color; ?>;
		}
	}

	@media only screen and (min-width: 1025px) {

		.site-mainmenu li:hover {
			background-color: <?php echo $main_color; ?>;
		}

		.entry-header, .post-footer, .comments-area-title,
		.container-body > h2, .featuredworks-title, .single-title,
		.project-title {
			border-left-color: <?php echo $main_color; ?>;
		}

		.portfolio-item-info, .team-member-profile-table {
			background-color: <?php echo $main_color; ?>;
			background-color: rgba(<?php echo $rgb . ', 0.75'; ?>);
		}

		.shc-infobox.border-right,
		.shc-infobox.border-left-right {
			border-right-color: <?php echo $main_color; ?>;
		}

		.shc-infobox.border-left,
		.shc-infobox.border-left-right {
			border-left-color: <?php echo $main_color; ?>;
		}

		.team-member-container:hover .team-member-name {
			color: <?php echo $main_color; ?>;
		}
	}

<?php
}

if ( isset($_GET["main_font"]) ){
	$main_font = $_GET["main_font"]; ?>

	h1, h2, h3, h4, h5, h6, .portfolio_items article li a .title, input.dial, blockquote, blockquote p, .site-branding a {
		font-family: "<?php echo $main_font; ?>" !important;
	}

<?php }

if ( isset($_GET["menu_font"]) ){
	$menu_font = $_GET["menu_font"]; ?>
	.site-navigation a {
		font-family: "<?php echo $menu_font; ?>" !important;
	}
<?php }

if ( isset($_GET["body_font"]) ){
	$body_font = $_GET["body_font"]; ?>
	body, .testimonial-content {
		font-family: "<?php echo $body_font; ?>" !important;
	}
<?php }

if ( isset($_GET["port_color"]) ){
	$port_color = '#'.$_GET["port_color"]; ?>
	.portfolio_items article li.big a div.title, .portfolio_single_gallery li a { color: <?php echo $port_color ?> }
	.portfolio_items article li.big a div.title hr {border-color: <?php echo $port_color ?>}
	.portfolio_items article li a .border span, .portfolio_single_gallery li a .border span {border: 1px solid <?php echo $port_color ?>}
<?php }

if ( isset($_GET["custom_css"]) ){
	echo $_GET["custom_css"];
}?>