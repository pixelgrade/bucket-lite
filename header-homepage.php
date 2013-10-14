<?php //this is just for the doctype and <head> section
get_template_part('theme-partials/header/head');

//get the option the user choosed in the page metaboxes
$source = get_post_meta(lens::lang_page_id(get_the_ID()), wpgrade::prefix() . 'custom_homepage', true);

$class_name = '';
if (!empty($source)) {
	if($source == 'lens_gallery') {
		//get the gallery id
		$galleryID = get_post_meta(lens::lang_post_id(get_the_ID()), wpgrade::prefix() . 'homepage_gallery', true);

		$class_name = 'single-gallery-';
		$class_name .= get_post_meta($galleryID, wpgrade::prefix().'gallery_template', true);

		if($class_name == 'single-gallery-fullscreen'){
			$class_name .= ' header-transparent';
		}

		$class_name .= ' single-lens_gallery';
	} elseif ($source == 'lens_portfolio') {
		$class_name .= ' portfolio-archive';
	}
}

if(wpgrade::option('header_inverse') == 1) $class_name .= " header-inverse";

$data_ajaxloading = (wpgrade::option('use_ajax_loading') == 1) ? 'data-ajaxloading' : '';
$data_smoothscrolling = (wpgrade::option('use_smooth_scroll') == 1) ? 'data-smoothscrolling' : ''; ?>

<body <?php body_class($class_name); echo ' ' . $data_ajaxloading . ' ' . $data_smoothscrolling; ?>>
    <div class="pace">
        <div class="pace-activity"></div>
    </div>
    <div id="page">
        <div class="wrapper">
            <?php //get the main header section - logo, nav, footer
			get_template_part('theme-partials/header/site'); ?>