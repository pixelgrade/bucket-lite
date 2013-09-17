<?php 
    get_header();

        while ( have_posts() ) : the_post();
            
            if ( class_exists('Pix_Query') ) {
                $pixquery = new Pix_Query();
                $pixquery->get_gallery_ids();
            }

            $portfolio_template = get_post_meta(get_the_ID(), wpgrade::prefix().'project_template', true);
            get_template_part('theme-partials/portfolio-templates/portfolio', $portfolio_template);
        endwhile;
        
    get_footer(); 
?>