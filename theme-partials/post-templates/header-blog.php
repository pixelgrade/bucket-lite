<div class="article--grid__header">
    <a href="<?php the_permalink(); ?>">
        <div class="article--grid__thumb article__featured-image">
            <?php
			$flush_top = 'flush--top';
            if (has_post_thumbnail()):
        		$thumbsize = 'blog-medium';

            $has_thumb = has_post_thumbnail();
			//no need to flush if we have a thumbnail
            $flush_top = '';
        	
        		//grab the desired thumb size from the query params if present
        		global $wp_query;
        		if (isset($wp_query->query_vars['thumbnail_size'])) {
        			$thumbsize = $wp_query->query_vars['thumbnail_size'];
        		}
        		
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbsize);

        		$image_ratio = 0.7; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
        		if (isset($image[1]) && isset($image[2])) {
        			$image_ratio = $image[2] * 100/$image[1];
        		}
            ?>
                <div class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
                    <img src="<?php echo $image[0] ?>" />
                </div>
            <?php
            endif;
            ?>

            <?php post_format_icon();
        	if ( bucket::has_average_score() ) { ?>
                <div class="badge  badge--article"><?php echo bucket::get_average_score();?> <span class="badge__text">score</span></div>
        	<?php } ?>
        </div>
        
        <div class="article__title  article--grid__title <?php echo $flush_top; ?>">
          <h3 class="hN"><?php the_title(); ?></h3>
        </div>
    </a>
</div>
