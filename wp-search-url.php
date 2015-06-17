<?php
/*
Plugin Name: Wp Search Url
Version: 1.0
Plugin URI: http://odrasoft.com/wp-search-url/
Description: Redirects ?s=swadesh searches to /search/swadesh
Author: swadeshswain
Author URI: http://odrasoft.com/
*/

function wp_search_url() {
	global $wp_rewrite;
	if ( !isset( $wp_rewrite ) || !is_object( $wp_rewrite ) || !$wp_rewrite->using_permalinks() )
		return;

	$search_base = $wp_rewrite->search_base;
	if ( is_search() && !is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
		wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var( 's' ) ) ) );
		exit();
	}
}

add_action( 'template_redirect', 'wp_search_url' );


