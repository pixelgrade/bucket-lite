<?php 
$social_links = wpgrade::option('social_icons');

$target = '';
if ( wpgrade::option('social_icons_target_blank') ) {
	$target = 'target="_blank"';
}

if (count($social_links)): ?>
<?php foreach ($social_links as $domain => $value): if ($value): ?>
    <li>
    	<a class="social-icon-link" href="<?php echo $value ?>" <?php echo $target ?>>
    		<i class="pixcode  pixcode--icon  icon-e-<?php echo $domain; ?> square small"></i>
    	</a>
    </li>
<?php endif; endforeach ?>
<?php endif;?> 