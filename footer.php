<?php

	$social_icons = wpgrade::option('social_icons');

	$domain_icons = array
		(
			'youtube' => 'e-play',
			'appnet' => 'user',
		);

?>

		<?php # content ... ?>

		<?php get_sidebar('footer'); ?>

		<div class="wrapper wrapper-footer main-footer_siteinfo">
			<footer class="container">
				<div class="row">
					<div class="footer_right span6 lap-push6">
						<?php if (count($social_icons)): ?>
							<ul class="menu-footer_social">
								<?php foreach ($social_icons as $domain => $value): ?>
									<?php if ($value): ?>
										<li class="footer-social-link">
											<a href="<?php echo $value ?>" <?php if (wpgrade::option('social_icons_target_blank')): ?>target="_blank"<?php endif; ?>>
												<i class="shc icon-<?php echo isset($domain_icons[$domain]) ? $domain_icons[$domain] : "e-$domain" ?>"></i>
											</a>
										</li>
									<?php endif; ?>
								<?php endforeach ?>
							</ul>
						<?php endif; ?>
					</div>
					<div class="footer_left span6 lap-pull6">
						<?php if (wpgrade::option('copyright_text')): ?>
							<?php wpgrade::display_content(wpgrade::option('copyright_text')); ?>
						<?php endif; ?>
					</div>
				</div>
			</footer>
		</div>
	</div> <!-- close page -->

	<!-- Google Analytics tracking code -->
	<?php if (wpgrade::option('google_analytics')): ?>
		<?php echo wpgrade::option('google_analytics'); ?>
	<?php endif; ?>

	<?php wp_footer(); ?>

</body>

</html>