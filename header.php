<?php //this is just for the doctype and <head> section
get_template_part('theme-partials/header/head'); ?>
<?php
    $class_name = '';
	if(is_page() && get_page_template_slug(get_the_ID()) == 'template-journal.php') {
		$class_name .= ' blog';
	}

    $data_ajaxloading = (wpgrade::option('use_ajax_loading') != '') ? 'data-ajaxloading' : '';
    $data_smoothscrolling = (wpgrade::option('use_smooth_scroll') != '') ? 'data-smoothscrolling' : '';
?>
<body <?php body_class($class_name); echo ' ' . $data_ajaxloading . ' ' . $data_smoothscrolling; ?>>
    <div class="pace">
        <div class="pace-activity"></div>
    </div>
    <div id="page">
        <div class="wrapper">
            <?php //get the main header section - logo, nav, footer
			get_template_part('theme-partials/header/site'); ?>
