<?php
	/* @var string $main_color */
	/* @var array  $fonts */
	/* @var string $port_color */
	/* @var string $rgb */


$main_color = wpgrade::option('main_color');

//if we are in a category page then let's see if we have a custom accent color
if (is_category()) {
	//first get the current category ID
	$cat_id = get_query_var('cat');
	//get the color
	$cat_color = get_category_color($cat_id);
	
	if ($cat_color) {
		$main_color = $cat_color;
	}
} else if (is_single()) { //also for single posts we also take the color of the first category
	//get the categories
	$categories = get_the_category();
	if (!empty($categories)) {
		//get the color
		$cat_color = get_category_color($categories[0]->cat_ID);

		if ($cat_color) {
			$main_color = $cat_color;
		}
	}
}


$rgb = implode(',', wpgrade::hex2rgb_array($main_color));
$fonts = array();

if (wpgrade::option('use_google_fonts')) {
	$fonts_array = array
	(
		'google_titles_font',
		'google_second_font',
		'google_nav_font',
		'google_body_font'
	);

	foreach ($fonts_array as $font) {
		$the_font = wpgrade::get_the_typo($font);
		if ( isset($the_font['font-family'] ) && ! empty($the_font['font-family'])) {
			$fonts[$font] = $the_font;
		}
	}
}

$port_color = '';
if (wpgrade::option('portfolio_text_color')) {
	$port_color = wpgrade::option('portfolio_text_color');
	$port_color = str_replace('#', '', $port_color);
}

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
//     return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

if ( !empty($main_color) ){
$rgb = implode(",", hex2rgb($main_color)); ?>

a, blockquote, .small-link, .tabs__nav a.current, 
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
.woocommerce-page .star-rating span:before {
    color: <?php echo $main_color; ?>;
}

.heading--main .hN, .widget--sidebar__title, 
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
.btn--add-to-cart {
    background-color: <?php echo $main_color; ?>;
}

.social-icon-link:hover .square, .social-icon-link:focus .square, .social-icon-link:active .square,
.site__stats .stat__value:after, .site__stats .stat__title:after {
    background-color: <?php echo $main_color; ?> !important;
}

@media only screen and (min-width: 900px){
    .nav--main li:hover, .nav--main li.current-menu-item {
        border-bottom-color: <?php echo $main_color; ?>;     
    }
    .back-to-top a:hover:after, .back-to-top a:hover:before {
        border-color: <?php echo $main_color; ?>; 
    }
    .article--billboard > a:hover .article__title:before, 
    .article--billboard > a:hover .article--list__title:before, 
    .article--billboard > a:hover .latest-comments__title:before,
    .article--grid__header:hover .article--grid__title h3, 
    .article--grid__header:hover .article--grid__title:after {
        background-color: <?php echo $main_color; ?>;
    }
}

.woocommerce ul.products li.product a:hover img{
    border-bottom: 5px solid <?php echo $main_color; ?>;
}

ol {
    border-left: 0 solid <?php echo $main_color; ?>;
}
<?php }

if ( isset($fonts['google_titles_font']) ) {?>
	/* Select classes here */
    .badge, h1, h2, h3, h4, h5, h6, hgroup,
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
    .heading span.archive__side-title
      {
		<?php wpgrade::display_font_params($fonts['google_titles_font']); ?>
	}

<?php }

if ( isset($fonts['google_nav_font']) ) {?>
	/* Select classes here */
    nav {
		<?php wpgrade::display_font_params($fonts['google_nav_font']); ?>
	}

<?php }

if ( isset($fonts['google_body_font']) ) {

	// setup a default
	$font_size = '12px';
    if(isset($fonts['google_body_font']['font-size'])) {
        $font_size = $fonts['google_body_font']['font-size'];
        unset($fonts['google_body_font']['font-size']);
    } ?>
	/* Select classes here */
	html, .wp-caption-text, .small-link, 
    .post-nav-link__label, .author__social-link,
    .comment__links, .score__desc  {
		<?php wpgrade::display_font_params($fonts['google_body_font']); ?>
	}
 
    /* Size Classes */
    .article, .single .main, .page .main, 
    .comment__content,
    .footer__widget-area  {
        font-size: <?php echo $font_size ?>;
    }

<?php }

if (wpgrade::option('custom_css')):
	echo "\n" . wpgrade::option('custom_css') . "\n";
endif; ?>