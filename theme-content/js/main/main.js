/* ====== INTERNAL FUNCTIONS ====== */

/* --- Set Query Parameter--- */
function setQueryParameter(uri, key, value) {
    var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
    separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}


/* --- $VIDEOS --- */

function initVideos() {

    var videos = $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"], video');

    // Figure out and save aspect ratio for each video
    videos.each(function() {
        if( this.width != 0 && this.height != 0 ){
            $(this).data('aspectRatio', this.width / this.height)
            // and remove the hard coded width/height
                .removeAttr('height')
                .removeAttr('width');
        } else { // for the conflict with jetpack set an default aspect ration of 16/9
            $(this).data('aspectRatio', 16/9 )
                .removeAttr('height')
                .removeAttr('width');
        }
    });

    resizeVideos();

    // Firefox Opacity Video Hack
    $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function(){
        var url = $(this).attr("src");

        $(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
    });
}


function stickyHeader(){
    if($('body').hasClass('sticky-nav')){
        var sticky = $('.js-sticky');
        var offset = sticky.offset();
        var stickyHeight = sticky.height();

        sticky.parent().height(stickyHeight);
        sticky.parent().css('margin-bottom', '24px');

        $(window).scroll(function() {

            if ( $(window).scrollTop() > offset.top){
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

    for (i=0; i<metas.length; i++) {
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
        setTimeout(function(){
            self.addClass('open');
        }, 50);
    }
    function hideMegaMenu() {
        var self = $(this);
        self.removeClass('open');
        setTimeout(function(){
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

    if($('body').hasClass('custom-background')){
        if($('body').css('background-repeat') == 'no-repeat') {
            $('body').addClass('background-cover');
        }
    }

};





/* ====== CONDITIONAL LOADING ====== */

function loadUp(){

    initVideos();
    footerWidgetsTitles();

    //Set textareas to autosize
    if($("textarea").length) { $("textarea").autosize(); }

    // if blog archive
    if ($('.masonry').length && !lteie9 && !is_android)
        salvattore();

    //lets test first if we have some riloadr images to work on
    if ($('.riloadr-slider').length > 0) {
        var riloadrSlider = new Riloadr({
            name : 'riloadr-slider',
            breakpoints: [
                {name: 'small' /*post-medium */ , minWidth: 901},
                {name: 'big'   /*post-medium */ , maxWidth: 900}
            ],
            watchViewportWidth: "*",
            oncomplete: function(){
                if(royalSliderBillboardInitiated == false)
                    royalSliderBillboardInit();
            }
        });
    } else {
        //we may as well initiate the billboard slider
        if(royalSliderBillboardInitiated == false)
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

        if($('html').hasClass('navigation--is-visible')){
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

function eventHandlers(){};




/* ====== ON DOCUMENT READY ====== */

$(function(){

    /* --- INITIALIZE --- */
    init();

    /* --- CONDITIONAL LOADING --- */
    loadUp();

    setTimeout(function(){
        $('html').addClass('document-ready');
    }, 300);
});



/* ====== ON WINDOW LOAD ====== */

$(window).load(function(){
    popularPostsWidget();
});




/* ====== ON RESIZE ====== */

$(window).on("debouncedresize", function(e){
    resizeVideos();
    slider_billboard();
});



/* ====== ON SCROLL ======  */

//$(window).scroll(function(e){});
