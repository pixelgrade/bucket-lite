<?php
/**
 * Template Name: Page Builder
 */

/*
*  Loop through a Flexible Content field and display it's content with different views for different layouts
*/

get_header();?>
<div class="container">
	<div class="grid">
		<?php while(has_sub_field("blocks")):

			if(get_row_layout() == "billboard_slider"): // layout:Billboard Slider
				get_template_part('theme-partials/acf-layouts/billboard_slider');
			elseif(get_row_layout() == "posts_grid_cards"): // layout: Posts Grid Cards
				get_template_part('theme-partials/acf-layouts/posts_grid_cards');
			elseif(get_row_layout() == "hero_posts_module"): // layout: Hero Posts Module
				get_template_part('theme-partials/acf-layouts/latest_posts');
			elseif(get_row_layout() == "latest_posts"): // layout: Latest Posts
				get_template_part('theme-partials/acf-layouts/latest_posts');
			elseif(get_row_layout() == "content"): // layout: Content
				get_template_part('theme-partials/acf-layouts/content');
			elseif(get_row_layout() == "heading_title"): // layout: Head
				get_template_part('theme-partials/acf-layouts/heading_title');
			endif;

		endwhile; ?>
	</div>
</div>
<?php get_footer();
