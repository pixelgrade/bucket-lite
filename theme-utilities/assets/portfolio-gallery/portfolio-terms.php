<ul class="portfolio-item_categories">
	<?php foreach ($terms_list as $key => $term ): ?>
		<li class="portfolio-item_cat">
			<a class="portfolio-item_cat-link"
			   href="<?php echo get_term_link($term->slug, 'portfolio_cat'); ?>">

				<?php echo $term->name; ?>

			</a>
		</li>
	<?php endforeach; ?>
</ul>
