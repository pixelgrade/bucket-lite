<?php
global $wpGrade_Options;
/*
 * Social and SEO improvements
 */

/* 
Social Integration
This is a collection of snippets I edited or reused from
social plugins. No need to use a plugin when you can 
replicate it in only a few lines I say, so here we go.
For more info, or to add more open graph stuff, check
out: http://yoast.com/facebook-open-graph-protocol/
*/

// get the image for the google + and facebook integration 
function wpgrade_get_socialimage()
{
	global $post;
	if (!empty($post))
	{
		$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', '' );

		//we use the featured image id defined
		if ( has_post_thumbnail($post->ID) )
		{
			$socialimg = $src[0];
		}
		else
		{
			$socialimg = '';
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			if (array_key_exists(1, $matches))
				if (array_key_exists(0, $matches[1]))
					$socialimg = $matches [1] [0];
		}

		if(empty($socialimg))
		{
			if (is_attachment())
			{
				$temp = wp_get_attachment_image_src( $post->ID,"full");
				$socialimg = $temp[0];
			}
			else
			{
				//try to get the first attached image
				$files = get_children('post_parent='.$post->ID.'&post_type=attachment&post_mime_type=image&order=desc');
				if($files)
				{
					$keys = array_reverse(array_keys($files));
					$j=0;
					$num = $keys[$j];
					$image=wp_get_attachment_image($num, 'full', true);
					$imagepieces = explode('"', $image);
					$imagepath = $imagepieces[1];

					$socialimg=wp_get_attachment_url($num);
				}
				else
				{
					//use a default image

					//check if we have one uploaded in the theme options
					if ( wpgrade::option('social_share_default_image') )
					{
						$socialimg = wpgrade::option('social_share_default_image');
					}
					else
					{
						//use the default thumb gif
						$socialimg = get_template_directory_uri() . '/library/images/nothumb.gif';
					}
				}
			}
		}
		return $socialimg;
	}
	else
	{
		return '';
	}
}

// get the main category of a post - usefull when we have sub categories
function wpgrade_main_category($category, $shout = true)
{
	if (!empty($category))
	{
		$parent = get_cat_name($category[0]->category_parent);
		if (!empty($parent))
		{
			if ($shout)
			{
				echo strtolower($parent);
			}
			else
			{
				return strtolower($parent);
			}
		}
		else
		{
			if ($shout)
			{
				echo strtolower($category[0]->cat_name);
			}
			else
			{
				return strtolower($category[0]->cat_name);
			}
		}
	}
	else
	{
		return '';
	}
}

// This is code is inspired by Yoast SEO.	
function wpgrade_get_current_canonical_url() {
	global $wp_query;

	if ( $wp_query->is_404 || $wp_query->is_search ) {
		return false;
	}

	$haspost = count( $wp_query->posts ) > 0;

	if ( get_query_var( 'm' ) ) {
		$m = preg_replace( '/[^0-9]/', '', get_query_var( 'm' ) );
		switch ( strlen( $m ) ) {
			case 4: $link = get_year_link( $m ); break;
			case 6: $link = get_month_link( substr( $m, 0, 4), substr($m, 4, 2 ) ); break;
			case 8: $link = get_day_link( substr( $m, 0, 4 ), substr( $m, 4, 2 ), substr( $m, 6, 2 ) ); break;
			default:
				return false;
		}
	} elseif ( ( $wp_query->is_single || $wp_query->is_page ) && $haspost ) {
		$post = $wp_query->posts[0];
		$link = get_permalink( $post->ID );
	} elseif ( $wp_query->is_author && $haspost ) {
		$author = get_userdata( get_query_var( 'author' ) );
		if ($author === false) {
			return false;
		}
		$link = get_author_posts_url( $author->ID, $author->user_nicename );
	} elseif ( $wp_query->is_category && $haspost ) {
		$link = get_category_link( get_query_var( 'cat' ) );
	} elseif ( $wp_query->is_tag && $haspost ) {
		$tag = get_term_by( 'slug', get_query_var( 'tag' ), 'post_tag' );
		if ( !empty( $tag->term_id ) ) {
			$link = get_tag_link( $tag->term_id );
		}
	} elseif ( $wp_query->is_day && $haspost ) {
		$link = get_day_link( get_query_var( 'year' ),
			get_query_var( 'monthnum' ),
			get_query_var( 'day' ) );
	} elseif ( $wp_query->is_month && $haspost ) {
		$link = get_month_link( get_query_var( 'year' ),
			get_query_var( 'monthnum' ) );
	} elseif ( $wp_query->is_year && $haspost ) {
		$link = get_year_link( get_query_var( 'year' ) );
	} elseif ( $wp_query->is_home ) {
		if ( (get_option( 'show_on_front' ) == 'page' ) && ( $pageid = get_option( 'page_for_posts' ) ) ) {
			$link = get_permalink( $pageid );
		} else {
			if ( function_exists( 'icl_get_home_url' ) ) {
				$link = icl_get_home_url();
			} else {
				$link = get_option( 'home' );
			}
		}
	} elseif ( $wp_query->is_tax && $haspost ) {
		$taxonomy = get_query_var( 'taxonomy' );
		$term = get_query_var( 'term' );
		$link = get_term_link( $term, $taxonomy );
	} elseif ( $wp_query->is_archive && function_exists( 'get_post_type_archive_link' ) && ( $post_type = get_query_var( 'post_type' ) ) ) {
		$link = get_post_type_archive_link( $post_type );
	} else {
		return false;
	}

	//let's see about the page number
	$page = get_query_var( 'page' );
	if ( empty( $page ) )
		$page = get_query_var( 'paged' );

	if ( !empty( $page ) && $page > 1 ) {
		$link = trailingslashit( $link ) ."page/". "$page";
		$link = user_trailingslashit( $link, 'paged' );
	}
	return $link;
}

// facebook share correct image fix (thanks to yoast)
function wpgrade_facebook_opengraph()
{
	echo "\n" . '<!-- facebook open graph stuff -->' . "\n";
	if ( wpgrade::option( 'facebook_id_app' ) ) {
		echo '<meta property="fb:app_id" content="'. wpgrade::option( 'facebook_id_app' ).'"/>' . "\n";
	}
	if ( wpgrade::option( 'facebook_admin_id' ) ) {
		echo '<meta property="fb:admins" content="'.wpgrade::option( 'facebook_admin_id' ).'"/>';
	}

	echo '<meta property="og:site_name" content="'. get_bloginfo("name") .'"/>' . "\n";
	global $wp;
	$current_url = wpgrade_get_current_canonical_url();
	echo '<meta property="og:url" content="'. $current_url .'"/>' . "\n";
	global $pagename;
	if (!empty($pagename))
	{
		echo '<meta property="og:title" content="'.$pagename.'" />' . "\n";
	}

	if (is_singular())
	{
		global $post;
		setup_postdata( $post );
		echo '<meta property="og:type" content="article"/>' . "\n";
		echo '<meta property="og:description" content="'.  strip_tags(get_the_excerpt()).'" />' . "\n";
		echo '<meta property="article:published_time"  content="'.get_the_time('Y-m-j').'">'. "\n";
		echo '<meta property="article:section"         content="'.ucfirst(wpgrade_main_category(get_the_category(), false)).'">'. "\n";
		$posttags = get_the_tags();
		if ($posttags)
		{
			foreach($posttags as $tag)
			{
				echo '<meta property="article:tag"             content="'.$tag->name.'">'. "\n";
			}
		}
		echo '<meta property="og:image" content="'. wpgrade_get_socialimage() .'"/>' . "\n";
	}
	echo '<!-- end facebook open graph -->' . "\n";
}

// google +1 meta info
function wpgrade_google_metas()
{
	echo '<!-- google +1 tags -->' . "\n";
	if (is_singular())
	{
		global $post;
		echo '<meta itemprop="name" content="'.get_the_title().'">' . "\n";
		echo '<meta itemprop="description" content="' .strip_tags( get_the_excerpt() ).'">' . "\n";
		echo '<meta itemprop="image" content="'. wpgrade_get_socialimage() .'">' . "\n";

		//add the author link
		if ( get_the_author_meta('google_profile') ) {
			echo '<link rel="author" href="' . get_the_author_meta('google_profile') . '" />' . "\n";
		}
	}

	//we only add the publisher link on the home page
	if (is_front_page() && wpgrade::option( 'google_page_url' ) ) {
		echo '<link rel="publisher" href="http://plus.google.com/' . wpgrade::option( 'google_page_url') . '"/>';
	}
	echo '<!-- end google +1 tags -->' . "\n";
}

// twitter card meta info
function wpgrade_twitter_card()
{

	if (is_singular())
	{
		echo '<!-- twitter card tags -->' . "\n";
		global $post;
		echo '<meta name="twitter:card" content="summary">'. "\n";

		global $wp;
		$current_url =  wpgrade_get_current_canonical_url();
		echo '<meta name="twitter:url" content="'. $current_url .'" >' . "\n";
		if ( wpgrade::option( 'twitter_card_site' ) ) {
			echo '<meta name="twitter:site" content="@' . wpgrade::option( 'twitter_card_site') . '"/>' . "\n";
		}
		if ( get_the_author_meta('user_tw') ) {
			echo '<meta name="twitter:creator" content="@' . get_the_author_meta('user_tw') . '"/>' . "\n";
		}
		echo '<meta name="twitter:domain" content="'. $_SERVER['HTTP_HOST'] .'">' . "\n";
		echo '<meta name="twitter:title" content="'. get_the_title() .'">' . "\n";
		echo '<meta name="twitter:description" content="' .strip_tags( get_the_excerpt() ).'">' . "\n";
		echo '<meta name="twitter:image:src" content="'. wpgrade_get_socialimage() .'">' . "\n";
		echo '<!-- end twitter card tags -->' . "\n";
	}
}

function load_social_share() {

	if ( wpgrade::option('prepare_for_social_share') ) {
		add_action('wp_head', 'wpgrade_facebook_opengraph');
		add_action('wp_head', 'wpgrade_google_metas');
		add_action('wp_head', 'wpgrade_twitter_card');
	}
}

add_action('init','load_social_share', 5);

// adding the rel=me thanks to yoast	
function yoast_allow_rel()
{
	global $allowedtags;
	$allowedtags['a']['rel'] = array ();
}
add_action( 'wp_loaded', 'yoast_allow_rel' );

// adding facebook, twitter, & google+ links to the user profile
function wpgrade_add_user_fields( $contactmethods ) {
	// Add Facebook
	$contactmethods['user_fb'] = 'Facebook';
	// Add Twitter
	$contactmethods['user_tw'] = 'Twitter';
	// Add Google+
	$contactmethods['google_profile'] = 'Google Profile URL';
	// Save 'Em
	return $contactmethods;
}
add_filter('user_contactmethods','wpgrade_add_user_fields',10,1);