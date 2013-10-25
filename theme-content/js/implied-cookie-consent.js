
(function($) {

	$(function() {
		if(!seen_cookie_message()) {
			show_cookie_message();
			set_seen_cookie_message();
		}

		jQuery('.icc_dismiss_button').click(function(){
			hide_cookie_message();
		});
		jQuery('.icc_delete_button').click(function(){
			remove_cookies();
			window.location.replace("https://duckduckgo.com/");
		});
	});

	function seen_cookie_message() {
		return jQuery.cookie('icc_cookie_message') == 'yes';
	}
	function set_seen_cookie_message() {
		jQuery.cookie('icc_cookie_message', 'yes', { expires: 365 });
	}

	function remove_cookies() {
		jQuery.each(jQuery.cookie(), function(key, value){ 
			jQuery.removeCookie(key);
		});
	}

	function show_cookie_message() {
		$('html').css('margin-top', $('#icc_message').height());
		$('#icc_message').show();
	}

	function hide_cookie_message() {
		jQuery('#icc_message').hide();
		jQuery('html').animate({'margin-top': 0});
	}

})(jQuery);
