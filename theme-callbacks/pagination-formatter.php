<?php

/**
 * Note: next_text and prev_text are already flipped as per sorted_paging
 * in the configuration passed to this function.
 *
 * The formatter is designed to generate the following structure:
 *
 *	<div class="wpgrade_pagination">
 *		<a class="prev disabled page-numbers">Previous Page</a>
 *		<div class="pages">
 *			<span class="page">Page</span>
 *			<span class="page-numbers current">1</span>
 *			<span class="dots-of">of</span>
 *			<a class="page-numbers" href="/page/8/">8</a>
 *		</div>
 *		<a class="next page-numbers" href="/page/2/">Newer posts</a>
 *	</div>
 *
 * @param array pagination links
 * @param array pagination configuration
 * @return string
 */
function wpgrade_callback_pagination_formatter($links, $conf) {
    $linkcount = count($links);
    
    //load up the library
    if(!function_exists('wpgrade_str_get_html')) { 
		require_once wpgrade::themefilepath('theme-utilities/includes/vendor/simplehtmldom/simple_html_dom.php');
	}
            
	//don't show anything when no pagination is needed
	if ($linkcount == 0) {
		return '';
	}
	$prefix = '';
	$suffix = '<!--';

	$current = $conf['current'];
    
	foreach ( $links as $key => &$link ) {
        // Create DOM from string
        $element = wpgrade_str_get_html($link);
        $classes = '';
        $anchor = $element->find('a',0);
        if (!empty($anchor)) {
            $classes = $anchor->class;
            
            //lets do some SEO shit
            //remove the page parameter from the link when the first page
            //prevent different urls pointing to the same page
            if ($anchor->innertext == '1' || ($conf['current'] == 2 && $anchor->innertext == $conf['prev_text'])) {
                $anchor->href = get_pagenum_link( 1 );
                $link = $anchor->outertext;
            }
        } else {
            //try and see if it is a span
            $span = $element->find('span',0);
            if (!empty($span)) {
                $classes = $span->class;
            }
        }
        
        if ( $key == $linkcount - 1 ) {
            $suffix = '';
		}
        
        //the li classes to be added
        $class = '';
        
        //first test for current
        if (strpos($classes, 'current') !== false) {
            $class .= 'class="pagination-item pagination-item--current"';
        } elseif (strpos($classes, 'prev') !== false){
            $class .= 'class="pagination-item pagination-item--prev"';
        } elseif (strpos($classes, 'next') !== false){
            $class .= 'class="pagination-item pagination-item--next"';
        }


        $link = $prefix .'<li '.$class.'>' . $link . '</li>' . $suffix;
        $prefix = "\n-->";
    }

    return '<ol class="nav pagination">'.implode('', $links).'</ol>';
}


/** Do the same thing on single post pagination */

function wpgrade_pagination_custom_markup($link, $key) {
    global $wp_query;
    $current = (get_query_var('page')) ? get_query_var('page') : '1';
    $class = '';
    $prefix = '-->';
    $suffix = '<!--';
    switch ( $key ) {
        case $current:
                $class .= 'class="pagination-item pagination-item--current"';
                $link = '<span>' . $link . '</span>';
            break;
        case 'prev':
                $class .= 'class="pagination-item pagination-item--prev"';
            break;
        case 'next':
                $class .= 'class="pagination-item pagination-item--next"';
            break;
        default:
            break;
    }

    $link = $prefix .'<li '.$class.'>' . $link . '</li>' . $suffix;
    return $link;

}
add_filter('wp_link_pages_link', 'wpgrade_pagination_custom_markup', 10, 2);