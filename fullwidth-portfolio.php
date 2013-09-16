<?php get_header(); ?>

            <div class="featured-image">
                <div id='gallery-1' class='gallery galleryid-143 gallery-columns-3 royalSlider js-gallery'>
                    <dl class='gallery-item'>
                        <dt class='gallery-icon landscape'>
                            <img src="http://192.168.1.104/prism-html/img/gallery/gallery-1.jpg" class="attachment-blog-big rsImg" alt="hr10_sample_image_02" />
                        </dt>
                    </dl>
                    <dl class='gallery-item'>
                        <dt class='gallery-icon landscape'>
                            <img src="http://192.168.1.104/prism-html/img/gallery/gallery-2.jpg" class="attachment-blog-big rsImg" alt="hr10_sample_image_02" />
                        </dt>
                    </dl>
                    <dl class='gallery-item'>
                        <dt class='gallery-icon landscape'>
                            <img src="http://192.168.1.104/prism-html/img/gallery/gallery-3.jpg" class="attachment-blog-big rsImg" alt="hr10_sample_image_02" />
                        </dt>
                    </dl>
                </div>
                <div class="gallery-control gallery-control--gallery-fullscreen">
                    <ul class="gallery-control__items">
                        <li class="gallery-control__item gallery-control__arrow">
                            <a href="#" class="gallery-control__arrow-button arrow-button-left js-slider-arrow-prev"></a>
                        </li><!--
                        --><li class="gallery-control__item gallery-control__count">
                            <span class="gallery-control__count-current js-gallery-current-slide"><span class="highlighted js-decimal">0</span><span class="js-unit">1</span></span>    
                        </li><!--
                        --><li class="gallery-control__item gallery-control__count">
                            <sup class="gallery-control__count-total js-gallery-slides-total">03</sup>    
                        </li><!--
                        --><li class="gallery-control__item gallery-control__arrow">
                            <a href="#" class="gallery-control__arrow-button arrow-button-right js-slider-arrow-next"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="page-content">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="row">
                        <div class="col-4">
                            <header class="entry__header">
                                <h1 class="entry__title"><?php the_title(); ?></h1>
                                <div class="entry__meta entry__meta--project cf">
                                    <div class="entry__meta-box meta-box--client">
                                        <span class="meta-box__box-title">Client: </span>
                                        <a href="http://localhost/prism/?cat=2" title="View all posts in Ideas" rel="category">Yale House of Style</a>
                                    </div>  
                                    <div class="entry__meta-box meta-box--categories">
                                        <span class="meta-box__box-title">Filled under: </span>
                                        <?php foreach ($categories as $cat): ?>
                                                <a href="<?php echo get_category_link($cat); ?>"
                                                   rel="category">
                                                    <?php echo get_category($cat)->name; ?>
                                                </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </header><!-- .entry-header -->
                        </div>
                        <div class="col-8 gutter--double">
                            <div class="entry__content project-entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry__content -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <hr class="separator separator--full-left"/>
                        </div>
                        <div class="col-8 gutter--double">
                            <hr class="separator"/>
                        </div>
                    </div>

                    <footer class="entry__meta cf">
                       <div class="likes-box likes-box--footer">
                            <i class="icon-heart"></i>
                            <div class="likes-text">
                                <span class="likes-count">3</span> likes
                            </div>
                        </div>                                
                        <div class="social-links">
                            <span class="social-links__message">Share: </span>
                            <ul class="social-links__list">
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-google-plus"></i></a></li>
                                <li><a href="#"><i class="icon-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </footer><!-- .entry-meta -->
                </article><!-- #post -->
                <?php 
                    yarpp_related(array(
                        'threshold' => 0,
                        'post_type' => array('portfolio')
                    )); 
                ?>                          
            </div><!-- #page-content -->