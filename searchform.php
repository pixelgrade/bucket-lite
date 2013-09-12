<div class="form">
	<form method="get" id="searchform" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="field input-medium search-query" name="s" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', wpgrade::textdomain() ); ?>" />
		<button class="btn btn-primary submit" name="submit" id="searchsubmit"><?php //esc_attr_e( 'Search', wpgrade::textdomain() ); ?> <i class="icon-e-search"></i></button>
	</form>
</div>