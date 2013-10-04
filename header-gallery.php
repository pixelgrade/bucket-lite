<?php //this is just for the doctype and <head> section
get_template_part('theme-partials/header/head');

$class_name = '';
if(is_single() && get_post_type() == 'lens_gallery'){
    $class_name = 'single-gallery-';
    $class_name .= get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_template', true);

    if($class_name == 'single-gallery-fullscreen'){
        $class_name .= ' header-transparent';
    }
} else {
	//we are in some sort of gallery archive
	 $class_name = 'gallery-archive';
}

$data_ajaxloading = (wpgrade::option('use_ajax_loading') != '') ? 'data-ajaxloading' : '';
$data_smoothscrolling = (wpgrade::option('use_smooth_scroll') != '') ? 'data-smoothscrolling' : ''; ?>

<body <?php body_class($class_name); echo ' ' . $data_ajaxloading . ' ' . $data_smoothscrolling; ?>>
    <div class="pace">
        <div class="pace-activity"></div>
    </div>
    <div id="page">
        <div class="wrapper">
            <?php //get the main header section - logo, nav, footer
			get_template_part('theme-partials/header/site'); ?>