<?php
while ( have_posts() ) : the_post();
    $gallery_template = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_template', true);
    get_template_part('theme-partials/gallery-templates/gallery', $gallery_template);
endwhile;