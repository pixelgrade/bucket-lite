<?php
//
///*
// * Register custom post types
// */
//
//function wpgrade_register_post_types() {
//    $psg_label = wpgrade::option('portfolio_single_label');
//    if ( $psg_label == '' ) { define('psg_label', 'Project'); } else { define('psg_label', $psg_label); }
//    $ppl_label = wpgrade::option('portfolio_plural_label');
//    if ( $ppl_label == '' ) { define('ppl_label', 'Projects'); } else { define('ppl_label', $ppl_label); }
//    /*
//     * Portfolio
//     */
//
//    $pargs = array(
//        'labels' => array(
//            'name'              => _x( psg_label, 'Post Type General Name', wpgrade::textdomain() ),
//            'singular_name'     => _x( psg_label, 'Post Type General Name', wpgrade::textdomain() ),
//            'add_new'           => __( 'Add New', wpgrade::textdomain() ),
//            'add_new_item'      => __( 'Add New '.psg_label, wpgrade::textdomain() ),
//            'edit_item'         => __( 'Edit '.psg_label, wpgrade::textdomain() ),
//            'new_item'          => __( 'New '.psg_label, wpgrade::textdomain() ),
//            'all_items'         => __( 'All '.ppl_label, wpgrade::textdomain() ),
//            'view_item'         => __( 'View '.psg_label, wpgrade::textdomain() ),
//            'search_items'      => __( 'Search '.ppl_label, wpgrade::textdomain() ),
//            'not_found'         => __( 'No '.psg_label.' found', wpgrade::textdomain() ),
//            'not_found_in_trash'=> __( 'No '.psg_label.' found in Trash', wpgrade::textdomain() ),
//            'parent_item_colon' => '',
//            'menu_name'         => __( ppl_label, wpgrade::textdomain() ),
//        ),
//        'public'                => true,
//	    'hierarchical'          => true,
//        'publicly_queryable'    => true,
//        'show_ui' => true,
//        'show_in_menu' => true,
//        'query_var' => true,
//        'rewrite' => array( 'slug' => 'portfolio-project', 'with_front' => FALSE ),
//        'capability_type' => 'post',
//        'has_archive' => 'portfolio-archive',
//        'menu_icon' => wpgrade::content_url().'images/admin-menu-icons/report.png',
//        'menu_position' => null,
//        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
//		'yarpp_support' => true
//    );
//
//    if ( wpgrade::option('portfolio_rewrite_slug') && wpgrade::option('portfolio_rewrite_slug') ) {
//        $pargs['rewrite']['slug'] = wpgrade::option('portfolio_slug');
//    }
//
//    if ( wpgrade::option('portfolio_rewrite_archive_slug') && wpgrade::option('portfolio_rewrite_archive_slug') ) {
//        $pargs['has_archive'] = wpgrade::option('portfolio_archive_slug');
//    }
//
//    register_post_type( 'portfolio', $pargs );
//
////	add_post_type_support( 'portfolio', 'post-formats', array('video') );
//
//    // assign categories
////    if ( wpgrade::option('portfolio_use_categories' ) ) {
////        register_taxonomy_for_object_type( "category", 'portfolio' );
////    }
//
//    // assign tags
//    if ( wpgrade::option('portfolio_use_tags' ) ) {
//        register_taxonomy_for_object_type( "post_tag", 'portfolio' );
//    }
//
//    // assign taxonomies to this post type
//    register_taxonomy_for_object_type( 'portfolio_categories', 'portfolio' );
//
//    /*
//     * Homepage Slider
//     */
//
//    $hps_args = array(
//        'labels' => array(
//            'name'              => __( "Home Slides", wpgrade::textdomain() ),
//            'singular_name'     => __( 'Slide', wpgrade::textdomain() ),
//            'add_new'           => __( 'Add New', wpgrade::textdomain() ),
//            'add_new_item'      => __( 'Add New Slide', wpgrade::textdomain() ),
//            'edit_item'         => __( 'Edit Slide', wpgrade::textdomain() ),
//            'new_item'          => __( 'New Slide', wpgrade::textdomain() ),
//            'all_items'         => __( 'All Slides', wpgrade::textdomain() ),
//            'view_item'         => __( 'View Slide', wpgrade::textdomain() ),
//            'search_items'      => __( 'Search Slides', wpgrade::textdomain() ),
//            'not_found'         => __( 'No slides found', wpgrade::textdomain() ),
//            'not_found_in_trash'=> __( 'No slides found in trash', wpgrade::textdomain() ),
//            'parent_item_colon' => '',
//            'menu_name'         => __( 'Home Slider', wpgrade::textdomain() ),
//        ),
//        'publicly_queryable'    => true,
//        'hierarchical'          => true,
//        'public'                => false,
//        'show_ui'               => true,
//        'show_in_nav_menus'     => false,
//        'show_in_admin_bar'     => false,
//        'show_in_menu'          => true,
//        'query_var'             => true,
//        'can_export'            => true,
//        'has_archive'           => false,
//        'exclude_from_search'   => true,
//        'capability_type'       => 'page',
//        'menu_icon' => wpgrade::content_url().'images/admin-menu-icons/x_office_presentation.png',
//        'menu_position'         => null,
//        'supports'              => array('title', 'page-attributes', /*'editor', 'thumbnail' */),
////        'register_meta_box_cb' => 'wpgrade_remove_post_format_panel'
//    );
//    register_post_type( 'homepage_slide', $hps_args );
//    add_post_type_support( 'homepage_slide', 'post-formats', array('video') );
//
//    /*
//     * Testimonial
//     */
//
//    $targs = array(
//        'labels' => array(
//            'name'              => __( 'Testimonials', wpgrade::textdomain() ),
//            'singular_name'     => __( 'Testimonial', wpgrade::textdomain() ),
//            'add_new'           => __( 'Add New', wpgrade::textdomain() ),
//            'add_new_item'      => __( 'Add New Testimonial', wpgrade::textdomain() ),
//            'edit_item'         => __( 'Edit Testimonial', wpgrade::textdomain() ),
//            'new_item'          => __( 'New Testimonial' , wpgrade::textdomain() ),
//            'all_items'         => __( 'All Testimonials' , wpgrade::textdomain() ),
//            'view_item'         => __( 'View Testimonial' , wpgrade::textdomain() ),
//            'search_items'      => __( 'Search Testimonials' , wpgrade::textdomain() ),
//            'not_found'         => __( 'No Testimonial found', wpgrade::textdomain() ),
//            'not_found_in_trash'=> __( 'No Testimonial found in Trash', wpgrade::textdomain() ),
//            'parent_item_colon' => '',
//            'menu_name'         => __( "Testimonials", wpgrade::textdomain() ),
//
//        ),
//        'public' => true,
//        'publicly_queryable' => true,
//        'hierarchical' => true,
//        'show_ui' => true,
//        'show_in_menu' => true,
//        'query_var' => true,
//        'exclude_from_search'   => true,
//        'capability_type' => 'post',
//        'menu_position' => null,
//        'menu_icon' => wpgrade::content_url().'images/admin-menu-icons/user1_edit.png',
//        'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
//        'register_meta_box_cb' => 'wpgrade_remove_post_format_panel'
//    );
//
//    register_post_type( 'testimonial', $targs );
//}
//
//add_action( 'init', 'wpgrade_register_post_types', 1);
//
//function wpgrade_remove_post_format_panel($post){
//    remove_meta_box( 'wpGrade_formatdiv', $post->post_type, 'side' );
//}
//
//function wpgrade_register_taxonomies () {
//	$labels = array(
//		'name'                => _x( 'Portfolio Categories', 'taxonomy general name', wpgrade::textdomain() ),
//		'singular_name'       => _x( 'Portfolio Category', 'taxonomy singular name', wpgrade::textdomain() ),
//		'search_items'        => __( 'Search Portfolio Category', wpgrade::textdomain() ),
//		'all_items'           => __( 'All Portfolio Categories', wpgrade::textdomain() ),
//		'parent_item'         => __( 'Parent Portfolio Category' , wpgrade::textdomain()),
//		'parent_item_colon'   => __( 'Parent Portfolio Category: ', wpgrade::textdomain() ),
//		'edit_item'           => __( 'Edit Portfolio Category' , wpgrade::textdomain()),
//		'update_item'         => __( 'Update Portfolio Category' , wpgrade::textdomain()),
//		'add_new_item'        => __( 'Add New Portfolio Category' , wpgrade::textdomain()),
//		'new_item_name'       => __( 'New Portfolio Category Name' , wpgrade::textdomain()),
//		'menu_name'           => __( 'Portfolio Categories' , wpgrade::textdomain())
//	);
//
//	$args = array(
//		'hierarchical'        => true,
//		'labels'              => $labels,
//		'show_ui'             => true,
//		'show_admin_column'   => true,
//		'query_var'           => true,
//		'rewrite'             => array('slug' => 'portfolio-category','with_front' => FALSE)
//	);
//
//	if (wpgrade::option('portfolio_category_rewrite_slug') && wpgrade::option('portfolio_category_rewrite_slug')) {
//		$args['rewrite']['slug'] = wpgrade::option('portfolio_category_slug');
//	}
//
//	register_taxonomy( 'portfolio_cat', 'portfolio', $args );
//}
//
//add_action('init', 'wpGrade_register_taxonomies', 2);
//
///*
// * Define our custom columns for each custom post type
// */
//
//// testimonials
//add_filter( 'manage_edit-testimonial_columns', 'wpgrade_edit_testimonial_columns' ) ;
//
//function wpgrade_edit_testimonial_columns( $columns ) {
//
//    $columns["testimonial_author"] =  __( 'Author', wpgrade::textdomain() );
//    $columns["author_function"] = __( 'Author Function', wpgrade::textdomain() );
//    unset($columns["date"]);
//    return $columns;
//}
//
//add_action( 'manage_testimonial_posts_custom_column', 'wpgrade_manage_testimonial_columns', 10, 2 );
//
//function wpgrade_manage_testimonial_columns($column, $post_id){
//    global $post;
//    switch( $column ) {
//
//        case 'testimonial_author' :
//            $author = get_post_meta( $post_id, wpgrade::prefix().'testimonial_author', true );
//            echo '<a href="' . get_edit_post_link( $post_id) . '">'. $author . '</a>';
//            break;
//
//        case 'author_function' :
//            echo get_post_meta( $post_id, wpgrade::prefix().'author_function', true );
//            break;
//
//        default :
//            break;
//    }
//}
//
////Customize WordPress messages
//function wpgrade_updated_messages( $messages ) {
//	global $post, $post_ID;
//	$messages['portfolio'] = array(
//		0 => '',
//		1 => sprintf( __('Project updated. <a href="%s">View project</a>', wpgrade::textdomain() ), esc_url( get_permalink($post_ID) ) ),
//		2 => __('Custom field updated.', wpgrade::textdomain() ),
//		3 => __('Custom field deleted.', wpgrade::textdomain() ),
//		4 => __('Project updated.', wpgrade::textdomain() ),
//		5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s', wpgrade::textdomain() ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
//		6 => sprintf( __('Project published. <a href="%s">View project</a>', wpgrade::textdomain() ), esc_url( get_permalink($post_ID) ) ),
//		7 => __('Project saved.', wpgrade::textdomain()),
//		8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>', wpgrade::textdomain() ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
//		9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', wpgrade::textdomain() ), date_i18n( __( 'M j, Y @ G:i', wpgrade::textdomain() ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
//		10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>', wpgrade::textdomain() ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
//	);
//
//	$messages['homepage_slide'] = array(
//		0 => '',
//		1 => sprintf( __('Slide updated. <a href="%s">View slide</a>', wpgrade::textdomain() ), esc_url( get_permalink($post_ID) ) ),
//		2 => __('Custom field updated.', wpgrade::textdomain() ),
//		3 => __('Custom field deleted.', wpgrade::textdomain() ),
//		4 => __('Slide updated.', wpgrade::textdomain() ),
//		5 => isset($_GET['revision']) ? sprintf( __('Slide restored to revision from %s', wpgrade::textdomain() ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
//		6 => sprintf( __('Slide published. <a href="%s">View slide</a>', wpgrade::textdomain() ), esc_url( get_permalink($post_ID) ) ),
//		7 => __('Slide saved.', wpgrade::textdomain() ),
//		8 => sprintf( __('Slide submitted. <a target="_blank" href="%s">Preview slide</a>', wpgrade::textdomain() ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
//		9 => sprintf( __('Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slide</a>', wpgrade::textdomain() ), date_i18n( __( 'M j, Y @ G:i', wpgrade::textdomain() ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
//		10 => sprintf( __('Slide draft updated. <a target="_blank" href="%s">Preview slide</a>', wpgrade::textdomain() ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
//	);
//
//	$messages['testimonial'] = array(
//		0 => '',
//		1 => sprintf( __('Testimonial updated. <a href="%s">View testimonial</a>', wpgrade::textdomain() ), esc_url( get_permalink($post_ID) ) ),
//		2 => __('Custom field updated.', wpgrade::textdomain() ),
//		3 => __('Custom field deleted.', wpgrade::textdomain() ),
//		4 => __('Testimonial updated.', wpgrade::textdomain() ),
//		5 => isset($_GET['revision']) ? sprintf( __('Testimonial restored to revision from %s', wpgrade::textdomain() ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
//		6 => sprintf( __('Testimonial published. <a href="%s">View testimonial</a>', wpgrade::textdomain() ), esc_url( get_permalink($post_ID) ) ),
//		7 => __('Testimonial saved.', wpgrade::textdomain() ),
//		8 => sprintf( __('Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>', wpgrade::textdomain() ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
//		9 => sprintf( __('Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>', wpgrade::textdomain() ), date_i18n( __( 'M j, Y @ G:i', wpgrade::textdomain() ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
//		10 => sprintf( __('Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>', wpgrade::textdomain() ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
//	);
//	return $messages;
//}
//add_filter( 'post_updated_messages', 'wpgrade_updated_messages' );