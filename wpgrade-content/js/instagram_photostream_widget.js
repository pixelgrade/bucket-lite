(function($){
	"use strict";
	$.fn.extend({
		instagram_photostream: function(options) {

			return this.each(function() {
				var o = options;
				var obj = $(this);

				var token = "188312888.f79f8a6.1b920e7f642b4693a4cb346162bf7154",
					url =  "https://api.instagram.com/v1/users/search?q=" + o.user + "&access_token=" + token + "&count=10&callback=?";
				$.getJSON(url, function(data){
					$.each(data.data, function(i,shot){
						var instagram_username = shot.username;

						if (instagram_username == o.user){

							var user_id = shot.id;

							if (user_id !== ""){
								url =  "https://api.instagram.com/v1/users/" + user_id + "/media/recent/?access_token=" + token + "&count=" + o.limit + "&callback=?";
								$.getJSON(url, function(data){

									$.each(data.data, function(i,shot){

										var img_src = shot.images.thumbnail.url;

										var img_url = shot.link;
										var img_title = "";
										if (shot.caption !== null){
											img_title = shot.caption.text;
										}
										var image = $('<img/>').attr({src: img_src, alt: img_title});
										var url = $('<a class="wpgrade-instagram-link" />').attr({href: img_url, target: '_blank', title: img_title});
										var url2 = $(url).append(image);
										var li = $('<li class="wpgrade-instagram-item" />').append(url2);
										$(obj).append(li);

									});
								});
							}
						}
					});
				});

			}); // return this.each
		}
	});
})(jQuery);