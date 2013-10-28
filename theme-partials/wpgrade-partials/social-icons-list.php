<?php 
$social_links = wpgrade::option('social_icons');

$target = '';
if ( wpgrade::option('social_icons_target_blank') ) {
	$target = 'target="_blank"';
}

if (count($social_links)): ?>
<?php foreach ($social_links as $domain => $value): if ($value): ?>
	<li class="social-item">
		<a href="<?php echo $value ?>" class="social-icon-link" <?php echo $target ?>>
			<i class="icon-e-<?php echo $domain; ?>"></i>
		</a>
	</li>
<?php endif; endforeach ?>
<?php endif;?> 