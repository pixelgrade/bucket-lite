<div class="wrapper wrapper-footer wrapper-footer_sidebar">
	<footer class="container sidebar-footer-container">
		<div class="sidebar-footer_left unwrap">
			<?php if (is_active_sidebar('footer-left')): ?>
				<?php dynamic_sidebar('footer-left'); ?>
			<?php endif; ?>
		</div>
		<div class="sidebar-footer_right-container">
		  <div class="row">
			<div class="sidebar-footer_middle span12 desk-span6">
				<?php if (is_active_sidebar('footer-middle')): ?>
					<?php dynamic_sidebar('footer-middle'); ?>
				<?php endif; ?>
			</div>
			<div class="sidebar-footer_right span12 desk-span6">
				<?php if (is_active_sidebar('footer-right')): ?>
					<?php dynamic_sidebar('footer-right'); ?>
				<?php endif; ?>
			</div>
		  </div>
		</div>
	</footer>
</div>