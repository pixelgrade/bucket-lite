/* --- Magnific Popup Initialization --- */

function magnificPopupInit(){

	$('.js-post-gallery').each(function() { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', // the container for each your gallery items
			type: 'image',
			removalDelay: 500,
			mainClass: 'mfp-fade',
			image: {
				titleSrc: function (item){
					var output = '';
					if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					}
					if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					}
					return output;
				}
			},
			gallery:{
				enabled:true,
				navigateByImgClick: true
			}
		});
	});
}