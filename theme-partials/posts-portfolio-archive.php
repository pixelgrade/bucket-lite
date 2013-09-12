<?php while (have_posts()): the_post(); ?>

	<?php
		$categories = get_the_terms($post->ID, 'portfolio_cat');
		$catclasses = array();
		foreach ($categories as $cat) {
			$catclasses[] = strtolower($cat->name);
		}
	?>

	<li class="portfolio-item <?php echo implode(' ', $catclasses) ?>">
		<a class="portfolio-item-link"
		   href="<?php the_permalink(); ?>">

			<div class="portfolio-item-featured-image">
				<?php the_post_thumbnail('homepage-portfolio'); ?>
			</div>

			<div class="portfolio-item-info">
				<div class="portfolio-item-table">
					<div class="portfolio-item-cell">
						<h3 class="portfolio-item-title">
							<?php echo get_the_title(); ?>
						</h3>
						<hr class="separator light">
						<ul class="portfolio-item-categories-list">
							<?php foreach($categories as $cat): ?>
								<li class="portfolio-item-category">
									<span class="portfolio-item-category-link">
										<?php echo $cat->name; ?>
									</span>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</a>
	</li>

<?php endwhile; ?>
