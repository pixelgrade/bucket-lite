;(function($){
	$(document).ready(function(){

		// custom show/hide for fields which depends on posts_source value
		$('td[data-field_name=posts_source_category]').parent().hide();
		$('td[data-field_name=posts_source_post_formats]').parent().hide();

		$('td[data-field_name="posts_source"]').each(function(i,e){
			$parent = $(this).parent();
			$select = $(this).find('select');
			if ( $select.val() == 'latest_by_cat' ) {
				$parent.siblings().find('td[data-field_name=posts_source_category]').parent().show();
			}

			if ( $select.val() == 'latest_by_format' ) {
				$parent.siblings().find('td[data-field_name=posts_source_post_formats]').parent().show();
			}
		});
		// all this above should be also moved in the "on change" action below
		$(document).on('change', 'td[data-field_name=posts_source]', function(){
			$('td[data-field_name=posts_source_category]').parent().hide();
			$('td[data-field_name=posts_source_post_formats]').parent().hide();

			$('td[data-field_name="posts_source"]').each(function(i,e){
				$parent = $(this).parent();
				$select = $(this).find('select');
				if ( $select.val() == 'latest_by_cat' ) {
					$parent.siblings().find('td[data-field_name=posts_source_category]').parent().show();
				}

				if ( $select.val() == 'latest_by_format' ) {
					$parent.siblings().find('td[data-field_name=posts_source_post_formats]').parent().show();
				}
			});
		});

	});
})(jQuery);