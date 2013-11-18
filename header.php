<?php //this is just for the doctype and <head> section
get_template_part('theme-partials/header/head');

$class_name = '';
if(is_page() && get_page_template_slug(wpgrade::lang_original_post_id(get_the_ID())) == 'template-journal.php') {
	$class_name .= ' blog';
}

$schema_org = '';
if (is_single()) {
	$schema_org .= 'itemscope itemtype="http://schema.org/Article"';
} else {
	$schema_org .= 'itemscope itemtype="http://schema.org/WebPage"';
}

if(wpgrade::option('nav_inverse_top') == 1) $class_name .= " nav-inverse-top";
if(wpgrade::option('nav_inverse_main') == 1) $class_name .= " nav-inverse-main"; ?>

<body <?php body_class($class_name); ?> <?php echo $schema_org ?> >
    <div class="pace">
        <div class="pace-activity"></div>
    </div>    
    <div id="page">
        <nav class="navigation  navigation--mobile">
            <h2 class="accessibility"><?php _e('Primary Mobile Navigation', wpgrade::textdomain()) ?></h2>
            <?php 
                wpgrade_main_nav_mobile();
                wpgrade_top_nav_left('nav--stacked', true);
                wpgrade_top_nav_right('nav--stacked', true);
            ?>
        </nav>    
        <div class="wrapper">
            <?php //get the main header section - logo, nav, footer
			get_template_part('theme-partials/header/site', wpgrade::option('header_type')); ?>
