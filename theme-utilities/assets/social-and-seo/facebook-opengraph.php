<?php
global $wp, $pagename, $post;
$current_url = wpgrade_get_current_canonical_url();
?>

<!-- facebook open graph stuff -->

<?php if (wpgrade::option('facebook_id_app')): ?>
<meta property="fb:app_id" content="<?php echo wpgrade::option('facebook_id_app') ?>"/>
<?php endif; ?>

<?php if (wpgrade::option('facebook_admin_id')): ?>
<meta property="fb:admins" content="<?php echo wpgrade::option('facebook_admin_id') ?>"/>
<?php endif; ?>

<meta property="og:site_name" content="<?php echo get_bloginfo("name") ?>"/>
<meta property="og:url" content="<?php echo $current_url ?>"/>

<?php if ( ! empty($pagename)): ?>
<meta property="og:title" content="<?php echo $pagename ?>" />
<?php endif; ?>

<?php if (is_singular()): ?>

<?php setup_postdata($post); ?>

<meta property="og:type" content="article"/>
<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()) ?>" />
<meta property="article:published_time" content="<?php echo get_the_time('Y-m-j') ?>">
<meta property="article:section" content="<?php echo ucfirst(wpgrade_main_category(get_the_category(), false)) ?>">

<?php $posttags = get_the_tags();
if ($posttags): ?>
<?php foreach($posttags as $tag): ?>
<meta property="article:tag" content="<?php echo $tag->name ?>">
<?php endforeach; ?>
<?php endif; ?>

<meta property="og:image" content="<?php echo wpgrade_get_socialimage() ?>"/>

<?php endif;?>

<!-- end facebook open graph -->