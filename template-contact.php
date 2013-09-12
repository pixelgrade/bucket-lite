<?php
/*
Template Name: Contact Page
*/
get_header();

if (have_posts()) : while (have_posts()) : the_post();

        global $post;
        // The user can choose to hide the wordpress title and put his own with visual editor
        $html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'page_html_title', true);

        $header_height = absint(wpgrade::option('nocontent_header_height'));
        $height = '';
        // if ($header_height && empty($html_title)) {
        if ($header_height) {
          $height = 'data-height="'.$header_height.'"';
        }

		if (has_post_thumbnail()) {
			$featured_id = get_post_thumbnail_id();
			$featured_image = wp_get_attachment_image_src($featured_id, 'full');
			if (empty($height) && empty($html_title)) {
				$height = 'data-width="'. $featured_image[1] .'" data-height="'. $featured_image[2] .'"';
			} ?>
			<div class="wrapper-featured-image">
		        <div class="parallax-container" <?php echo $height ?>>
                    <?php echo '<div class="parallax-item header-image" style="background-image: url('.$featured_image[0].');"></div>'; ?>
                </div>
				<div class="page-header content-bigger s-inverse">
                    <div class="page-header-wrapper">
                        <div class="content">
    					<?php if (!empty($html_title)) { ?>
    						<?php wpgrade::display_content($html_title ); ?>
    					<?php } ?>
                        </div>
                    </div>
				</div>
			</div>
		<?php } elseif (!empty($html_title)) { ?>
			<div class="wrapper-featured-image"  style="background-color: <?php echo get_post_meta(get_the_ID(), wpgrade::prefix().'header_background_color', true); ?>">
				<div class="featured-image-container">
					<div class="featured-image-container-wrapper content-bigger s-inverse">
                        <div class="page-header-wrapper">
                            <div class="content">                        
						      <?php wpgrade::display_content($html_title ); ?>
                          </div>
                        </div>
					</div>				
				</div>
			</div>
		<?php } else {
			echo '<div class="wrapper-featured-image no-image"></div>';
		} ?>

	<div class="wrapper">
        <div class="container container-content">
            <div class="main main-content">
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/Article">
	                <?php $hide_title = get_post_meta(get_the_ID(), wpgrade::prefix().'page_display_title', true);
	                if ( $hide_title != "on" ):  ?>
	                    <h1 class="entry-title single-title" itemprop="name"><?php echo get_the_title(); ?></h1>
	                <?php endif; ?>

	                <div class="container">
		                <?php the_content(); ?>
	                </div>

	                <div class="block-inner block-inner_first">
                        <?php if (wpgrade::option('contact_use_gmap')) { ?>
                            <div id="gmap">
                                <div class="row contact-info-wrapper" data-gmap-url="<?php echo wpgrade::option('contact_gmap_link'); ?>" data-custom-style="<?php echo wpgrade::option('contact_gmap_custom_style'); ?>">
                                    <div class="contact-info">
                                        <div class="pin_ring pin_1"></div>
                                    </div>
                                </div>
                                <div id="map_canvas" style="width: 100%; height: 100%"></div>
                                <div class="container" style="display: none">
                                    <div class="row contact-info-wrapper" data-gmap-url="<?php echo wpgrade::option('contact_gmap_link'); ?>" data-custom-style="<?php echo wpgrade::option('contact_gmap_custom_style'); ?>"></div>
                                </div>
                            </div>
                        <?php }
						if( wpgrade::option('contact_form_title') ) {
							echo '<h2>'. wpgrade::option('contact_form_title') .'</h2>';
						} else { ?>
                            <h2>Contact form</h2>
						<?php }
						if ( wpgrade::option('contact_form_7') ) {
                            echo do_shortcode( '[contact-form-7 id="'.wpgrade::option('contact_form_7').'"]' );
                        } ?>
                    </div>            
                </article>
            </div>
            <div class="side side-content sidebar unwrap">
                <div class="block-inner block-inner_last headings-small content-small">
                    <?php
	                if(wpgrade::option('contact_sidebar_title')) {
                        echo '<h4 itemprop="name" class="page-sidebar-heading">'.wpgrade::option('contact_sidebar_title').'</h2>';
	                } else { ?>
                        <h4 itemprop="name" class="page-sidebar-heading"><?php echo get_the_title(); ?></h4>
                    <?php } echo apply_filters('the_content', wpgrade::option('contact_content_left') ) ?>
                    <?php if(wpgrade::option('contact_info_title')){ echo '<h4 class="page-sidebar-heading">'.wpgrade::option('contact_info_title').'</h4>'; } ?>
                    <?php if(wpgrade::option('contact_address')){ echo '<p class="contact-address">'.wpgrade::option('contact_address').'</p>'; } ?>
                    <?php if(wpgrade::option('contact_phone')){ echo '<p class="contact-phone"><i class="icon-phone"></i>'.wpgrade::option('contact_phone').'</p>'; } ?>
                    <?php if(wpgrade::option('contact_email')){ echo '<p class="contact-email"><i class="icon-envelope"></i>'.wpgrade::option('contact_email').'</p>'; } ?>
                    <?php //if(wpgrade::option('contact_gmap_link')){ echo '<p><a target="_blank" href="'.wpgrade::option('contact_gmap_link').'">Get Directions &raquo;</a></p>'; } ?>
                </div>            
            </div>
        </div>
    </div>

    <?php
//comments_template();
endwhile; endif;
get_footer(); ?>