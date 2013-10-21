<?php get_header(); ?>

<div class="container">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole">
            <?php if (have_posts()): ?>
                <div class="heading  heading--main">
                    <h2 class="hN">Latest Articles</h2>
                </div>
                <div class="grid" data-columns>
                    <?php while (have_posts()): the_post(); ?><!--
                     --><div><?php get_template_part('theme-partials/post-templates/content-blog'); ?></div><!--
                 --><?php endwhile; ?>
                    <?php wpgrade::pagination(); ?>
                </div>
            <?php else: get_template_part( 'no-results', 'index' ); endif; ?>
        </div><!--
        
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>
    
<?php get_footer(); ?>