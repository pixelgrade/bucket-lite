/* --- Royal Slider Init --- */

var $original_billboard_slider;

/*
 * Slider Initialization
 */
function sliderInit($slider){

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
		rs_keyboardNav  = typeof $slider.data('fullscreen') !== "undefined",
		rs_imageScale  = $slider.data('imagescale'),
		rs_visibleNearby = typeof $slider.data('visiblenearby') !== "undefined" ? true : false,
		rs_imageAlignCenter  = typeof $slider.data('imagealigncenter') !== "undefined",
		rs_transition = typeof $slider.data('slidertransition') !== "undefined" && $slider.data('slidertransition') != '' ? $slider.data('slidertransition') : 'move',
		rs_autoPlay = typeof $slider.data('sliderautoplay') !== "undefined" ? true : false,
		rs_delay = typeof $slider.data('sliderdelay') !== "undefined" && $slider.data('sliderdelay') != '' ? $slider.data('sliderdelay') : '1000',
		rs_drag = true,
		rs_globalCaption = typeof $slider.data('showcaptions') !== "undefined" ? true : false;

	if(rs_autoheight) { rs_autoScaleSlider = false } else { rs_autoScaleSlider = true }

	// Single slide case
	if ($children.length == 1){
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
		globalCaption:rs_globalCaption
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
		if(rs_imageScale == 'fill'){
			var $frameHolder = $('.rsVideoFrameHolder');
			var top = Math.abs(royalSlider.height - $frameHolder.closest('.rsVideoContainer').height())/2;

			$frameHolder.height(royalSlider.height);
			$frameHolder.css('margin-top', top+'px');

		} else {
			var $frameHolder = $('.rsVideoFrameHolder');
			var $videoContainer = $('.rsVideoFrameHolder').closest('.rsVideoContainer');
			var top = parseInt($frameHolder.closest('.rsVideoContainer').css('margin-top'), 10);

			if(top < 0){
				top = Math.abs(top);
				$frameHolder
					.height(royalSlider.height)
					.css('top', top + 'px');
			}
		}
	});

	$slider.addClass('slider--loaded');
}



/*
 * Wordpress Galleries to Sliders
 * Create the markup for the slider from the gallery shortcode
 * take all the images and insert them in the .gallery <div>
 */
function sliderMarkupGallery($gallery){
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
function sliderMarkupMobile($slider){
	var $parent = $slider;

	// Change markup to default
	$slider.replaceWith($original_billboard_slider);
	$slider = $('.billboard.js-pixslider');

	// Change parameters
	$slider.attr('data-autoheight', true);
	$slider.attr('data-imagescale', 'none');

	$slider.find('.billboard--article-group').each(function(){
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
function sliderMarkupOriginal($slider){

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

	$('.js-pixslider.billboard').each(function(){
		$slider = $(this);
		var slider_rs = $slider.data('royalSlider');

		if((window_size < 900) && (!$slider.hasClass('js-pixslider-mobile'))) {
			if(slider_rs) slider_rs.destroy();
			sliderMarkupMobile($slider);
		} else if((window_size > 900) && ($slider.hasClass('js-pixslider-mobile'))) {
			if(slider_rs) slider_rs.destroy();
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
	$('.wp-gallery').each(function() { sliderMarkupGallery($(this)); });

	// Find and initialize each slider
	$('.js-pixslider').each(function(){
		if(!$(this).hasClass('billboard'))
			sliderInit($(this));
	});
};

var royalSliderBillboardInitiated = false;
function royalSliderBillboardInit(){
	royalSliderBillboardInitiated = true;

	$('.js-pixslider.billboard').each(function(){
		// Cache The Original Billboard Slider HTML Markup
		$original_billboard_slider = $(this).outerHTML();
		slider_billboard($(this));

		var height = $(this).find('img').first().height();

		sliderInit($(this));


	});
}