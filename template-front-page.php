<?php get_header(); ?>

	<?php if (wpgrade::option('homepage_use_slider')): ?>
		<?php get_template_part('theme-partials/posts', 'homepage-slides'); ?>
	<?php endif; ?>

	<?php $homepage_content1 = wpgrade::option('homepage_content1'); ?>
	<?php if ( ! empty($homepage_content1)): ?>
		<div class="wrapper wrapper-body">
			<div class="container container-body">
				<?php wpgrade::display_content( $homepage_content1 ); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if (wpgrade::option('use_site_wide_box')): ?>
		<div class="wrapper call-to-action-wrapper">
			<div class="container call-to-action-container">

				<?php $wide_content = wpgrade::option('site_wide_section'); ?>

				<?php if ( ! empty($wide_content)): ?>
					<div class="main call-to-action-text">
						<?php wpgrade::display_content($wide_content); ?>
					</div>
				<?php endif; ?>

				<?php
					$CTA_label = wpgrade::option( 'site_wide_button_label' );
					$CTA_label2 = wpgrade::option( 'site_wide_button_label2' );
					if ($CTA_label2 == '') {
						$CTA_label2 = $CTA_label;
					}
					$CTA_link = wpgrade::option( 'site_wide_button_link' );
				?>

				<?php if ( ! empty($CTA_label) && ! empty($CTA_link)): ?>
					<div class="side call-to-action-button cl-effect-2">
						<a class="btn" href="<?php echo $CTA_link; ?>">
							<span data-hover="<?php echo $CTA_label2; ?>">
								<?php echo $CTA_label; ?>
							</span>
						</a>
					</div>
				<?php endif; ?>

			</div>
		</div>
	<?php endif; ?>

	<?php if (wpgrade::option('homepage_use_portfolio')): ?>
		<div class="wrapper wrapper-main">
			<div class="container">
				<div class="featuredworks-header">
					<div class="main main-featuredworks">
						<div class="portfolio-container">
							<h2 class="featuredworks-title">
								<?php echo wpgrade::option('homepage_portfolio_title'); ?>
							</h2>
							<ul class="flex-direction-nav">
								<li>
									<a id="portfolio-works-previous" class="flex-prev" href="#"></a>
								</li>
								<li>
									<a id="portfolio-works-next" class="flex-next" href="#"></a>
								</li>
							</ul>
							<ul id="homepage-portfolio-items-list" class="portfolio-items-list">
								<?php get_template_part('theme-partials/posts', 'homepage-portfolio'); ?>
								<?php wp_reset_postdata(); # restore original Post Data ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php $homepage_content2 = wpgrade::option('homepage_content2'); ?>
	<?php if ($homepage_content2): ?>

		<div class="wrapper wrapper-body">
			<div class="container container-body">
				<?php wpgrade::display_content($homepage_content2); ?>
			</div>
		</div>

	<?php endif; ?>

<?php get_footer(); ?>
