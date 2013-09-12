/*-------------------------------------------------------------------------
    
    CityHub Project

    1.  Helper Functions
    2.  Plugin Initialization
    3.  Shortcode Specific
    4.  Header + Search
    5.  Page Specific
    6.  Cross Browser Fixes

-------------------------------------------------------------------------*/


(function ($) {

    "use strict";
    window.requestAnimFrame = (function(){
        return  window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            window.oRequestAnimationFrame      ||
            window.msRequestAnimationFrame     ||
            function(callback) {
                window.setTimeout(callback, 1000 / 60);
            };
    })();

    // Media Players Video - Youtube & Vimeo
    $(window).ready(function() {

        var vimeoPlayers = jQuery('.homepage-slider').find('iframe.vimeo_frame'), player;
        for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
            player = $f(vimeoPlayers[i]);
            player.addEvent('ready', ready);
        }

        function addEvent(element, eventName, callback) {
            if (element.addEventListener) {
                element.addEventListener(eventName, callback, false);
            } else {
                element.attachEvent(eventName, callback, false);
            }
        }

        function ready(player_id) {

            var froogaloop = $f(player_id);
            froogaloop.addEvent('play', function(id) {
                jQuery('.homepage-slider').flexslider('pause');
            });
//            froogaloop.addEvent('pause', function(id) {
//                jQuery('.homepage-slider').flexslider('play');
//            });
//            froogaloop.addEvent('finish', function(id) {
//                jQuery('.homepage-slider').flexslider('play');
//            });
        }

        function create_youtube_player(self){
            var this_player = new YT.Player(jQuery(self).attr('id'), {
                videoId: jQuery(self).data('ytid'),
                playerVars: { 'controls': 1, 'modestbranding': 1, 'showinfo': 0, 'html5': 1 },
                events: {

                    'onStateChange': function (event) {
                        if (event.data == YT.PlayerState.PLAYING ) {
                            // Pause Slider while Playing the Video
                            jQuery('.homepage-slider').flexslider("pause");
                        }
//                        if (event.data === YT.PlayerState.PAUSED ) {
//                            // Play Slider while Video is paused
//                            jQuery('.homepage-slider').flexslider("play");
//                        }
                    }
                }
            });
        }

        // function onYouTubeIframeAPIReady() {
            jQuery('.youtube_frame').each(function(){
                var self = this;
                create_youtube_player(self);
                jQuery(".slide-video").fitVids();
            });
        // }

        // MediaPlayerJS plugin for audio and video
        var media_elements = $('audio, video');
        if(media_elements.length) {
            media_elements.mediaelementplayer({
                videoWidth: '100%',
                videoHeight: '100%',
                audioWidth: '100%',
                features: ['playpause','progress','tracks','volume','fullscreen'],
                videoVolume: 'horizontal',
                enableAutosize: true,
                success: function(mediaElement, domObject){

                    var slider = $(domObject).parents('.homepage-slider');
                    if ( slider.length > 0 ) {
                        $(mediaElement).on('playing' , function(){
                            slider.flexslider('pause');
                        });

//                        $(mediaElement).on('pause' , function(){
//                            slider.flexslider('play');
//                        });
                    }
                }
            });
        }
    });

    var useTransform = true;
    var transform;
    var ua = navigator.userAgent;
    var winLoc = window.location.toString();

    var is_webkit = ua.match(/webkit/i);
    var is_firefox = ua.match(/gecko/i);
    var is_newer_ie = ua.match(/msie (9|([1-9][0-9]))/i);
    var is_older_ie = ua.match(/msie/i) && !is_newer_ie;
    var is_ancient_ie = ua.match(/msie 6/i);
    var is_mobile = ua.match(/mobile/i);
    var is_OSX = (ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false);

    var use2DTransform = (ua.match(/msie 9/i) || winLoc.match(/transform\=2d/i));
    var $elements, offset;
    var lastScroll = 0;
    var is_touch_device = !!('ontouchstart' in window) || !!('onmsgesturechange' in window); // works on ie10

    var isIE10 = false;
    /*@cc_on
        if (/^10/.test(@_jscript_version)) {
            isIE10 = true;
        }
    @*/

    var smoothScroll = $('html').attr('data-smooth-scroll');

    if (isIE10) {
        is_touch_device = false;
        $('html').addClass('ie10');
    }

    if (is_touch_device && !isIE10) {
        $('html').addClass('touch');
    }

    // setting up transform prefixes
    var prefixes = {
        webkit: 'webkitTransform',
        firefox: 'MozTransform',
        ie: 'msTransform',
        w3c: 'transform'
    };

    if (useTransform) {
        if (is_webkit) {
            transform = prefixes.webkit;
        } else if (is_firefox) {
            transform = prefixes.firefox;
        } else if (is_newer_ie) {
            transform = prefixes.ie;
        }
    }





/*-------------------------------------------------------------------------*/
/*  1.  Helper Functions
/*-------------------------------------------------------------------------*/

    $(document).ready(function() {

        $('html').removeClass('no-js').addClass('js');

        if (is_touch_device) {
            $('body').addClass('is_touch_device');
        }

        // nav open
        $('.nav-btn').on('click', function(e) {
            e.preventDefault();
            $('html').toggleClass('js-nav');
        });

    // Create a new menu item labeled "More" when too many menu items
    // var smallerMenu = function() {
    //     var menu = $('.site-mainmenu'),
    //         menuWidth = menu.outerWidth() - $('.site-branding').outerWidth() - $('.header_search-form').outerWidth(),
    //         widthSum = 0;


    //     menu.children().each(function() {
    //         widthSum = widthSum + $(this).width();
    //     });


    //     if (menuWidth > 200 && widthSum > menuWidth) {
    //         var more, moreSubMenu;
    //         if (!menu.find('#menu-item-more').length) {
    //             var more = $('<li id="menu-item-more" class="menu-item menu-parent-item menu-item-added menu-item-more"><a href="#">More</a></li>').appendTo(menu),
    //                 moreSubMenu = $('<ul class="sub-menu sub-menu-more"></ul>').appendTo(more);
    //             widthSum = widthSum + more.outerWidth();
    //         } else {
    //             more = $('#menu-item-more');
    //             moreSubMenu = more.children('ul');
    //         }

    //         while (widthSum > menuWidth) {
    //             var toMove = menu.children().not('.menu-item-added').last();
    //             widthSum = widthSum - toMove.outerWidth();
    //             toMove.prependTo(moreSubMenu);
    //         }
    //     }
    // };

    // $(window).on('resize', smallerMenu);
    // smallerMenu();

        // Make sub-menus fall to the left when out of space
        $('.site-navigation li').each(function() {
            var self = $(this),
                submenu = self.children('.sub-menu'),
                submenuWidth = submenu.children('li').outerWidth();

            if (submenu.length > 0) {
                if (submenu.offset().left + submenuWidth > $('body').outerWidth()) {
                    self.addClass('to-the-left');
                }
            }
        });
    });





/*-------------------------------------------------------------------------*/
/*  2.  Plugin Initialization 
/*-------------------------------------------------------------------------*/

    $(document).ready(function(){

        // ----- Smooth Scrolling Init ----- //
        function niceScrollInit() {
            $("html").niceScroll({
                zindex: 9999,
                cursoropacitymin: 0.8,
                cursorwidth: 7,
                cursorborder: 0,
                mousescrollstep: 60,
                scrollspeed: 80,
                cursorcolor: "#000000"
            });
        }
        
        if (smoothScroll == 'on' && $(window).width() > 680 && !is_touch_device && !is_OSX) {niceScrollInit();}

        // Prepare main navigation for hover effect
        $('.wrapper-header .site-mainmenu').children('li').children('a').each(function() {
            var self = $(this).wrapInner('<span>'),
                    span = self.children().wrapInner('<b>'),
                    b = span.children();
                    b.attr('data-hover', b.text());
        });

    });





/*-------------------------------------------------------------------------*/
/*  3.  Shortcode Specific
/*-------------------------------------------------------------------------*/

    $(document).ready(function(){   



        // ----- Testimonials --------------------------------------------- /

        if ($('.testimonials-slider').length) {
            $('.testimonials-slider').each(function() {
                var self = $(this),
                    slides = self.find('.slide'),
                    slidesNo = slides.length;

                if (slidesNo == 1) {
                    slides.addClass('flex-active-slide');
                } else {
                    self.flexslider({
                        animation: "fadecss",
                        directionNav: true,
                        controlNav: false,
                        prevText: '<',
                        nextText: '>',
                        slideshow:false,                            
                        initDelay: 5000
                    });
                }
            }); 
        }



        // ----- ProgressBar ---------------------------------------------- /

        function progressbar_shortcode(e) {
            e.each(function() {
                var self = $(this).find('.progressbar-progress');
                self.css({'width': self.data('value')});
            });
        }

        var progressbar_shc = $('.progressbar');
            progressbar_shc.addClass('is-visible');
        if (progressbar_shc.length) {
            progressbar_shortcode(progressbar_shc);
        }

    });





/*-------------------------------------------------------------------------*/
/*  4.  Header + Search
/*-------------------------------------------------------------------------*/   
;(function ($) {

    $(document).ready(function(){   
        $('.header-image').css("background-size", "cover");
    });

})(jQuery);





/*-------------------------------------------------------------------------*/
/*  5.  Page Specific
/*-------------------------------------------------------------------------*/   

    $(document).ready(function(){



        // ===== HOMEPAGE ================================================ //

        // ----- Slider --------------------------------------------------- /

        // check if arrows navigation is set to "thumbnail"
        if( $('.homepage-slider').attr('data-control_nav_thumb') == 'true' ) { $('.homepage-slider').addClass('control_nav_thumb') };



        // ----- CarouFredSel --------------------------------------------- /

        var viewportWidth = document.documentElement.clientWidth;
        if ($('#homepage-portfolio-items-list, .homepage-portfolio-items-list').length) {
            $('#homepage-portfolio-items-list, .homepage-portfolio-items-list').carouFredSel({
                infinite: true,
                responsive: true,
                direction: "left",
                height: 'variable',
                items: {
                    visible: function(){
                        if(viewportWidth < 640){
                            return 1;
                        }
                        else if(viewportWidth > 640 && viewportWidth < 1024){
                            return 2;
                        }
                        else return 3;
                    }
                },
                auto: {
                    play: false,
                    pauseOnHover: true,
                    timeoutDuration : 3000
                },
                prev: {
                    button: "#portfolio-works-previous"
                },
                next: {
                    button: "#portfolio-works-next"
                }
            });
        }



        // ===== CONTACT PAGE ================================================ //

        // Set textarea from contact page to autoresize
        if($("textarea").length) { $("textarea").autoresize(); }



        // ===== PORTFOLIO ARCHIVE =========================================== //

        // ----- Portfolio Page Isotope Plugin and Filtering Init ------------- /

        $(window).load(function(){
            var container = $('#portpage-portfolio-items-list');
            container.isotope({
                itemSelector: '.portfolio-item'
            });

            var $selectObject = $('.filter-by-text');

            $('.filter-by-container a').on('click', function(e){
                e.preventDefault();
                $('.filter-by_list').toggleClass('list-active');
            });

            $('.filter-by_list a').on('click', function(){
                var selector = $(this).attr('data-filter');
                $selectObject.html($(this).html());
                container.isotope({ filter: selector });
                return false;             
            });
        });



        // ===== PORTFOLIO SINGLE ============================================ //

        // ----- Attachments Slider ------------------------------------------- /

        $('.project-images-container').flexslider({
            animation: "fadecss",
            controlNav: false,
            directionNav: true,
            slideshow: false,
            prevText: '<i class="icon-chevron-left"></i>',
            nextText: '<i class="icon-chevron-right"></i>',
            initDelay: 5000,
            start: function(slider){
                var maxHeight = slider.find('.post-attachment').first().height('auto').height();

                // calculating smallest image height
                slider.find('.post-attachment').each(function() {
                    if ($(this).height('auto').height() < maxHeight) {
                        maxHeight = $(this).height();
                    }
                });

                // center images vertically based on the new set height
                slider.find('.post-attachment').each(function() {
                    $(this).css({
                        'position': 'relative',
                        'top': -1 * ($(this).height() - maxHeight)/2,
                        'left': 0
                    });
                });

                slider.find('.post-attachment').height(maxHeight);
                slider.animate({height: maxHeight}, 300);
                setTimeout(function() {
                    slider.removeClass('loading');
                }, 600);
            }
        }); 

    });





/*-------------------------------------------------------------------------*/
/*  6.  Cross Browser Fixes
/*-------------------------------------------------------------------------*/   


    $(document).ready(function(){

        function parallax() {
            var $container = $('.parallax-container'),
                    $parent = $container.parent(),
                    $elements = $container.find('.parallax-item');

            var height = $parent.height();
            $parent.height(height);
            $container.height(height).css('position', 'fixed');

            function refresh() {
                $elements.each(function(i, self) {
                    var transformParam, $element = $(self);
                    offset = -1 * lastScroll / 3;
                    if (!is_touch_device) {
                        if (!use2DTransform) {
                            transformParam = 'translate3d(0px,' + offset + 'px, 0px)';
                        } else {
                            transformParam = 'translateY(' + offset + 'px)';
                        }
                        if (transform && transformParam) {
                            $element.css(transform, transformParam);
                            $element.css(prefixes.w3c, transformParam);
                        } else {
                            $element.css('marginTop', offset + 'px');
                        }
                    }
                });
            }

            $(window).on('scroll', function(e) {
                lastScroll = $(document).scrollTop();
                requestAnimFrame(refresh);
            });
        }

        parallax();

        // Search Button
        var searchContainer = $('.site-navigation .header_search-form');
        var searchField = $('.site-navigation .header_search-form .field');
        var searchButton = $('.site-navigation .header_search-form .btn');

        searchField.on('blur', function() {
            setTimeout(function() {
                searchField.removeClass('is-visible');
                searchContainer.removeClass('is-active');
            }, 500);
        });

        searchButton.on('click', function(e, source) {
            if (source != 'searchform') {
                e.preventDefault();
                e.returnValue = false;
                if (searchField.hasClass('is-visible')) {
                    if (searchField.val().length != 0) {
                        searchButton.trigger('click', 'searchform');
                    } else {
                        searchField.removeClass('is-visible');
                        searchContainer.removeClass('is-active');
                    }
                } else {
                    searchField.addClass('is-visible').focus();
                    searchContainer.addClass('is-active');
                }
            return false;
            }
        });

        $('.widget-area .widget_wpgrade_twitter_widget').each(function() {
            var self = $(this),
                slides = self.find('.slide'),
                slidesNo = slides.length;

            if (slidesNo == 1) {
                slides.addClass('flex-active-slide');
            } else {
                self.flexslider({
                    animation: "fadecss",
                    directionNav: false,
                    controlNav: true,
                    prevText: '<i class="icon-chevron-left"></i>',
                    nextText: '<i class="icon-chevron-right"></i>',                             
                    initDelay: 5000
                });
            }
        });     

        $('.sidebar-footer-container').find('.wp-slider').each(function() {
            var self = $(this);

            self.flexslider({
                animation: "fadecss",
                controlNav: true,
                directionNav: true,
                prevText: '<i class="icon-chevron-left"></i>',
                nextText: '<i class="icon-chevron-right"></i>',
                slideshow: false,
                controlsContainer: self.find('.wp-slider')
            });
        });

        /***************** Frontpage Slider ******************/

        var sliderWrapper = $('.homepage-slider'),
                slidesNo = $('.homepage-slider .slides').children().length,
                currentSlideNo = $('.homepage-slider .slides .flex-active-slide').index(),

                //Direction Nav Arrows Containers
                direction_nav_container = $('.flex-direction-nav'),
                direction_nav_next = direction_nav_container.find('.flex-next'),
                direction_nav_prev = direction_nav_container.find('.flex-prev');

        // Apply Thumbnail Images to Arrows
        function apply_arrow_thumbs(currentSlide) {
            // Get next & previous slider number
            var next_slide_no = currentSlide+1; if(currentSlide == 0) prev_slide_no = slidesNo-1;
            var prev_slide_no = currentSlide-1; if(currentSlide == slidesNo-1) next_slide_no = 0;
            
            // Get next & prev thumbnails src from sliders background image
            var next_slide_img = $('.homepage-slider .slides .slide').eq(next_slide_no).find('.header-image').attr('data-thumb');
            var prev_slide_img = $('.homepage-slider .slides .slide').eq(prev_slide_no).find('.header-image').attr('data-thumb');

            // Apply new thumbnails background
            direction_nav_prev.find('.slide-thumb-img').css('background-image', prev_slide_img);
            direction_nav_next.find('.slide-thumb-img').css('background-image', next_slide_img);
        }

        //One Slide Case - add flex-active-slide class
        if(sliderWrapper.length) {
            sliderWrapper.each( function(index) {
                if (($(this).find('.slides').children().length) == 1) {
                    $(this).find('.slide').addClass('flex-active-slide');
                }
            });
        }

        function frontpage_slider() {
            var self = sliderWrapper,
                slides = self.find('.slide'),
                slidesNo = slides.length,
                slideshowSpeed = 6000,
                animationSpeed = 1000,
                directionNav = true;

            if ( typeof self.data('slideshow_speed' ) !== "undefined" ) {
                slideshowSpeed = self.data('slideshow_speed');
            }

            if ( typeof self.data('animation_speed' ) !== "undefined" ) {
                animationSpeed = self.data('animation_speed');
            }

            if ( typeof self.data('direction_nav' ) !== "undefined" ) {
                directionNav = self.data('direction_nav');
            }

            if (slidesNo == 1) {
                slides.addClass('flex-active-slide');
                self.removeClass('loading');
                // calculating smallest image height
                $(window).on('resize', function() {
                    self.css({'min-height':'0'});
                    self.height('auto');
                    self.width('100%');
                    self.find('.slide').height('auto');
                    self.find('.slides').height(self.find('.slide').outerHeight());
                });
                $(window).trigger('resize');
            } else {
                self.flexslider({
                    animation: "fadecss",
                    controlNav: false,
                    directionNav: false,
                    controlsContainer: ".slider-front-page",
                    manualControls: ".slider-control-nav li",
                    useCSS: false,
                    smoothHeight: true,
                    slideshowSpeed: slideshowSpeed,
                    animationSpeed: animationSpeed,
                    video: true,
                    pauseOnHover: false,
                    pauseOnAction: true,
                    slideshow: true,
                    prevText: "",
                    nextText: "",
                    startAt: 0,
                    before: function(slider){
                        // when we change a slide we need to stop the playing video
                        var vimeo_frame = slider.slides.eq(slider.currentSlide).find('iframe.vimeo_frame'),
                            youtube = slider.slides.eq(slider.currentSlide).find('.youtube_frame'),
                            mejs_container = slider.slides.eq(slider.currentSlide).find('.mejs-container');

                        if (youtube.length !== 0){
                            youtube[0].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*');
                        }
                        if (vimeo_frame.length !== 0){
                            $f(  vimeo_frame.attr('id') ).api('pause');
                        }
                        if (mejs_container.length !== 0) {
                            $(mejs_container).find('video')[0].pause();
                        }

                        $(window).trigger('resize focus');
                        self.css({'min-height':'0'});

                        currentSlideNo = slider.animatingTo;

	                    if ( directionNav ) {
	                        // Change thumbnails from arrows
	                        apply_arrow_thumbs(currentSlideNo);
	                    }
                    },
                    after: function(slider) {

                    },
                    start: function(slider) {
                        if (!slider.slides) {return;}

                        // Add Functionality to The New Prev/ Next Arrows Markup
                        direction_nav_next.click(function(e) {
                            e.preventDefault();
                            slider.flexAnimate(slider.getTarget("next"));
                            slider.pause();
                        });
                        direction_nav_prev.click(function(e) {
                            e.preventDefault();
                            slider.flexAnimate(slider.getTarget("prev"));
                            slider.pause();
                        });

                        // Initialization of thumbnails from nav arrows
	                    if ( directionNav ) {
                            apply_arrow_thumbs(0);
	                    }

                        var slideHeight = slider.find('.slide').first().height();

                        // calculating smallest image height
                        $(window).on('resize', function() {

                            slider.find('.slide').height('auto');
                            if (slider.data('fullscreen') && $(window).width() > 1023) {
                                slideHeight = $(window).height();
                            } else if (slider.data('height')) {
                                slideHeight = slider.data('height');
                            } else {
                                slider.find('.slide').each(function() {
                                    if ($(this).height() > slideHeight) {
                                        slideHeight = $(this).height();
                                    }
                                });
                            }

                            slider.find('.slide').each(function() {
                                var $slide = $(this),
                                    $image = $slide.children('img').width('auto').height('auto'),
                                    imageHeight = $image.height(),
                                    imageWidth = $image.width(),
                                    slideWidth = $(window).width(),
                                    imageRatio = imageWidth / imageHeight,
                                    slideRatio = slideWidth / slideHeight;

                                    $slide.height(slideHeight);

                                if (slideRatio > imageRatio) {
                                    // landscape
                                    $image.css({
                                        'width': '100%',
                                        'height': slideWidth / imageRatio
                                    });
                                } else {
                                    // portrait
                                    $image.css({
                                        'width': slideHeight * imageRatio,
                                        'height': slideHeight
                                    });
                                }

                                imageWidth = $image.width();
                                imageHeight = $image.height();

                                // horizontal centering
                                if (imageWidth > slideWidth) {
                                    $image.css({'left': (slideWidth - imageWidth) / 2});
                                } else {
                                    $image.css({'left': 0});
                                }

                                // vertical centering
                                if (imageHeight > slideHeight) {
                                    $image.css({'top': (slideHeight - imageHeight) / 2});
                                } else {
                                    $image.css({'top': 0});
                                }

                            });
                            slider.height(slideHeight);
                        });
                        $(window).trigger('resize');
                        slider.removeClass('loading');
                    }
                });
            }
        }

        frontpage_slider();

        //Gallery Post Format Slider
        var gallery_format = $('.wrapper-featured-image .gallery, .gallery-blog-container .gallery');
        function gallery_format_slideshow(gallery_format) {
            // create the specific markup for flexslider
            gallery_format.addClass('slides');
            gallery_format.find('.gallery-item').addClass('slide');
            gallery_format.find('.gallery > br').remove();

            $('.gallery_format_slider').flexslider({
                animation: "fadecss",
                selector: ".gallery > dl",
                useCSS: false,
                controlNav: false,
                directionNav: true,
                prevText: '<i class="icon-chevron-left"></i>',
                nextText: '<i class="icon-chevron-right"></i>',
                keyboard: false,
                slideshow: false,
                smoothHeight: true,
                start: function(slider){
                    var maxHeight = 9999;

                    function imageLoaded() {
                       // function to invoke for loaded image
                       // decrement the counter
                       counter--;
                       if( counter === 0 ) {
                            // calculating smallest image height
                            slider.find('.slide').each(function() {
                                if ($(this).height('auto').height() < maxHeight) {
                                    maxHeight = $(this).height();
                                }
                            });

                            // center images vertically based on the new set height
                            slider.find('.slide').each(function() {
                                $(this).css({
                                    'position': 'relative',
                                    'top': -1 * ($(this).height() - maxHeight)/2,
                                    'left': 0
                                });
                            });

                            slider.find('.slide').height(maxHeight);
                            slider.animate({height: maxHeight}, 300);
                            setTimeout(function() {
                                slider.removeClass('loading');
                            }, 600);
                       }
                    }
                    var images = slider.find('img');
                    var counter = images.length;  // initialize the counter

                    images.each(function() {
                        if( this.complete ) {
                            imageLoaded.call( this );
                        } else {
                            $(this).one('load', imageLoaded);
                        }
                    });
                }
            });
        }

        if(gallery_format.length) { gallery_format_slideshow(gallery_format); }

        // Scroll Monitor plugin ----------------------------------------------
        jQuery.fn.scroll_animate = function() {
            var self = this;
            this.addClass('s-monitor s-hidden');
            if(this.length) {
                var watcher = scrollMonitor.create( this, -0 );
                watcher.enterViewport(function() {
                    jQuery.each(self, function(i, e) {
                        setTimeout(function() {
                            jQuery(e).removeClass('s-hidden').addClass('s-visible');
                        }, 125*i);
                    });
                });
            } 
        };

        // Smaller Header on Scroll -------------------------------------------
        var header = $('.wrapper-header-small'),
            didScroll = false,
            changeHeaderOn = 350,
            timer;

        function scrollPage() {
            var sy = $(document).scrollTop();
            if (sy >= changeHeaderOn) {
                header.addClass('is-visible');
            } else {
                header.removeClass('is-visible');
            }
            didScroll = false;
        }

        $(window).scroll(function() {
            if(!didScroll) {
                didScroll = true;
                setTimeout(scrollPage, 250);
            }
        });

        // Magnific Pop-up for Projects
        function project_page_popup(e) {
            if (jQuery().magnificPopup) {
                e.magnificPopup({
                    type: 'image',
                    image: { titleSrc: '' },
                    gallery: { enabled:true },
                    removalDelay: 300,
                    mainClass: 'pxg-slide-bottom',
                    fixedContentPos: false,
                    callbacks: {
                        beforeOpen: function() {
                            if (smoothScroll == 'on' && $(window).width() > 680 && !is_touch_device && !is_OSX) {this.scrollbarSize = 0;}
                        }
                    }
                });
            }
        }

        var project_single_gallery = $('.portfolio-rows a.popup');
        if(project_single_gallery.length) { project_page_popup(project_single_gallery); }

        // Magnific Pop-up for Gallery Post Format

        var post_format_gallery = $('.gallery_format_slider .gallery-icon a');
        if(post_format_gallery.length) { project_page_popup(post_format_gallery); }

        //Magnific Popup for any other <a> tag that link to an image in single posts and pages
        function blog_posts_popup(e) {
            if (jQuery().magnificPopup) {
                e.magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    closeBtnInside: false,
                    removalDelay: 300,
                    mainClass: 'pxg-slide-bottom',
                    image: { verticalFit: true },
                    fixedContentPos: false,
                    callbacks: {
                        beforeOpen: function() {
                            if (smoothScroll == 'on' && $(window).width() > 680 && !is_touch_device && !is_OSX) {this.scrollbarSize = 0;}
                        }
                    }
                });
            }
        }

        var blog_posts_images = $('.single .post a[href$=".jpg"], .single .post a[href$=".png"], .page a[href$=".jpg"], .page a[href$=".png"]');
        if(blog_posts_images.length) { blog_posts_popup(blog_posts_images); }
        
        // Find all videos
        var $allVideos = $(".video-wrap iframe");

        // Figure out and save aspect ratio for each video
        $allVideos.each(function() {
            $(this)
                .data('aspectRatio', this.width / this.height)

                // and remove the hard coded width/height
                .removeAttr('height')
                .removeAttr('width');

        });

        //resize the videos to fit the containter width
        $('body').resizeVideos();

        // Responsive menus
        var smallNav = $('.wrapper-header-small .site-navigation');
        // if (is_touch_device) {
            smallNav.find('li.menu-parent-item > a').on('click', function(e) {
                if ($(this).width() - e.pageX < 40 && $('html').hasClass('js-nav')) {
                    e.preventDefault();
                    $(this).parent().siblings().removeClass('active');
                    $(this).parent().toggleClass('active');
                }
            });
        // }

        var timer;
        $(window).on('resize', function() {
            clearTimeout(timer);
            timer = setTimeout(function() {
                if ($(window).width() < 1024) {             
                    $('.tab-titles-list-item').each(function() {
                        var toggle = $(this),
                            target = $(toggle.children().attr('href'));
                        toggle.insertBefore(target);
                    });
                } else {
                    $('.tab-titles-list-item').each(function() {
                        var toggle = $(this),
                            target = $(toggle.children().attr('href'));
                        toggle.appendTo(toggle.data('source'));
                    });
                }
            }, 300);
        });

        $(window).trigger('resize');
    });
    
    // Resize videos
    $.fn.resizeVideos = function() {
        var theVideos = this.find('.video-wrap iframe, video');
        theVideos.each(function() {
            var theVideo = $(this),
                ratio = theVideo.data('aspectRatio'),
                newWidth = theVideo.css('width', '100%').width(),
                newHeight = newWidth/ratio;
            theVideo.height(newHeight);
        });
    };
    $('body').resizeVideos();
    
    // recalculate the videos width and height on window resize
    $(window).resize(function(){
        $('body').resizeVideos();
    });
    

})(jQuery);