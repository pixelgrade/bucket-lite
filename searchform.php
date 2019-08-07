<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<form class="form-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
    <input class="search-query" type="text" name="s" id="s" placeholder="<?php esc_attr_e('Search...', 'bucket-lite') ?>" autocomplete="off" value="<?php the_search_query(); ?>" /><!--
    --><button class="btn search-submit" id="searchsubmit"><i class="icon-search"></i></button>
</form>
