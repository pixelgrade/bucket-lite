<?php 
/*
Template Name: Journal(Blog) Page
*/

get_header();

// save the page title and excerpt
$current_title = get_the_title();
$current_excerpt = get_the_excerpt();

global $paged;
global $wp_query;
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');  
if ( get_query_var('page') ) $paged = get_query_var('page');
query_posts( array('post_type' => 'post', 'paged'=>$paged)); ?>
<div id="main" class="content djax-updatable">

<?php if ( have_posts() ) :
	//lets handle the title display
	//we will use the page title
	?>
	<div class="masonry" data-columns>
		<div class="masonry__item  masonry__item--archive-title">
			<div class="entry__header">
				<h1 class="entry__title"><?php echo $current_title; ?></h1>
				<?php if ($current_excerpt != ""): ?><hr class="separator separator--dotted grow"><?php endif; ?>
			</div>
			<?php if ($current_excerpt != ""): ?><div class="entry__content"><?php echo $current_excerpt; ?></div><?php endif; ?>
		</div><!-- .masonry__item -->
        <?php while ( have_posts() ) : the_post();
			get_template_part('theme-partials/post-templates/blog-content');
        endwhile; ?>
    </div><!-- .masonry -->
	<?php wpgrade::pagination(); ?>

<?php else : ?>

    <?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>

</div>
		
<?php wp_reset_query();	?>
<?php get_footer(); ?>