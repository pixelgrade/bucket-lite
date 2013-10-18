;(function($){
	$(document).ready(function(){

		$('td[data-field_name=posts_source_category]').parent().hide();
		$('td[data-field_name=posts_source_post_formats]').parent().hide();

		$('td[data-field_name="posts_source"]').each(function(i,e){
			$parent = $(this).parent();
			$select = $(this).find('select');

			if ( $select.val() == 'latest_by_cat' ) {
				$parent.siblings().find('posts_source_category').parent().show();
			}



		});
	});
})(jQuery);