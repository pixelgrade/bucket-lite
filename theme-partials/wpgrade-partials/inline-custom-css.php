<?php
	/* @var string $main_color */
	/* @var array  $fonts */
	/* @var string $port_color */
	/* @var string $rgb */
 ?>

<style>

<?php

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

    .inverse a,
    .highlighted,
    blockquote:before,
    .emphasized:before,
    .menu-item--main.current-menu-item > a,
    .menu-item--main:hover > a,
    .menu-item--main:focus > a,
    .menu-item--main:active > a,
    .menu-item--parent.current-menu-ancestor > a,
    .menu-item--parent.current-menu-parent > a,
    .mosaic__filter .filter.active,
    .complete i,
    .liked i,
    .article-timestamp--single .article-timestamp__date,
    a:hover > i.pixcode--icon,
    .btn:hover, .wpcf7-submit:hover, .form-submit #comment-submit:hover,
    .widget--header a:hover,
    a.site-home-link {
        color: <?php echo $main_color; ?>;
    }

    .rsNavSelected,
    .pin_ring--outer,
    .liked i,
    .btn, .wpcf7-submit, .form-submit #comment-submit,
    .progressbar__progress,
    .rsNavSelected {
        background-color: <?php echo $main_color; ?>;
    }

    .image__item-meta {
        background-color: <?php echo $main_color; ?>;
        background-color: rgba(<?php echo $rgb; ?>, 0.8);
    }

    .mosaic__item--page-title .image__item-meta {
        background-color: <?php echo $main_color; ?>;
    }

    .loading .pace .pace-activity,
    .no-touch .arrow-button:hover {
        border-color: <?php echo $main_color; ?> ;
    }

    .loading .pace .pace-activity {
        border-top-color: transparent;
    }

    .menu-item--main.current-menu-item:after {
        border-top-color: <?php echo $main_color; ?> ;
    }


    .menu-item--parent:hover:after,
    .menu-item--parent:focus:after,
    .menu-item--parent:active:after {
        border-bottom-color: <?php echo $main_color; ?> ;
    }

    .header:before {
        background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(50%, <?php echo $main_color; ?>), color-stop(100%, #464a4d));
        background-image: -webkit-linear-gradient(<?php echo $main_color; ?> 50%, #464a4d);
        background-image: -moz-linear-gradient(<?php echo $main_color; ?> 50%, #464a4d);
        background-image: -o-linear-gradient(<?php echo $main_color; ?> 50%, #464a4d);
        background-image: linear-gradient(<?php echo $main_color; ?> 50%, #464a4d);
    }

    .lt-ie9 .header:before {
        filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0, startColorstr='#FFFFFC00', endColorstr='#FF464A4D'); }
    }

<?php
}

if ( isset($fonts["body_font"]) ){
    $body_font = $fonts["body_font"]; ?>
    html, 
    .wpcf7-form-control:not([type="submit"]),
    .wp-caption-text,
    blockquote:before,
    ol li,
    .comment__timestamp,
    .comment-form ::-webkit-input-placeholder,
    .comment-form :-moz-placeholder,
    .comment-form ::-moz-placeholder,
    .comment-form :-ms-input-placeholder,
    .meta-box__box-title,
    .header-quote-content blockquote .author_description,
    .testimonial__author-title,
    .widget-content {
        font-family: <?php echo $body_font; ?>
    }

<?php }

if ( isset($fonts["main_font"]) ){
    $main_font = $fonts["main_font"]; ?>
    .count, .count sup,
    .header-quote-content blockquote,
    .article-timestamp,
    .progressbar__title,
    .progressbar__tooltip,
    .testimonial__content,
    .testimonial__author-name,
    .tweet__meta,
    .search-query,
    .mfp-title,
    .entry__content ul li,
    .hN, .alpha, h1,
    .beta, h2, .gamma, h3,
    .masonry__item .entry__title,
    .single-portfolio-fullwidth .entry__title,
    .delta, h4, .epsilon, h5, .zeta, h6,
    .comment__author-name,
    .entry__meta-box a {
        font-family: <?php echo $main_font; ?>
    }

<?php }

if ( isset($fonts["menu_font"]) ){
    $menu_font = $fonts["menu_font"]; ?>
    .image__plus-icon,
    .image_item-description,
    .image_item-category,
    .btn, .wpcf7-submit, .form-submit #comment-submit,
    .header, 
    .header .hN,
    .header .alpha,
    .header h1,
    .header .beta,
    .header h2,
    .header .gamma,
    .header h3,
    .header .masonry__item .entry__title,
    .masonry__item .header .entry__title,
    .header .single-portfolio-fullwidth .entry__title,
    .single-portfolio-fullwidth .header .entry__title,
    .header .delta,
    .header h4,
    .header .epsilon,
    .header h5,
    .header .zeta,
    .header h6,
    .footer .hN,
    .footer .alpha, .footer h1,
    .footer .beta,
    .footer h2,
    .footer .gamma,
    .footer h3,
    .footer .masonry__item .entry__title,
    .masonry__item .footer .entry__title,
    .footer .single-portfolio-fullwidth .entry__title,
    .single-portfolio-fullwidth .footer .entry__title,
    .footer .delta,
    .footer h4,
    .footer .epsilon,
    .footer h5,
    .footer .zeta,
    .footer h6,
    .text-link,
    .projects_nav-item a {
        font-family: <?php echo $menu_font; ?>;
    }

<?php } ?>

<?php if (wpgrade::option('custom_css')): ?>
    <?php echo wpgrade::option('custom_css'); ?>
<?php endif; ?>

</style>
