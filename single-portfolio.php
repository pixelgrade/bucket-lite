<?php 
    get_header();

        while ( have_posts() ) : the_post();
            $portfolio_template = get_post_meta(get_the_ID(), wpgrade::prefix().'project_template', true);
            get_template_part('theme-partials/portfolio-templates/portfolio', $portfolio_template);
        endwhile;
        
    get_footer(); 
?>