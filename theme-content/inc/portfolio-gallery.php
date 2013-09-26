<?php

function get_portfolio_page_link() {
    global $wpdb;

    $results = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta
    WHERE meta_key='_wp_page_template' AND meta_value='template-portfolio.php'");

    if (!empty($results))
    {
        $page_id = '';
        foreach ($results as $result)
        {
            $page_id = $result->post_id;
            $the_template_page = get_post( $page_id );
            if ( $the_template_page->post_status == 'publish' ) {
                break;
            } else {
                $page_id = 'doesnt_exists';
            }
        }

        if ( $page_id == 'doesnt_exists' ) {
            return get_post_type_archive_link('lens_portfolio');
        } else {
            return get_page_link($page_id);
        }
    }
    else
    {
        //fallback to the archive slug
        return get_post_type_archive_link('lens_portfolio');
    }
}

// Return the slug of the page with the portfolio template or false if none
function get_portfolio_page_slug() {
    global $wpdb;

    $results = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta
    WHERE meta_key='_wp_page_template' AND meta_value='template-portfolio.php'");

    if (!empty($results))
    {
        $page_id = '';
        foreach ($results as $result)
        {
            $page_id = $result->post_id;
            $the_template_page = get_post( $page_id );
            if ( $the_template_page->post_status == 'publish' ) {
                break;
            } else {
                $page_id = 'doesnt_exists';
            }
        }
        if ( $page_id == 'doesnt_exists' ) {
            return false;
        } else {
            return $the_template_page->post_name;
        }
    }
    else
    {
        return false;
    }
}

//get an array of the most used tags with filter
function wpGrade_get_most_used_tags( $args = '' ) {
    $defaults = array(
        'orderby' => 'name', 'order' => 'ASC',
        'exclude' => '', 'include' => '',
        'taxonomy' => 'post_tag',
    );
    $args = wp_parse_args( $args, $defaults );

    return get_terms( $args['taxonomy'], array_merge( $args, array( 'orderby' => 'count', 'order' => 'DESC' ) ) ); // Always query top tags
}

//make sure that the portfolio menu items have the correct classes when on single projects
add_action('nav_menu_css_class', 'add_current_nav_class_for_portfolio', 10, 2 );
function add_current_nav_class_for_portfolio($classes, $item ) {
	// Necessary, otherwise we can't get current post ID
	global $post;
	
	//get the Portfolio url just to know when the menu item is the same
	$portfolio_url = get_portfolio_page_link();
	
	//test if the current post is of type portfolio and that the menu item has the link to the portfolio archive
	if (isset($post->post_type) && $post->post_type == 'portfolio') {
		$classes = array_filter($classes, "remove_parent_classes");
		if ($item->url == $portfolio_url) {
			 $classes[] = 'current_page_parent current-menu-item';
		} else if ($item->url == get_permalink ($post->id)) {
			 $classes[] = 'current-menu-item';
		}
	}
	
	// Return the corrected set of classes to be added to the menu item
	return $classes;
}

function remove_parent_classes($class)
{
  // check for current page classes, return false if they exist.
	return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;
}

function custom_orderby_display_portfolio($orderby) {
	global $wpdb;
	return "$wpdb->postmeta.meta_value DESC, $wpdb->posts.menu_order DESC, $wpdb->posts.post_date DESC";
}

function wpgrade_get_portfolio_video( $videos ) {

    foreach ( $videos as $k => $video ){
        if ( preg_match( '/embed/', $k ) && !empty($video) ) {
            echo '<div class="video-wrap">'.$video.'</div>';
            break;
        } elseif ( preg_match( '/mp4/', $k ) ) {
            $video_mp4 = $video;
        } elseif ( preg_match( '/webm/', $k ) ) {
            $video_webm = $video; //get_post_meta($postID, wpgrade::prefix().'video_webm', true);
        } elseif ( preg_match( '/ogv/', $k ) ) {
            $video_ogv =  $video; //get_post_meta($postID, wpgrade::prefix().'video_ogv', true);
        } elseif ( preg_match( '/preview/', $k ) ) {
            $video_poster =  $video; //get_post_meta($postID, wpgrade::prefix().'video_poster', true);
        }
    }

    if ( !preg_match( '/embed/', $k ) ) { ?>

        <video <?php echo !empty($video_poster) ? 'poster="'.$video_poster.'"' : ''; ?> width="100%" height="auto" controls="controls" preload="none">
            <?php if( !empty( $video_mp4 ) ) : ?>
                <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
                <source type="video/mp4" src="<?php echo $video_mp4; ?>" />
            <?php endif; ?>
            <?php if( !empty( $video_webm ) ) : ?>
                <!-- WebM/VP8 for Firefox4, Opera, and Chrome -->
                <source type="video/webm" src="<?php echo $video_webm; ?>" />
            <?php endif; ?>
            <?php if( !empty( $video_ogv ) ) : ?>
                <!-- Ogg/Vorbis for older Firefox and Opera versions -->
                <source type="video/ogg" src="<?php echo $video_ogv; ?>" />
            <?php endif; ?>
            <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
            <object width="100%" height="auto" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/library/js/plugins/flashmediaelement.swf">
                <param name="movie" value="<?php echo get_template_directory_uri(); ?>/library/js/plugins/flashmediaelement.swf" />
                <?php if( !empty( $video_mp4 ) ) : ?>
                    <param name="flashvars" value="controls=true&file=<?php echo $video_mp4; ?>" />
                <?php endif; ?>
                <!-- Image as a last resort -->
                <img src="<?php echo !empty($video_poster) ? $video_poster : get_template_directory_uri().'/library/images/mediaelement/no-video-image.jpg'; ?>" title="No video playback capabilities" />
            </object>
        </video>
        <?php
    }

    return false;
}

function wpgrade_display_portfolio_terms(){
    $terms_list = wp_get_post_terms( get_the_ID(), 'portfolio_cat', array("fields" => "all"));
    if ( !empty($terms_list) ) { ?>
        <ul class="portfolio-item_categories">
            <?php foreach ($terms_list as $key => $term ) { ?>
                <li class="portfolio-item_cat">
                    <a class="portfolio-item_cat-link" href="<?php echo get_term_link( $term->slug, 'portfolio_cat' ); ?>"><?php echo $term->name; ?></a>
                </li>
            <?php } ?>
        </ul>
    <?php }
}

function wpgrade_display_blog_terms(){
	$terms_list = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "all"));
	if ( !empty($terms_list) ) { ?>
		<ul class="portfolio-item_categories">
			<?php foreach ($terms_list as $key => $term ) { ?>
				<li class="portfolio-item_cat">
					<a class="portfolio-item_cat-link" href="<?php echo get_term_link( $term->slug, 'category' ); ?>"><?php echo $term->name; ?></a>
				</li>
			<?php } ?>
		</ul>
	<?php }
}

/*
 * Ajax loading all projects
 */
//add_action( 'wp_ajax_wpgrade_load_all_portfolio_projects', 'wpgrade_load_all_portfolio_projects');
//add_action( 'wp_ajax_nopriv_wpgrade_load_all_portfolio_projects', 'wpgrade_load_all_portfolio_projects');
function wpgrade_load_all_portfolio_projects( $front_page = false, $featured_first = true ) {
	global $post;
	$paged = 1;
	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	if ( get_query_var('page') ) $paged = get_query_var('page');
	$query_args = array(
		'post_type'         => 'portfolio',
		'posts_per_page'    => 999, // unlikely number
		'orderby' => 'menu_order date',
		'order' => 'desc',
		'paged' => $paged
	);
	if ( isset( $_POST['offset'] ) ) {
		$query_args['offset'] = (int)$_POST['offset'];
	}
	if ($featured_first ) {
		$query_args['meta_key'] = wpgrade::prefix() .'portfolio_featured';
		$query_args['orderby'] = 'meta_value menu_order date';

		add_filter( 'posts_orderby', 'custom_orderby_display_portfolio' );
		$query = new WP_Query( $query_args );
		remove_filter( 'posts_orderby', 'custom_orderby_display_portfolio' );
	} else {
		$query = new WP_Query( $query_args );
	}
	ob_start();
	if ( !empty( $query ) ) :while ( $query->have_posts() ) : $query->the_post();
			$terms = wp_get_post_terms( $post->ID, 'portfolio_cat', array("fields" => "slugs")); ?>

			<div class="portfolio-row row" <?php if ( $terms ) { echo 'data-terms="'. implode( ' ', $terms) .'"'; } ?>>
				<?php
				$rows = get_post_meta( $post->ID, wpgrade::prefix() .'portfolio_rows', true);
				$rows = json_decode($rows, true);
				if ( !empty($rows) ) {
					// get only the first row
					wpgrade_get_portfolio_row( (array)$rows[0], true);
				} ?>
			</div>

	<?php endwhile; endif; wp_reset_postdata();
	echo json_encode( ob_get_clean() );
	die();
}