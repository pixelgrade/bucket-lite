(function($){
	"use strict";
	var layoutI = 0;
	var masonryOpts = {
		columnWidth: 1,
		gutterWidth: 0
	};

	$.Isotope.prototype._getMasonryGutterColumns = function() {
		var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
		var containerWidth = this.element.width();
		this.masonry.columnWidth =
			this.options.masonry && this.options.masonry.columnWidth ||
				this.$filteredAtoms.outerWidth(true) || containerWidth;
		this.masonry.columnWidth += gutter;
		this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
		this.masonry.cols = Math.max( this.masonry.cols, 1 );
	};

	$.Isotope.prototype._masonryReset = function() {
		this.masonry = {};
		this._getMasonryGutterColumns();
		var i = this.masonry.cols;
		this.masonry.colYs = [];
		while (i--) {this.masonry.colYs.push( 0 );}
	};

	$.Isotope.prototype._masonryResizeChanged = function() {
		var prevSegments = this.masonry.cols;
		this._getMasonryGutterColumns();
		return ( this.masonry.cols !== prevSegments );
	};
	$.fn.exists = function(){return this.length>0;};

	$(document).ready(function(){
		var $container = $(".portfolio_items");
		var maxportfoliopages = $container.data('maxpages');
		var $window = $(window);

		//Call Isotope Functions
		setTimeout(function() {
			layoutRefresh();
		}, 100);

		var pagecounter = 1;

		$container.infinitescroll({
				navSelector  : '#portfolio-nav',    // selector for the paged navigation
				nextSelector : '#portfolio-nav span.older a',  // selector for the NEXT link (to page 2)
				itemSelector : '.portfolio-item',     // selector for all items you'll retrieve
				loading: {
					finished: undefined,
					finishedMsg: "<em>These are all our projects.</em>",
					img: "",
					msg: null,
					msgText: "<em>Loading more projects...</em>",
					selector: null,
					speed: 'fast',
					start: undefined
				},
				debug: false
			},
			// trigger Isotope as a callback
			function( newElements ) {
				var $newElems = $( newElements );
				// ensure that images load before adding to masonry layout
				$newElems.imagesLoaded(function(){
					pagecounter = pagecounter + 1;
					if (pagecounter == maxportfoliopages) {
						$('.portfolio-grid .load_more').addClass('hidden');
					} else {
						$('.portfolio-grid .load_more a').removeClass('loading');
					}
					$container.isotope( 'appended', $( newElements ) );
					layoutRefresh();
					$newElems.each(function(){
						$(this).find('ul li:not(.text) a').each(function() {
							$(this).hoverdir();
						});
					});
				});
			});

		// unbind normal behavior. needs to occur after normal infinite scroll setup.
		$window.unbind('.infscr');

		$('.portfolio-grid .load_more a').click(function(){
			$(this).addClass('loading');
			$container.infinitescroll('retrieve');
			return false;
		});

		// remove the paginator when we're done.
		$(document).ajaxError(function(e,xhr,opt){
			if (xhr.status == 404) {
				$('.post-type-archive-portfolio .load_more').fadeOut('slow');
			}
		});

		//Call Isotope after images loading
		$container.imagesLoaded( function(){
			portfolio_isotope();
			portfolio_isotope_item();
			// layoutRefresh();
			$window.smartresize( layoutRefresh );
		});

		//Call Isotope after images loading on single project
		$('.portfolio_single_gallery').imagesLoaded( function(){
			$window.smartresize( layoutRefresh );
		});

		function layoutRefresh() {
			portfolio_isotope();
			portfolio_isotope_item();
		}
		function portfolio_isotope() {
			$container.isotope({
				resizable: true,
				itemSelector : "article",
				masonry: masonryOpts,
				onLayout: function() {
				}
			});
		}
		function portfolio_isotope_item() {
			$('.portfolio_items article ul').isotope({
				resizable: false,
				itemSelector : "li",
				masonry: masonryOpts,
				onLayout: function() {
				}
			});
		}

		// filter items when filter link is clicked
		$('#categories_list a').click(function(){
			var selector = $(this).attr('data-filter');
			var filtered_container = $('.portfolio_archive');
			filtered_container.isotope({ filter: selector });
			return false;
		});
	});

	//Hover Effect
	$('.portfolio_items ul li:not(.text) a, .row-single-project ul li a').each( function() { $(this).hoverdir(); } );

})(jQuery);



