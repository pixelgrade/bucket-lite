<?php //this is just for the doctype and <head> section
get_template_part('theme-partials/header/head');

$class_name = '';
if(is_page() && get_page_template_slug(get_the_ID()) == 'template-journal.php') {
	$class_name .= ' blog';
}

if(wpgrade::option('top_nav_inverse') == 1) $class_name .= " top-nav-inverse";
if(wpgrade::option('main_nav_inverse') == 1) $class_name .= " main-nav-inverse";

?>

<body <?php body_class($class_name); ?>>
    <div class="pace">
        <div class="pace-activity"></div>
    </div>    
    <div id="page">
        <nav class="navigation  navigation--mobile">
            <h2 class="accessibility"><?php _e('Primary Mobile Navigation', wpgrade::textdomain()) ?></h2>
            <?php wpgrade_main_nav(); ?>
        </nav>    
        <div class="wrapper">
            <?php //get the main header section - logo, nav, footer
			get_template_part('theme-partials/header/site_' . wpgrade::option('header_type')); ?>
