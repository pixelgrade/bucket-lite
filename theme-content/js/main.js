// /* ====== SHARED VARS ====== */

var phone, touch, ltie9, lteie9, wh, ww, dh, ar, fonts;

var ua = navigator.userAgent;
var winLoc = window.location.toString();

var is_webkit = ua.match(/webkit/i);
var is_firefox = ua.match(/gecko/i);
var is_newer_ie = typeof(is_ie) !== "undefined" || (!(window.ActiveXObject) && "ActiveXObject" in window);
var is_older_ie = ua.match(/msie/i) && !is_newer_ie;
var is_ancient_ie = ua.match(/msie 6/i);
var is_mobile = ua.match(/mobile/i);
var is_OSX = (ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false);

var nua = navigator.userAgent;
var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));

var useTransform = true;
var use2DTransform = (ua.match(/msie 9/i) || winLoc.match(/transform\=2d/i));
var transform;

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

if (is_newer_ie) jQuery('html').addClass('is--ie');
(function($, window, undefined) {

    /* --- DETECT VIEWPORT SIZE --- */

    function browserSize() {
        wh = $(window).height();
        ww = $(window).width();
        dh = $(document).height();
        ar = ww / wh;
    }


    /* --- DETECT PLATFORM --- */

    function platformDetect() {
        $.support.touch = 'ontouchend' in document;
        var navUA = navigator.userAgent.toLowerCase(),
            navPlat = navigator.platform.toLowerCase();

        var isiPhone = navPlat.indexOf("iphone"),
            isiPod = navPlat.indexOf("ipod"),
            isAndroidPhone = navPlat.indexOf("android"),
            safari = (navUA.indexOf('safari') != -1 && navUA.indexOf('chrome') == -1) ? true : false,
            svgSupport = (window.SVGAngle) ? true : false,
            svgSupportAlt = (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) ? true : false,
            ff3x = (/gecko/i.test(navUA) && /rv:1.9/i.test(navUA)) ? true : false;

        phone = (isiPhone > -1 || isiPod > -1 || isAndroidPhone > -1) ? true : false;
        touch = $.support.touch ? true : false;
        ltie9 = $.support.leadingWhitespace ? false : true;
        lteie9 = typeof window.atob === 'undefined' ? true : false;

        var $bod = $('body');

        if (touch) {
            $bod.addClass('touch');
        }
        if (safari) $bod.addClass('safari');
        if (phone) $bod.addClass('phone');
    };
    /* --- Magnific Popup Initialization --- */

    function magnificPopupInit() {

        $('.js-post-gallery').each(function() { // the containers for all your galleries should have the class gallery
            $(this).magnificPopup({
                delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', // the container for each your gallery items
                type: 'image',
                removalDelay: 500,
                mainClass: 'mfp-fade',
                image: {
                    titleSrc: function(item) {
                        var output = '';
                        if (typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
                            output = item.el.attr('data-title');
                        }
                        if (typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
                            output += '<small>' + item.el.attr('data-alt') + '</small>';
                        }
                        return output;
                    }
                },
                gallery: {
                    enabled: true,
                    navigateByImgClick: true
                }
            });
        });
    }
    /* RILOADR INIT */

    var Riload = (function() {

        var initialized = false,
            riloadrImages,
            riloadrSingle;

        function init() {

            // Lazy loading for images with '.lazy' class
            riloadrImages = new Riloadr({
                name: 'lazy',
                breakpoints: [{
                    name: 'whatever',
                    minWidth: 1
                }],
                defer: {
                    mode: 'load'
                }
            });

            // Responsive Featured Image for single post page
            riloadrSingle = new Riloadr({
                name: 'riloadr-single',
                breakpoints: [{
                    name: 'small',
                    maxWidth: 400
                }, {
                    name: 'big',
                    minWidth: 401
                }],
                watchViewportWidth: "*"
            });

            initialized = true;
        }

        function refresh() {
            if (!initialized) {
                return;
            }
            riloadrImages.riload();
            riloadrSingle.riload();
        }

        return {
            init: init,
            refresh: refresh
        }

    })();

    /* --- Royal Slider Init --- */

    var $original_billboard_slider;

    /*
     * Slider Initialization
     */
    function sliderInit($slider) {

        $slider.find('img').removeClass('invisible');

        var $children = $(this).children(),
            rs_arrows = typeof $slider.data('arrows') !== "undefined",
            rs_bullets = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
            rs_autoheight = typeof $slider.data('autoheight') !== "undefined",
            rs_autoScaleSlider = false,
            rs_autoScaleSliderWidth = $slider.data('autoscalesliderwidth'),
            rs_autoScaleSliderHeight = $slider.data('autoscalesliderheight'),
            rs_customArrows = typeof $slider.data('customarrows') !== "undefined",
            rs_slidesSpacing = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
            rs_keyboardNav = typeof $slider.data('fullscreen') !== "undefined",
            rs_imageScale = $slider.data('imagescale'),
            rs_visibleNearby = typeof $slider.data('visiblenearby') !== "undefined" ? true : false,
            rs_imageAlignCenter = typeof $slider.data('imagealigncenter') !== "undefined",
            rs_transition = typeof $slider.data('slidertransition') !== "undefined" && $slider.data('slidertransition') != '' ? $slider.data('slidertransition') : 'move',
            rs_autoPlay = typeof $slider.data('sliderautoplay') !== "undefined" ? true : false,
            rs_delay = typeof $slider.data('sliderdelay') !== "undefined" && $slider.data('sliderdelay') != '' ? $slider.data('sliderdelay') : '1000',
            rs_drag = true,
            rs_globalCaption = typeof $slider.data('showcaptions') !== "undefined" ? true : false;

        if (rs_autoheight) {
            rs_autoScaleSlider = false
        } else {
            rs_autoScaleSlider = true
        }

        // Single slide case
        if ($children.length == 1) {
            rs_arrows = false;
            rs_bullets = 'none';
            rs_customArrows = false;
            rs_keyboardNav = false;
            rs_drag = false;
            rs_transition = 'fade';
        }

        // make sure default arrows won't appear if customArrows is set
        if (rs_customArrows) arrows = false;

        //the main params for Royal Slider
        var royalSliderParams = {
            autoHeight: rs_autoheight,
            autoScaleSlider: rs_autoScaleSlider,
            loop: true,
            autoScaleSliderWidth: rs_autoScaleSliderWidth,
            autoScaleSliderHeight: rs_autoScaleSliderHeight,
            imageScaleMode: rs_imageScale,
            imageAlignCenter: rs_imageAlignCenter,
            slidesSpacing: rs_slidesSpacing,
            arrowsNav: rs_arrows,
            controlNavigation: rs_bullets,
            keyboardNavEnabled: rs_keyboardNav,
            arrowsNavAutoHide: false,
            sliderDrag: rs_drag,
            transitionType: rs_transition,
            autoPlay: {
                enabled: rs_autoPlay,
                stopAtAction: true,
                pauseOnHover: true,
                delay: rs_delay
            },
            numImagesToPreload: 10,
            globalCaption: rs_globalCaption
        };

        if (rs_visibleNearby) {
            royalSliderParams['visibleNearby'] = {
                enabled: true,
                //centerArea: 0.8,
                center: true,
                breakpoint: 0,
                //breakpointCenterArea: 0.64,
                navigateByCenterClick: false
            }
        }

        //lets fire it up
        $slider.royalSlider(royalSliderParams);
        $slider.addClass('slider--loaded');

        var royalSlider = $slider.data('royalSlider');
        var slidesNumber = royalSlider.numSlides;

        // move arrows outside rsOverflow
        $slider.find('.rsArrow').appendTo($slider);

        royalSlider.ev.on('rsVideoPlay', function() {
            if (rs_imageScale == 'fill') {
                var $frameHolder = $('.rsVideoFrameHolder');
                var top = Math.abs(royalSlider.height - $frameHolder.closest('.rsVideoContainer').height()) / 2;

                $frameHolder.height(royalSlider.height);
                $frameHolder.css('margin-top', top + 'px');

            } else {
                var $frameHolder = $('.rsVideoFrameHolder');
                var $videoContainer = $('.rsVideoFrameHolder').closest('.rsVideoContainer');
                var top = parseInt($frameHolder.closest('.rsVideoContainer').css('margin-top'), 10);

                if (top < 0) {
                    top = Math.abs(top);
                    $frameHolder
                        .height(royalSlider.height)
                        .css('top', top + 'px');
                }
            }
        });

        royalSlider.ev.on('rsAfterSlideChange', function() {
            Riload.refresh();
        });

        $slider.addClass('slider--loaded');
    }



    /*
     * Wordpress Galleries to Sliders
     * Create the markup for the slider from the gallery shortcode
     * take all the images and insert them in the .gallery <div>
     */
    function sliderMarkupGallery($gallery) {
        var $old_gallery = $gallery,
            gallery_data = $gallery.data(),
            $images = $old_gallery.find('img'),
            $new_gallery = $('<div class="pixslider js-pixslider">');

        $images.prependTo($new_gallery).addClass('rsImg');
        $old_gallery.replaceWith($new_gallery);

        $new_gallery.data(gallery_data);
    }

    function sliderUpdateSize($slider) {
        var $sliderObj = $slider.data('royalSlider');

        $sliderObj.updateSliderSize(true);
    }


    /*
     * Change the Slider markup from (1 big / 2 small) to (3 big)
     * ORIGINAL to MOBILE
     */
    function sliderMarkupMobile($slider) {
        var $parent = $slider;

        // Change markup to default
        $slider.replaceWith($original_billboard_slider);
        $slider = $('.billboard.js-pixslider');

        // Change parameters
        $slider.attr('data-autoheight', true);
        $slider.attr('data-imagescale', 'none');

        $slider.find('.billboard--article-group').each(function() {
            // var $slide = $(this),
            // $slide_thumb = $slide.find('.article--billboard-small img');

            // // For each slide thumb(because there are two)
            // // we set the new image source
            // $slide_thumb.each(function(){
            //     slide_thumb_big_src = $(this).attr('data-src-big');
            //     $(this).attr('src', slide_thumb_big_src);
            // });

            // Change thumbnail for small articles
            $(this).children('.article').removeClass('rsABlock');

            $(this).before($(this).html())
                .remove();
        });

        // Mark as mobile
        $slider.addClass('js-pixslider-mobile');

        $slider.addClass('rsAutoHeight');

        sliderInit($slider);
    }



    /*
     * Change the Slider Markup from (3 big) to (1 big / 2 small)
     * MOBILE to ORIGINAL
     */
    function sliderMarkupOriginal($slider) {

        // Change markup
        $slider.replaceWith($original_billboard_slider);
        $slider = $('.billboard.js-pixslider');

        // Change parameters
        $slider.removeAttr('data-autoheight');
        $slider.removeAttr('imagescale');

        $slider.removeClass('js-pixslider-mobile');
        $slider.removeClass('rsAutoHeight');

        sliderInit($slider);
    }



    /*
     * Billboard Slider markup changes (on resize)
     */
    function slider_billboard() {
        var window_size = $(window).width();

        $('.js-pixslider.billboard').each(function() {
            $slider = $(this);
            var slider_rs = $slider.data('royalSlider');

            if ((window_size < 900) && (!$slider.hasClass('js-pixslider-mobile'))) {
                if (slider_rs) slider_rs.destroy();
                sliderMarkupMobile($slider);
            } else if ((window_size > 900) && ($slider.hasClass('js-pixslider-mobile'))) {
                if (slider_rs) slider_rs.destroy();
                sliderMarkupOriginal($slider);
            }
        });

        // riloadrSlider.riload();
    }



    /*
     * First Slider Initialization
     */

    function royalSliderInit() {
        // Transform Wordpress Galleries to Sliders
        $('.wp-gallery').each(function() {
            sliderMarkupGallery($(this));
        });

        // Find and initialize each slider
        $('.js-pixslider').each(function() {
            if (!$(this).hasClass('billboard'))
                sliderInit($(this));
        });
    };

    var royalSliderBillboardInitiated = false;

    function royalSliderBillboardInit() {
        royalSliderBillboardInitiated = true;

        $('.js-pixslider.billboard').each(function() {
            // Cache The Original Billboard Slider HTML Markup
            $original_billboard_slider = $(this).outerHTML();
            slider_billboard($(this));

            var height = $(this).find('img').first().height();

            sliderInit($(this));


        });
    }
    /* ====== INTERNAL FUNCTIONS ====== */

    /* --- Set Query Parameter--- */
    function setQueryParameter(uri, key, value) {
        var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
        separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }


    /* --- $VIDEOS --- */

    function initVideos() {

        var videos = $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"], video');

        // Figure out and save aspect ratio for each video
        videos.each(function() {
            if (this.width != 0 && this.height != 0) {
                $(this).data('aspectRatio', this.width / this.height)
                    // and remove the hard coded width/height
                    .removeAttr('height')
                    .removeAttr('width');
            } else { // for the conflict with jetpack set an default aspect ration of 16/9
                $(this).data('aspectRatio', 16 / 9)
                    .removeAttr('height')
                    .removeAttr('width');
            }
        });

        resizeVideos();

        // Firefox Opacity Video Hack
        $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
            var url = $(this).attr("src");

            $(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
        });
    }


    function stickyHeader() {
        if ($('body').hasClass('sticky-nav')) {
            var sticky = $('.js-sticky');
            var offset = sticky.offset();
            var stickyHeight = sticky.height();

            sticky.parent().height(stickyHeight);
            sticky.parent().css('margin-bottom', '24px');

            $(window).scroll(function() {

                if ($(window).scrollTop() > offset.top) {
                    sticky.addClass('sticky');
                } else {
                    sticky.removeClass('sticky');
                }

            });
        }
    }

    function footerWidgetsTitles() {
        $('.widget--footer__title .hN, .panel__title  .hN').each(function() {
            var $title = $(this),
                text = $title.text(),
                index = text.indexOf(" ");
            if (index != -1) {
                text = '<em>' + text.slice(0, index) + '</em>' + text.slice(text.indexOf(" "), text.length);
            } else {
                text = '<em>' + text + '</em>';
            }
            $title.html(text);
        });
    }



    function popularPostsWidget() {
        $('.wpgrade_popular_posts, .pixcode--tabs').organicTabs();
    }

    //scan through the post meta tags and try to find the post image
    function getArticleImage() {
        var metas = document.getElementsByTagName('meta');

        for (i = 0; i < metas.length; i++) {
            if (metas[i].getAttribute("property") == "og:image") {
                return metas[i].getAttribute("content");
            } else if (metas[i].getAttribute("property") == "image") {
                return metas[i].getAttribute("content");
            } else if (metas[i].getAttribute("property") == "twitter:image:src") {
                return metas[i].getAttribute("content");
            }
        }

        return "";
    }

    // Mega-Menu Hover with delay
    function megaMenusHover() {
        $('.nav--main > li').hoverIntent({
            interval: 100,
            timeout: 300,
            over: showMegaMenu,
            out: hideMegaMenu,
        })

        function showMegaMenu() {
            var self = $(this);
            self.removeClass('hidden');
            setTimeout(function() {
                self.addClass('open');
            }, 50);
        }

        function hideMegaMenu() {
            var self = $(this);
            self.removeClass('open');
            setTimeout(function() {
                self.addClass('hidden');
            }, 150);
        }
    }


    /* ====== INITIALIZE ====== */

    function init() {

        /* GLOBAL VARS */
        touch = false;

        /* GET BROWSER DIMENSIONS */
        browserSize();

        /* DETECT PLATFORM */
        platformDetect();

        /* Overthrow Polyfill */
        overthrow.set();

        FastClick.attach(document.body);

        if (is_android) {
            $('html').addClass('android-browser');
        } else {
            $('html').addClass('no-android-browser');
        }

        /* Retina Logo */
        var is_retina = (window.retina || window.devicePixelRatio > 1);

        if (is_retina && $('.site-logo--image-2x').length) {
            var image = $('.site-logo--image-2x').find('img');

            if (image.data('logo2x') !== undefined && image.data('logo2x').length) {
                image.attr('src', image.data('logo2x'));
                image.addClass('has--2x-image');
            }
        }

        /* Mega Menu */
        megaMenusHover();

        /* ONE TIME EVENT HANDLERS */
        eventHandlersOnce();

        /* INSTANTIATE EVENT HANDLERS */
        eventHandlers();

        /* INSTANTIATE RILOADR (lazy loading and responsive images) */
        Riload.init();

        if ($('body').hasClass('custom-background')) {
            if ($('body').css('background-repeat') == 'no-repeat') {
                $('body').addClass('background-cover');
            }
        }

    };





    /* ====== CONDITIONAL LOADING ====== */

    function loadUp() {

        initVideos();
        footerWidgetsTitles();

        //Set textareas to autosize
        if ($("textarea").length) {
            $("textarea").autosize();
        }

        // if blog archive
        if ($('.masonry').length && !lteie9 && !is_android)
            salvattore();

        //lets test first if we have some riloadr images to work on
        if ($('.riloadr-slider').length > 0) {
            var riloadrSlider = new Riloadr({
                name: 'riloadr-slider',
                breakpoints: [{
                        name: 'small' /*post-medium */ ,
                        minWidth: 901
                    },
                    {
                        name: 'big' /*post-medium */ ,
                        maxWidth: 900
                    }
                ],
                watchViewportWidth: "*",
                oncomplete: function() {
                    if (royalSliderBillboardInitiated == false)
                        royalSliderBillboardInit();
                }
            });
        } else {
            //we may as well initiate the billboard slider
            if (royalSliderBillboardInitiated == false)
                royalSliderBillboardInit();
        };

        royalSliderInit();
        magnificPopupInit();

        stickyHeader();
    }




    /* ====== EVENT HANDLERS ====== */

    function eventHandlersOnce() {

        /* NAVIGATION MOBILE */
        // if (touch || ($(window).width() < 900)) {
        var windowHeigth = $(window).height();

        $('.js-nav-trigger').bind('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if ($('html').hasClass('navigation--is-visible')) {
                $('#page').css('height', '');
                $('html').removeClass('navigation--is-visible');

            } else {
                $('#page').height(windowHeigth);
                $('html').addClass('navigation--is-visible');
            }
        });

        $('.wrapper').bind('click', function(e) {
            if ($('html').hasClass('navigation--is-visible')) {

                e.preventDefault();
                e.stopPropagation();

                $('#page').css('height', '');
                $('html').removeClass('navigation--is-visible');
            }
        });
        // }


        // Mega Menu Slider Size
        $('.nav--main  .nav__item').on('hover', function() {
            $(this).parent().find('.js-pixslider').each(function() {
                var slider = $(this).data('royalSlider');
                slider.updateSliderSize();
            });
        });

    };

    function eventHandlers() {};




    /* ====== ON DOCUMENT READY ====== */

    $(function() {

        /* --- INITIALIZE --- */
        init();

        /* --- CONDITIONAL LOADING --- */
        loadUp();

        setTimeout(function() {
            $('html').addClass('document-ready');
        }, 300);
    });



    /* ====== ON WINDOW LOAD ====== */

    $(window).load(function() {
        popularPostsWidget();
    });




    /* ====== ON RESIZE ====== */

    $(window).on("debouncedresize", function(e) {
        resizeVideos();
        slider_billboard();
    });



    /* ====== ON SCROLL ======  */

    //$(window).scroll(function(e){});


    // http://paulirish.com/2011/requestanimationframe-for-smart-animating/
    // http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

    // requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel

    // MIT license

    (function() {
        var lastTime = 0;
        var vendors = ['ms', 'moz', 'webkit', 'o'];
        for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
            window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] ||
                window[vendors[x] + 'CancelRequestAnimationFrame'];
        }

        if (!window.requestAnimationFrame)
            window.requestAnimationFrame = function(callback, element) {
                var currTime = new Date().getTime();
                var timeToCall = Math.max(0, 16 - (currTime - lastTime));
                var id = window.setTimeout(function() {
                        callback(currTime + timeToCall);
                    },
                    timeToCall);
                lastTime = currTime + timeToCall;
                return id;
            };

        if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = function(id) {
                clearTimeout(id);
            };
    }());

    // returns the depth of the element "e" relative to element with id=id
    // for this calculation only parents with classname = waypoint are considered
    function getLevelDepth(e, id, waypoint, cnt) {
        cnt = cnt || 0;
        if (e.id.indexOf(id) >= 0) return cnt;
        if ($(e).hasClass(waypoint)) {
            ++cnt;
        }
        return e.parentNode && getLevelDepth(e.parentNode, id, waypoint, cnt);
    }

    // returns the closest element to 'e' that has class "classname"
    function closest(e, classname) {
        if ($(e).hasClass(classname)) {
            return e;
        }
        return e.parentNode && closest(e.parentNode, classname);
    }

})(jQuery, window);
// /* ====== HELPER FUNCTIONS ====== */

//similar to PHP's empty function
function empty(data) {
    if (typeof(data) == 'number' || typeof(data) == 'boolean') {
        return false;
    }
    if (typeof(data) == 'undefined' || data === null) {
        return true;
    }
    if (typeof(data.length) != 'undefined') {
        return data.length === 0;
    }
    var count = 0;
    for (var i in data) {
        // if(data.hasOwnProperty(i))
        //
        // This doesn't work in ie8/ie9 due the fact that hasOwnProperty works only on native objects.
        // http://stackoverflow.com/questions/8157700/object-has-no-hasownproperty-method-i-e-its-undefined-ie8
        //
        // for hosts objects we do this
        if (Object.prototype.hasOwnProperty.call(data, i)) {
            count++;
        }
    }
    return count === 0;
}

function extend(a, b) {
    for (var key in b) {
        if (b.hasOwnProperty(key)) {
            a[key] = b[key];
        }
    }
    return a;
}

// taken from https://github.com/inuyaksa/jquery.nicescroll/blob/master/jquery.nicescroll.js
function hasParent(e, id) {
    if (!e) return false;
    var el = e.target || e.srcElement || e || false;
    while (el && el.id != id) {
        el = el.parentNode || false;
    }
    return (el !== false);
}

function mobilecheck() {
    var check = false;
    (function(a) {
        if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
    })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
}

/* --- Set Query Parameter--- */
function setQueryParameter(uri, key, value) {
    var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
    separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
        return uri + separator + key + "=" + value;
    }
}

function resizeVideos() {

    var videos = jQuery('iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="vimeo.com"], video');

    videos.each(function() {
        var video = jQuery(this),
            ratio = video.data('aspectRatio'),
            w = video.css('width', '100%').width(),
            h = w / ratio;
        video.height(h);
    });
}