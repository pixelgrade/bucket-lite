<?php
	$args = array
		(
			'post_type' => 'portfolio',
			'posts_per_page' => -1
		);

	$query = new WP_Query( $args );
?>

<?php if ($query->have_posts()): ?>
	<?php while ($query->have_posts()) : $query->the_post(); ?>

		<?php
			$categories = get_the_terms($post->ID, 'portfolio_cat');
			$portfolio_item_classes = array('portfolio-item');

			if ( ! has_post_thumbnail()) {
				$portfolio_item_classes[] = 'project-no-image';
			}

			if ($categories) {
				foreach($categories as $cat) {
					$portfolio_item_classes[] = strtolower($cat->name);
				}
			}
		?>

		<li class="<?php echo implode(' ', $portfolio_item_classes) ?>">
			<a class="portfolio-item-link"
			   href="<?php the_permalink(); ?>">

				<div class="portfolio-item-featured-image">
					<?php if(has_post_thumbnail()): ?>
						<?php the_post_thumbnail('homepage-portfolio'); ?>
					<?php endif; ?>
				</div>

				<div class="portfolio-item-info">
					<div class="portfolio-item-table">
						<div class="portfolio-item-cell">
							<h3 class="portfolio-item-title"><?php echo get_the_title(); ?></h3>
							<?php if($categories) : ?>
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
							<?php endif; ?>
						</div>
					</div>
				</div>
			</a>
		</li>

	<?php endwhile; ?>
<?php endif; ?>

<?php wp_reset_postdata(); # restore original Post Data ?>