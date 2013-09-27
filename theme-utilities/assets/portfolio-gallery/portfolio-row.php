<?php switch ($pattern_type) { ?>

	<?php case 1: ?>
		<div class="block block1 block-white lap-push4">
			<div class="block-inner block-inner_last arrow arrow-left">

				<?php if ($is_first): ?>
					<h4 class="portfolio-item_title" >
						<a href="<?php the_permalink() ?>">
							<?php the_title(); ?>
						</a>
					</h4>
					<hr class="portfolio-item_title-separator">
				<?php endif; ?>

				<div class="portfolio-item_desc">
					<?php wpgrade::display_content( $content ); ?>
				</div>

				<?php if ($is_first): ?>
					<?php wpgrade_display_portfolio_terms(); ?>
				<?php endif; ?>

			</div>

			<a href="<?php echo wpgrade_get_portfolio_image_link($img_val[1], 'full'); ?>"
			   class="portfolio-image-wrapper image-wrapper_small <?php echo $popup ?>">
				<?php if (isset($img_val[1])): ?>
					<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-small' ); ?>"
						 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
				<?php endif; ?>
			</a>
		</div>

		<a href="<?php echo wpgrade_get_portfolio_image_link($img_val[0], 'full'); ?>"
		   class="block block1 block-dark lap-pull4 <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>');">

			<?php if (isset($img_val[0])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
			<?php endif; ?>

		</a>

		<a href="<?php echo wpgrade_get_portfolio_image_link($img_val[2], 'full'); ?>"
		   class="block block1 block-dark <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[2], 'project-half' ); ?>');">

			<?php if (isset($img_val[2])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[2], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[2]) ?>">

			<?php endif; ?>
		</a>

		<?php break; ?>

	<?php case 2: ?>

		<div class="block block1 block-white lap-push8">
			<div class="block-inner arrow arrow-bottom">
				<?php if ($is_first): ?>
					<h4 class="portfolio-item_title">
						<a href="<?php the_permalink() ?>">
							<?php the_title(); ?>
						</a>
					</h4>
					<hr class="portfolio-item_title-separator">
				<?php endif; ?>

				<div class="portfolio-item_desc">
					<?php wpgrade::display_content($content); ?>
				</div>

				<?php if ($is_first): ?>
					<?php wpgrade_display_portfolio_terms(); ?>
				<?php endif; ?>
			</div>

			<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[1], 'full' ); ?>"
			   class="portfolio-image-wrapper image-wrapper_small <?php echo $popup ?>">

				<?php if (isset($img_val[1])): ?>
					<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-small' ); ?>"
						 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
				<?php endif; ?>

			</a>
		</div>

		<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>"
		   class="block block2 block-darker lap-pull4 <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>');">

			<?php if (isset($img_val[0])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
			<?php endif; ?>
		</a>

		<?php break; ?>

	<?php case 3: ?>
		<div class="block block1 block-white lap-push4">
			<div class="block-inner block-inner_last arrow arrow-bottom">
				<?php if ($is_first): ?>
					<h4 class="portfolio-item_title">
						<a href="<?php the_permalink() ?>">
							<?php the_title(); ?>
						</a>
					</h4>
					<hr class="portfolio-item_title-separator">
				<?php endif; ?>

				<div class="portfolio-item_desc">
					<?php wpgrade::display_content($content); ?>
				</div>

				<?php if ($is_first): ?>
					<?php wpgrade_display_portfolio_terms(); ?>
				<?php endif; ?>
			</div>
		</div>

		<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>"
		   class="block block1 block-darker lap-pull4 <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>');">

			<?php if (isset($img_val[0])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
			<?php endif; ?>

		</a>

		<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[1], 'full' ); ?>"
		   class="block block1 block-darker <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>');">

			<?php if (isset($img_val[1])) { ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
			<?php } ?>

		</a>

		<?php break; ?>

	<?php case 4: ?>

		<div class="block block1 block-white lap-push8">
			<div class="block-inner arrow arrow-left">
				<?php if ($is_first): ?>
					<h4 class="portfolio-item_title">
						<a href="<?php the_permalink() ?>">
							<?php the_title(); ?>
						</a>
					</h4>
					<hr class="portfolio-item_title-separator">
				<?php endif; ?>

				<div class="portfolio-item_desc">
					<?php wpgrade::display_content($content); ?>
				</div>

				<?php if ($is_first): ?>
					<?php wpgrade_display_portfolio_terms(); ?>
				<?php endif; ?>

			</div>
		</div>

		<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>"
		   class="block block2 block-darker lap-pull4 <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>');">

			<?php if (isset($img_val[0])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
			<?php endif; ?>
		</a>

		<?php break; ?>

	<?php case 5: ?>

		<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>"
		   class="block block1 block-darker portfolio-image-wrapper <?php echo $popup ?>">

			<?php if (isset($img_val[0])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
			<?php endif; ?>

		</a>

		<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[1], 'full' ); ?>"
		   class="block block1 block-darker <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>');">

			<?php if (isset($img_val[1])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
			<?php endif; ?>

		</a>

		<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[2], 'full' ); ?>"
		   class="block block1 block-darker <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[2], 'project-half' ); ?>');">

			<?php if (isset($img_val[2])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[2], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[2]) ?>">
			<?php endif; ?>
		</a>

		<?php break; ?>

	<?php case 6: ?>

		<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>"
		   class="block block2 block-darker portfolio-image-wrapper <?php echo $popup ?>">
			<?php if (isset($img_val[0])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
			<?php endif; ?>
		</a>
		<a href="<?php echo wpgrade_get_portfolio_image_link($img_val[1], 'full'); ?>"
		   class="block block1 block-darker <?php echo $popup ?>"
		   style="background-image: url('<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>');">

			<?php if (isset($img_val[1])): ?>
				<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[1], 'project-half' ); ?>"
					 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[1]) ?>">
			<?php endif; ?>

		</a>

		<?php break; ?>

	<?php case 7: ?>

		<div class="block block1 block-white block-video-aside lap-push8">

			<div class="block-inner block-inner_last arrow arrow-left">
				<?php if ($is_first): ?>
					<h4 class="portfolio-item_title">
						<a href="<?php the_permalink() ?>">
							<?php the_title(); ?>
						</a>
					</h4>
					<hr class="portfolio-item_title-separator">
				<?php endif; ?>

				<div class="portfolio-item_desc">
					<?php wpgrade::display_content( $content ); ?>
				</div>

				<?php if ($is_first): ?>
					<?php wpgrade_display_portfolio_terms(); ?>
				<?php endif; ?>
			</div>

			<a href="<?php echo wpgrade_get_portfolio_image_link( $img_val[0], 'full' ); ?>"
			   class="portfolio-image-wrapper image-wrapper_small <?php echo $popup ?>">

				<?php if (isset($img_val[0])): ?>
					<img src="<?php echo wpgrade_get_portfolio_image_src( $img_val[0], 'project-small' ); ?>"
						 alt="<?php echo wpgrade_get_portfolio_image_alt($img_val[0]) ?>">
				<?php endif; ?>

			</a>

		</div>

		<div class="block block2 block-darker portfolio-image-wrapper lap-pull4">
			<?php if ( ! empty($video)): ?>
				<?php wpgrade_get_portfolio_video($video); ?>
			<?php endif; ?>
		</div>

		<?php break; ?>

	<?php case 8: ?>

		<div class="block block1 block-white block-video-aside lap-push8">
			<div class="block-inner arrow arrow-left">

				<?php if ($is_first): ?>
					<h4 class="portfolio-item_title">
						<a href="<?php the_permalink() ?>">
							<?php the_title(); ?>
						</a>
					</h4>
					<hr class="portfolio-item_title-separator">
				<?php endif; ?>

				<div class="portfolio-item_desc">
					<?php wpgrade::display_content( $content ); ?>
				</div>

				<?php if ($is_first): ?>
					<?php wpgrade_display_portfolio_terms(); ?>
				<?php endif; ?>

			</div>
		</div>

		<div class="block block2 block-darker portfolio-image-wrapper lap-pull4">
			<?php if ( ! empty($video)): ?>
				<?php wpgrade_get_portfolio_video( $video );
			<?php endif; ?>
		</div>

		<?php break; ?>

<?php } # switch ?>