<?php
get_header('portfolio');

global $wpgrade_private_post;

if ( post_password_required() && !$wpgrade_private_post['allowed'] ) {

	get_template_part('theme-partials/password-request-form');

} else { // password protection

	while ( have_posts() ) : the_post();
	    $portfolio_template = get_post_meta(get_the_ID(), wpgrade::prefix().'project_template', true);
	    get_template_part('theme-partials/portfolio-templates/portfolio', $portfolio_template);
	endwhile;

}

get_footer();
