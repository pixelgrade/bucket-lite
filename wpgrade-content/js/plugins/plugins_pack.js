(function($){

	/**
	 * jQuery Visible
	 * https://github.com/teamdf/jquery-visible/
	 */
	$.fn.visible = function(partial){
		
	    var $t				= $(this),
	    	$w				= $(window),
	    	viewTop			= $w.scrollTop(),
	    	viewBottom		= viewTop + $w.height(),
	    	_top			= $t.offset().top,
	    	_bottom			= _top + $t.height(),
	    	compareTop		= partial === true ? _bottom : _top,
	    	compareBottom	= partial === true ? _top : _bottom,
	    	clientSize              = this.offsetWidth * this.offsetHeight;
		
		return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop));
    };
    
})(jQuery);
