<?php

//=====================================
//Portfolio functions
//=====================================

// Replace the standard meta box callback with our own
// this so we can condition what posts format appear by custom post type
add_action( 'add_meta_boxes', 'wpGrade_add_meta_boxes' );
function wpGrade_add_meta_boxes( $post_type )
{
    if ( ! get_post_type_object( $post_type ) ) {
        // It's a comment or a link, or something else
        return;
    }
	
    remove_meta_box( 'formatdiv', $post_type, 'side' );
    add_meta_box( 'wpGrade_formatdiv', __( 'Format', wpgrade::textdomain() ), 'wpGrade_post_format_meta_box', $post_type, 'side', 'core' );
}

function wpGrade_post_format_meta_box( $post, $box ) {
    if ( current_theme_supports( 'post-formats' ) && post_type_supports( $post->post_type, 'post-formats' ) ) :
        $post_formats = get_theme_support( 'post-formats' );

        // This is our extra code
        // If the post type has registered post formats, use those instead
        if ( is_array( $GLOBALS['_wp_post_type_features'][$post->post_type]['post-formats'] ) ) {
            $post_formats = $GLOBALS['_wp_post_type_features'][$post->post_type]['post-formats'];
        }

        if ( is_array( $post_formats[0] ) ) :
            $post_format = get_post_format( $post->ID );
            if ( !$post_format )
                $post_format = '0';
            // Add in the current one if it isn't there yet, in case the current theme doesn't support it
            if ( $post_format && !in_array( $post_format, $post_formats[0] ) )
                $post_formats[0][] = $post_format;
            ?>
            <div id="post-formats-select">
                <input type="radio" name="post_format" class="post-format" id="post-format-0" value="0" <?php checked( $post_format, '0' ); ?> /> <label for="post-format-0"><?php _e('Standard', wpgrade::textdomain()); ?></label>
                <?php foreach ( $post_formats[0] as $format ) : ?>
                    <br /><input type="radio" name="post_format" class="post-format" id="post-format-<?php echo esc_attr( $format ); ?>" value="<?php echo esc_attr( $format ); ?>" <?php checked( $post_format, $format ); ?> /> <label for="post-format-<?php echo esc_attr( $format ); ?>"><?php echo esc_html( get_post_format_string( $format ) ); ?></label>
                <?php endforeach; ?><br />
            </div>
        <?php endif; endif;
}

//given and array of numbers find the position that is closest to the $search
function find_closest_number($search, $arr, $key)
{
    $closest = null;
    $closest_key = 0;
    foreach($arr as $current_key => $item)
    {
        if($closest === null || abs($search - $closest) > abs($item[$key] - $search))
        {
            $closest = $item[$key];
            $closest_key = $current_key;
        }
    }
    return $closest_key;
}

function round_to_closest_multiple($n, $multiple) {
	return $multiple * round($n / $multiple);
}

// different pagination for portfolio - not the number of projects from the Reading section
//function portfolio_posts_per_page( $query ) {
//    /*  If this isn't the main query, we'll avoid altering the results. */
//    if ( !$query->is_main_query() || is_admin() )
//        return;
//
//    if ( !empty($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'portfolio' ) {
//        if (is_archive())
//            $query->query_vars['posts_per_page'] = wpgrade::option('portfolio_archive_limit') ? absint(wpgrade::option('portfolio_archive_limit')) : -1;
//    }
//    return $query;
//}
//add_filter( 'pre_get_posts', 'portfolio_posts_per_page' );

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
            return get_post_type_archive_link('portfolio');
        } else {
            return get_page_link($page_id);
        }
    }
    else
    {
        //fallback to the archive slug
        return get_post_type_archive_link('portfolio');
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

function wpgrade_display_portfolio( $posts_nr , $front_page = false, $featured_first = true ) {
    global $post, $paged;
	
	$paged = 1;
    if ( get_query_var('paged') ) $paged = get_query_var('paged');
    if ( get_query_var('page') ) $paged = get_query_var('page');
	
    $query_args = array(
        'post_type'         => 'portfolio',
        'posts_per_page'    => $posts_nr,
		'paged'				=> $paged,
		'orderby' => 'menu_order date',
		'order' => 'desc',
    );
	
	$cat_param = get_query_var('portfolio_cat');
    if ( is_archive() && !empty($cat_param) ) {
        $tax_query_args = array(
            array(
                'taxonomy' => 'portfolio_cat',
                'field' => 'slug',
                'terms' => $cat_param,
            )
        );

        $query_args['tax_query'] = $tax_query_args;
    }

    if ( $featured_first ) {
        $query_args['meta_key'] = wpgrade::prefix() .'portfolio_featured';
        $query_args['orderby'] = 'meta_value menu_order date';
		
		add_filter( 'posts_orderby', 'custom_orderby_display_portfolio' ); 
        $query = new WP_Query( $query_args );
		remove_filter( 'posts_orderby', 'custom_orderby_display_portfolio' ); 
	} else {
		$query = new WP_Query( $query_args );
	}

    if ( !empty( $query ) ) :  ?>
        <div class="portfolio-archive" data-maxpages="<?php echo $query->max_num_pages ?>">

            <?php while ( $query->have_posts() ) : $query->the_post();
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

            <?php endwhile; ?>
        </div>
	<?php endif; ?>
	<?php if ( !$front_page ) {
		//if we are not on the front page or any other page that doesn't need pagination
		//lets do pagination
		global $wp_rewrite;
		$max_page = $query->max_num_pages;
		
		if ( !$paged ) $paged = 1;
		
		//test to see what kind of pagination one wants
		if (wpgrade::option('portfolio_ajax_loading_pagination')) {
			if ($max_page > $paged) { ?>
			<div class="row portfolio-navigation">
				<div class="block block1">
					<div class="load_more"><a href="#"><?php echo wpgrade::option('portfolio_ajax_loading_text') ?></a></div>
				</div><?php
				//we only need the next page link for loading
				$nextpage = intval($paged) + 1;
                if ($nextpage <= $max_page) {
					
					$navlink = get_pagenum_link($nextpage);

        			echo '<div id="portfolio-nav" class="hidden"><div class="previous-project-link hidden"><a href="'.$navlink.'">Older</a></div></div>'; //Older Link using max_num_pages
        			
                } ?>
			</div>
			<?php }
		} else {
			//we do normal pagination with next/prev
			$prevpage = intval($paged) + 1;
			$nextpage = intval($paged) - 1;
			if ($prevpage <= $max_page || $nextpage > 0) { //we have at least one navigation link
		?>
	<div class="row portfolio-navigation" id="portfolio-nav">
        <div class="block block1">
			<div class="block-inner_first">
            <?php
                if ($prevpage <= $max_page) {
					
					$navlink = get_pagenum_link($prevpage);
					
					echo '<div class="previous-project-link"><a href="'.$navlink.'">Older</a></div>'; //Older Link using max_num_pages
                }
            ?>
			</div>
		</div>
		<div class="block block1">
			<div class="block-inner_last">
			<?php
			if ($nextpage == 1) { //no need to put the page information - good for SEO
				
				$navlink = get_pagenum_link($nextpage);
				
				echo  '<div class="next-project-link"><a href="'.$navlink.'">Newer</a></div>'; //Newer Link using max_num_pages
			} elseif ($nextpage > 0) {
				
				$navlink = get_pagenum_link($nextpage);

				echo '<div class="next-project-link"><a href="'.$navlink.'">Newer</a></div>'; //Newer Link using max_num_pages
			} ?>
			</div>
		</div>
	 </div>
	<?php
			}
		}
	}
	wp_reset_postdata();
}

function wpgrade_get_portfolio_row( $row, $is_first ) {

    $content = '';
    $pattern_type = '';
    $images = array();

    foreach ( $row as $k => $field ) {

        if ( preg_match('/^pattern_type/', $k) ) {
            $pattern_type = $field;
            continue;
        }

        // look for editor
        if ( preg_match( '/^editor/', $k ) ) {
            $content = $field;
            continue;
        }

        // get images
        if ( preg_match( '/^image/', $k ) ) {
            $images[$k] = $field;
            continue;
        }

        // get videos
        if ( preg_match( '/^video/', $k ) ) {
            $video[$k] = $field;
            continue;
        }
    }

    if ( empty ($pattern_type) ) return false; // doesn't matter anymore

    // get keys and values for each image
    if ( empty($images) ) {
        $img_key = array();
        $img_val = array();
    } else {
        $img_key = array_keys($images);
        $img_val = array_values($images);
	}

	$popup = '';
	if (is_single()) {
		$popup = 'popup block-image';
	} else {
        $popup = 'block-image';
    }
	
    ob_start();

    switch($pattern_type) {
        case 1: ?>
            <div class="block block1 block-white lap-push4">
                <div class="block-inner block-inner_last arrow arrow-left">

                    <?php if ($is_first) { ?>
                        <h4 class="portfolio-item_title" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                        <hr class="portfolio-item_title-separator">
                    <?php } ?>

                    <div class="portfolio-item_desc"><?php wpgrade::display_content( $content ); ?></div>

                    <?php if ($is_first) { wpgrade_display_portfolio_terms(); } ?>
                </div>
                <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[1], 'full' ); ?>" class="portfolio-image-wrapper image-wrapper_small <?php echo $popup ?>">
                    <?php if ( isset($img_val[1]) ) { ?>
                        <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-small' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
                    <?php } ?>
                </a>
            </div>

            <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>" class="block block1 block-dark lap-pull4 <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>');">
				<?php if (isset($img_val[0])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
                <?php } ?>
            </a>

            <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[2], 'full' ); ?>" class="block block1 block-dark <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[2], 'project-half' ); ?>');">
				<?php if (isset($img_val[2])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[2], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[2]) ?>">
                <?php } ?>
            </a>
            <?php break;
        case 2: ?>
            <div class="block block1 block-white lap-push8">
                <div class="block-inner arrow arrow-bottom">

                    <?php if ($is_first) { ?>
                        <h4 class="portfolio-item_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                        <hr class="portfolio-item_title-separator">
                    <?php } ?>

                    <div class="portfolio-item_desc"><?php wpgrade::display_content( $content ); ?></div>

                    <?php if ($is_first) { wpgrade_display_portfolio_terms(); } ?>

                </div>
                <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[1], 'full' ); ?>" class="portfolio-image-wrapper image-wrapper_small <?php echo $popup ?>">
	                <?php if ( isset($img_val[1]) ) { ?>
	                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-small' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
	                <?php } ?>
	            </a>
            </div>
            <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>" class="block block2 block-darker lap-pull4 <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>');">
            	<?php if (isset($img_val[0])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
                <?php } ?>
            </a>
            <?php break;
        case 3: ?>
            <div class="block block1 block-white lap-push4">
                <div class="block-inner block-inner_last arrow arrow-bottom">

                    <?php if ($is_first) { ?>
                        <h4 class="portfolio-item_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                        <hr class="portfolio-item_title-separator">
                    <?php } ?>

                    <div class="portfolio-item_desc"><?php wpgrade::display_content( $content ); ?></div>

                    <?php if ($is_first) { wpgrade_display_portfolio_terms(); } ?>

                </div>
            </div>

            <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>" class="block block1 block-darker lap-pull4 <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>');">
            	<?php if (isset($img_val[0])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
                <?php } ?>
            </a>

            <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[1], 'full' ); ?>" class="block block1 block-darker <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>');">
            	<?php if (isset($img_val[1])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
                <?php } ?>
            </a>

            <?php break;
        case 4: ?>
            <div class="block block1 block-white lap-push8">
                <div class="block-inner arrow arrow-left">
                    <?php if ($is_first) { ?>
                        <h4 class="portfolio-item_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                        <hr class="portfolio-item_title-separator">
                    <?php } ?>

                    <div class="portfolio-item_desc"><?php wpgrade::display_content( $content ); ?></div>

                    <?php if ($is_first) { wpgrade_display_portfolio_terms(); } ?>
                </div>
            </div>
			<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>" class="block block2 block-darker lap-pull4 <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>');">
            	<?php if (isset($img_val[0])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
                <?php } ?>
            </a>
            <?php break;
        case 5: ?>
            <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>" class="block block1 block-darker portfolio-image-wrapper <?php echo $popup ?>">
                <?php if ( isset($img_val[0]) ) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
                <?php } ?>
            </a>
			<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[1], 'full' ); ?>" class="block block1 block-darker <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>');">
            	<?php if (isset($img_val[1])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
                <?php } ?>
            </a>
            <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[2], 'full' ); ?>" class="block block1 block-darker <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[2], 'project-half' ); ?>');">
            	<?php if (isset($img_val[2])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[2], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[2]) ?>">
                <?php } ?>
            </a>
            <?php break;

        case 6: ?>
            <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>" class="block block2 block-darker portfolio-image-wrapper <?php echo $popup ?>">
                <?php if ( isset($img_val[0]) ) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
                <?php } ?>
            </a>
			<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[1], 'full' ); ?>" class="block block1 block-darker <?php echo $popup ?>" style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>');">
            	<?php if (isset($img_val[1])) { ?>
                    <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
                <?php } ?>
            </a>
            <?php break;

        case 7: ?>
            <div class="block block1 block-white block-video-aside lap-push8">
                <div class="block-inner block-inner_last arrow arrow-left">
                    <?php if ($is_first) { ?>
                        <h4 class="portfolio-item_title" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                        <hr class="portfolio-item_title-separator">
                    <?php } ?>
                    <div class="portfolio-item_desc"><?php wpgrade::display_content( $content ); ?></div>
                    <?php if ($is_first) { wpgrade_display_portfolio_terms(); } ?>
                </div>

                <a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>" class="portfolio-image-wrapper image-wrapper_small <?php echo $popup ?>">
                    <?php if ( isset($img_val[0]) ) { ?>
                        <img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-small' ); ?>" alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
                    <?php } ?>
                </a>
            </div>
            <div class="block block2 block-darker portfolio-image-wrapper lap-pull4">
                <?php
                if ( !empty( $video ) ) {
                    wpgrade_get_portfolio_video( $video );
                } ?>
            </div>
            <?php break;

        case 8: ?>
            <div class="block block1 block-white block-video-aside lap-push8">
                <div class="block-inner arrow arrow-left">
                    <?php if ($is_first) { ?>
                        <h4 class="portfolio-item_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                        <hr class="portfolio-item_title-separator">
                    <?php } ?>
                    <div class="portfolio-item_desc"><?php wpgrade::display_content( $content ); ?></div>
                    <?php if ($is_first) { wpgrade_display_portfolio_terms(); } ?>
                </div>
            </div>
            <div class="block block2 block-darker portfolio-image-wrapper lap-pull4">
                <?php
                if ( !empty( $video ) ) {
                    wpgrade_get_portfolio_video( $video );
                } ?>
            </div>

            <?php break;
        default:
            break;
    }

    echo ob_get_clean();
    return true;
}

function wpgrade_get_portfolio_image_link( $val, $size = 'full' ) {
	$img_link = '';
	if (is_single()) {
		$img1 = json_decode($val,true);
		if ( !empty($img1) ){
			$link = wp_get_attachment_image_src( $img1['id'], $size );
			$img_link = $link[0];
		}
	} else {
		$img_link = get_permalink(get_the_ID());
	}
	
    return $img_link;
}

function wpgrade_get_portfolio_image_src( $val, $size = 'full' ) {

    $img1 = json_decode($val,true);
	$img_link = '';
    if ( !empty($img1) ){
        $link = wp_get_attachment_image_src( (int)$img1['id'], $size );
        $img_link = $link[0];
    }
	
    return $img_link;
}

function wpgrade_get_attachment_image_src( $id, $size = 'full' ) {

	$img_link = '';
	if ( !empty($id) ){
		$link = wp_get_attachment_image_src( $id, $size );
		$img_link = $link[0];
	}

	return $img_link;
}

function wpgrade_get_portfolio_image_alt( $val ) {
    $img1 = json_decode($val,true);

	$img_alt = '';
    if ( !empty($img1) ){
		$img_alt = get_post_meta($img1['id'], '_wp_attachment_image_alt', true);
		if (empty($img_alt)){
            $attachment = get_post($img1['id']);
            if ( !empty($attachment) ) {
                $img_alt = $attachment->post_excerpt;
            }
		}
    }
	
    return $img_alt;
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
add_action( 'wp_ajax_wpgrade_load_all_portfolio_projects', 'wpgrade_load_all_portfolio_projects');
add_action( 'wp_ajax_nopriv_wpgrade_load_all_portfolio_projects', 'wpgrade_load_all_portfolio_projects');
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