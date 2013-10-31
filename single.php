<?php 
/**
 * The Template for displaying all single posts.
 *
 */

get_header(); ?>

<div class="container container--main">

    <div class="grid">

        <?php
		// let's get to know this post a little better
		$full_width_featured_image = get_post_meta(get_the_ID(), '_bucket_full_width_featured_image', true);
		$disable_sidebar = get_post_meta(get_the_ID(), '_bucket_disable_sidebar', true);

		// let's use what we know
		$content_width = $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';
		$featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';
        
        get_template_part('theme-partials/post-templates/header-single', get_post_format()); ?>

        <div class="grid__item  main  float--left  <?php echo $content_width; ?>">

            <?php while (have_posts()): the_post(); ?>
		        <style type="text/css">
			        #share-box{
				        height: 150px;
			        }
			        .sharrre{
				        margin:55px 0 0 50px;
				        float:left;
			        }
			        .sharrre .box a:hover{
				        text-decoration:none;
			        }
			        .sharrre .count {
				        color:#525b67;
				        display:block;
				        font-size:18px;
				        font-weight:bold;
				        line-height:40px;
				        height:40px;
				        position:relative;
				        text-align:center;
				        width:70px;
				        -webkit-border-radius:4px;
				        -moz-border-radius:4px;
				        border-radius:4px;
				        border:1px solid #b2c6cc;
				        background: #fbfbfb; /* Old browsers */
				        background: -moz-linear-gradient(top, #fbfbfb 0%, #f6f6f6 100%); /* FF3.6+ */
				        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fbfbfb), color-stop(100%,#f6f6f6)); /* Chrome,Safari4+ */
				        background: -webkit-linear-gradient(top, #fbfbfb 0%,#f6f6f6 100%); /* Chrome10+,Safari5.1+ */
				        background: -o-linear-gradient(top, #fbfbfb 0%,#f6f6f6 100%); /* Opera 11.10+ */
				        background: -ms-linear-gradient(top, #fbfbfb 0%,#f6f6f6 100%); /* IE10+ */
				        background: linear-gradient(top, #fbfbfb 0%,#f6f6f6 100%); /* W3C */
				        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbfbfb', endColorstr='#f6f6f6',GradientType=0 ); /* IE6-9 */
			        }
			        .sharrre .count:before, .sharrre .count:after {
				        content:'';
				        display:block;
				        position:absolute;
				        left:49%;
				        width:0;
				        height:0;
			        }
			        .sharrre .count:before {
				        border:solid 7px transparent;
				        border-top-color:#b2c6cc;
				        margin-left:-7px;
				        bottom: -14px;
			        }
			        .sharrre .count:after {
				        border:solid 6px transparent;
				        margin-left:-6px;
				        bottom:-12px;
				        border-top-color:#fbfbfb;
			        }
			        .sharrre .share {
				        color:#FFFFFF;
				        display:block;
				        font-size:12px;
				        font-weight:bold;
				        height:30px;
				        line-height:30px;
				        margin-top:8px;
				        padding:0;
				        text-align:center;
				        text-decoration:none;
				        width:70px;
				        -webkit-border-radius:4px;
				        -moz-border-radius:4px;
				        border-radius:4px;
			        }
			        #twitter .share {
				        text-shadow: 1px 0px 0px #0077be;
				        filter: dropshadow(color=#0077be, offx=1, offy=0);
				        border:1px solid #0075c5;
				        background: #26c3eb;
				        background: -moz-linear-gradient(top, #26c3eb 0%, #26b3e6 50%, #00a2e1 51%, #0080d6 100%); /* FF3.6+ */
				        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#26c3eb), color-stop(50%,#26b3e6), color-stop(51%,#00a2e1), color-stop(100%,#0080d6)); /* Chrome,Safari4+ */
				        background: -webkit-linear-gradient(top, #26c3eb 0%,#26b3e6 50%,#00a2e1 51%,#0080d6 100%); /* Chrome10+,Safari5.1+ */
				        background: -o-linear-gradient(top, #26c3eb 0%,#26b3e6 50%,#00a2e1 51%,#0080d6 100%); /* Opera 11.10+ */
				        background: -ms-linear-gradient(top, #26c3eb 0%,#26b3e6 50%,#00a2e1 51%,#0080d6 100%); /* IE10+ */
				        background: linear-gradient(top, #26c3eb 0%,#26b3e6 50%,#00a2e1 51%,#0080d6 100%); /* W3C */
				        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#26c3eb', endColorstr='#0080d6',GradientType=0 ); /* IE6-9 */
				        box-shadow: 0 1px 4px #DDDDDD, 0 1px 0 #5cd3f1 inset;
			        }
			        #facebook .share {
				        text-shadow: 1px 0px 0px #26427e;
				        filter: dropshadow(color=#26427e, offx=1, offy=0);
				        border:1px solid #24417c;
				        background: #5582c9; /* Old browsers */
				        background: -moz-linear-gradient(top, #5582c9 0%, #33539a 100%); /* FF3.6+ */
				        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#5582c9), color-stop(100%,#33539a)); /* Chrome,Safari4+ */
				        background: -webkit-linear-gradient(top, #5582c9 0%,#33539a 100%); /* Chrome10+,Safari5.1+ */
				        background: -o-linear-gradient(top, #5582c9 0%,#33539a 100%); /* Opera 11.10+ */
				        background: -ms-linear-gradient(top, #5582c9 0%,#33539a 100%); /* IE10+ */
				        background: linear-gradient(top, #5582c9 0%,#33539a 100%); /* W3C */
				        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5582c9', endColorstr='#33539a',GradientType=0 ); /* IE6-9 */
				        box-shadow: 0 1px 4px #DDDDDD, 0 1px 0 #80a1d6 inset;
			        }
			        #googleplus .share {
				        text-shadow: 1px 0px 0px #222222;
				        filter: dropshadow(color=#222222, offx=1, offy=0);
				        border:1px solid #262626;
				        background: #6d6d6d; /* Old browsers */
				        background: -moz-linear-gradient(top, #6d6d6d 0%, #434343 100%); /* FF3.6+ */
				        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#6d6d6d), color-stop(100%,#434343)); /* Chrome,Safari4+ */
				        background: -webkit-linear-gradient(top, #6d6d6d 0%,#434343 100%); /* Chrome10+,Safari5.1+ */
				        background: -o-linear-gradient(top, #6d6d6d 0%,#434343 100%); /* Opera 11.10+ */
				        background: -ms-linear-gradient(top, #6d6d6d 0%,#434343 100%); /* IE10+ */
				        background: linear-gradient(top, #6d6d6d 0%,#434343 100%); /* W3C */
				        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6d6d6d', endColorstr='#434343',GradientType=0 ); /* IE6-9 */
				        box-shadow: 0 1px 4px #DDDDDD, 0 1px 0 #929292 inset;
			        }
		        </style>

				<?php get_template_part('theme-partials/post-templates/share-box'); ?>
                <?php if (get_the_title()): ?>
                    <h1 class="article__title  article__title--single"><?php the_title(); ?></h1>
                <?php else: ?>
                    <h1 class="article__title  article__title--single"><?php _e('Untitled', wpgrade::textdomain()); ?></h1>
                <?php endif; ?>

                <div class="article__title__meta">
                    <?php printf('<div class="article__author-name">%s</div>', get_the_author_link()) ?>
                    <time class="article__time" datetime="<?php the_time('c'); ?>"> <?php printf(__('on %s', wpgrade::textdomain()),get_the_time(__('j F, Y \a\t H:i', wpgrade::textdomain()))); ?></time>
                </div>

                <?php
		        the_content();

		        $args = array(
			        'before' => "<ol class=\"nav pagination\"><!--",
			        'after' => "\n--></ol>",
//			        'link_before'      => '',
//			        'link_after'       => '',
			        'next_or_number' => 'next_and_number',
			        'previouspagelink' => __('Previous', wpgrade::textdomain()),
			        'nextpagelink' => __('Next', wpgrade::textdomain())
		        );
		        wp_link_pages( $args ); ?>

                <div class="grid">
                    <div class="grid__item two-eighths">
                        <?php if ( bucket::has_average_score() ) { ?>
                            <div class="score__average-wrapper">
                                <div class="score__average <?php echo get_field('note') ? 'average--with-note' : '' ?>">
                                    <?php
                                        echo bucket::get_average_score();
                                        if (get_field('note')) {
                                            echo '<div class="score__note">'.get_field('note').'</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div><!--
                 --><?php if (get_field('enable_pros_cons_lists')):
                        if (get_field('pros_list')): ?><!--
                         --><div class="score__pros">
                                <div class="score__pros__title">
                                    <h3 class="hN"><?php _e('Good Things', wpgrade::textdomain()); ?></h3>
                                </div>
                                <ul class="score__pros__list">
                                    <?php while(has_sub_fields('pros_list')): ?>
                                        <li class="score_pro"><?php echo get_sub_field('pros_note'); ?></li>      
                                    <?php endwhile; ?>
                                </ul>
                            </div><!--
                        <?php endif;
                        if (get_field('cons_list')): ?>
                         --><div class="score__cons">
                                <div class="score__cons__title">
                                    <h3 class="hN"><?php _e('Bad Things', wpgrade::textdomain()); ?></h3>
                                </div>
                                <ul class="score__cons__list">
                                    <?php while(has_sub_fields('cons_list')): ?>
                                        <li class="score__con"><?php echo get_sub_field('cons_note'); ?></li>      
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php
				if (get_field('enable_review_score')):
					if (get_field('score_breakdown')): ?>
						<h3>The Breakdown</h3>
						<hr class="separator  separator--subsection">
						<?php while (has_sub_fields('score_breakdown')): ?>
							<div class="review__score">
								<div class="score__label"><?php echo get_sub_field('label'); ?></div>
								<span class="score__badge  badge"><?php echo get_sub_field('score'); ?></span>
								<div class="score__progressbar  progressbar">
									<div class="progressbar__progress" style="width: <?php echo get_sub_field('score')*10; ?>%;"></div>
								</div>
							</div>
						<?php endwhile; ?>
						<hr class="separator  separator--subsection">
					<?php endif;
				endif; ?>

                <div class="article__meta  article--single__meta">
                    <?php
                    if (get_field('credits')):
                        while (has_sub_field('credits')): ?>
                            <div class="btn-list">
                                <div class="btn  btn--small  btn--secondary"><?php echo get_sub_field('name'); ?></div>
                                <a href="<?php echo get_sub_field('full_url'); ?>" class="btn  btn--small  btn--primary"><?php echo get_sub_field('label'); ?></a>
                            </div>
                        <?php endwhile;
                    endif; ?>
					
					<?php 
					$categories = get_the_category();
                    if ($categories): ?>
                    <div class="btn-list">
                        <div class="btn  btn--small  btn--secondary"><?php _e('Categories', wpgrade::textdomain()) ?></div>
                        <?php
						foreach ($categories as $category):
							echo '<a class="btn  btn--small  btn--tertiary" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s"), $category->name)) .'">'. $category->cat_name.'</a>';
						endforeach; ?>
                    </div>
					<?php endif;

					$tags = get_the_tags();
                    if ($tags): ?>
                    <div class="btn-list">
                        <div class="btn  btn--small  btn--secondary"><?php _e('Tagged', wpgrade::textdomain()) ?></div>
                        <?php
							foreach ($tags as $tag):
								echo '<a class="btn  btn--small  btn--tertiary" href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s"), $tag->name)) .'">'. $tag->name.'</a>';
							endforeach;
                        ?>
                    </div>
					<?php endif; ?>
                </div>
				
				<?php get_template_part( 'author-bio' ); ?>

                <hr class="separator  separator--subsection">
                
                <?php
				$next_post = get_next_post();
				$prev_post = get_previous_post();
				if (!empty($prev_post) || !empty($next_post)): ?>
				
				<nav class="post-nav  grid">
					<div class="post-nav-link  post-nav-link--prev  grd__item  one-half">
						<?php if (!empty($prev_post)): ?>
							<a href="<?php echo get_permalink($prev_post->ID); ?>">
								<div class="post-nav-link__label">
									<?php _e("Previous Article", wpgrade::textdomain()); ?>
								</div>
								<div class="post-nav-link__title">
									<div class="hN"><?php echo $prev_post->post_title; ?></div>
								</div>
							</a>
						<?php endif; ?>
					</div><!-- 
				 --><div class="divider--pointer"></div><!--
				 --><div class="post-nav-link  post-nav-link--next  grd__item  one-half">
						<?php if (!empty($next_post)): ?>
							<a href="<?php echo get_permalink($next_post->ID); ?>">
								<div class="post-nav-link__label">
									<?php _e("Next Article", wpgrade::textdomain()); ?>
								</div>
								<div class="post-nav-link__title">
									<div class="hN"><?php echo $next_post->post_title; ?></div>
								</div>
							</a>
						<?php endif; ?>
					</div> 
				</nav>
				
                <?php endif; ?>
				
                <hr class="separator  separator--section">
				
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();

	        endwhile; ?>
        </div><!--
        
        <?php if ($disable_sidebar != 'on'): ?>
         --><div class="grid__item  one-third  palm-one-whole  sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php else: // ugly ?>
         -->
        <?php endif; ?>

    </div>

</div>
    
<?php get_footer(); ?>