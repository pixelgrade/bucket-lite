<?php
    $html_title = get_post_meta(get_the_ID(), wpgrade::prefix().'post_html_title', true);
    $audio_embed = get_post_meta($post->ID, wpgrade::prefix().'audio_embed', true)
?>
<?php
    $video_embed = get_post_meta($post->ID, wpgrade::prefix().'video_embed', true);
?>
<div class="article-timestamp">
    <div class="article-timestamp__date"><?php the_time('j'); ?></div>
    <div class="article-timestamp__right-box">
        <span class="article-timestamp__month"><?php the_time('M'); ?></span>
        <span class="article-timestamp__year"><?php the_time('Y'); ?></span>
    </div>
</div><!-- .article-timestamp -->

<h2 class="entry__title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h2>
<?php
    if ( has_post_thumbnail() ) {
        echo '<div class="entry__featured-image">';
        the_post_thumbnail();
        echo '</div>';
    } else if ( ! empty($video_embed)) { ?>
    <div class="featured-image-wrapper">
        <div class="featured-image-container">
            <div class="page-header-video">
                <div class="video-wrap">
                    <?php echo stripslashes(htmlspecialchars_decode($video_embed)) ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>