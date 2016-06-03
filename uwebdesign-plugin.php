<?php
/**
 * Plugin Name: uWebDesign Functional Plugin
 * Plugin URI: https://github.com/websanya/uwebdesign-plugin
 * Description: Плагин с функционалом для комьюнити сайта uWebDesign.
 * Version: 1.1.3
 * Author: Alexander Goncharov
 * Author URI: https://websanya.ru
 * GitHub Plugin URI: https://github.com/websanya/uwebdesign-plugin
 * GitHub Branch: master
 */

//* Include PageTemplater Class.
//require_once( plugin_dir_path( __FILE__ ) . 'class.pagetemplater.php' );

//* Include PostTyper Class.
require_once( plugin_dir_path( __FILE__ ) . 'class.posttyper.php' );

/**
 * Remove the slug from published post permalinks. Only affect our custom post type, though.
 */
add_filter( 'post_type_link', 'uwd_remove_cpt_slug', 10, 3 );
function uwd_remove_cpt_slug( $post_link, $post ) {

	if ( ! in_array( $post->post_type, array( 'videos', 'weeklies', 'books' ) ) || 'publish' != $post->post_status ) {
		return $post_link;
	}

	$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

	return $post_link;
}

/**
 * Have WordPress match postname to any of our public post types (post, page, race)
 * All of our public post types can have /post-name/ as the slug, so they better be unique across all posts
 * By default, core only accounts for posts and pages where the slug is /post-name/
 */
add_action( 'pre_get_posts', 'uwd_parse_request_trick' );
function uwd_parse_request_trick( $query ) {

	// Only noop the main query
	if ( ! $query->is_main_query() )
		return;

	// Only noop our very specific rewrite rule match
	if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
		return;
	}

	// 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
	if ( ! empty( $query->query['name'] ) ) {
		$query->set( 'post_type', array( 'post', 'page', 'videos', 'weeklies', 'books' ) );
	}
}

//* Flush rewrite rules on plugin activation.
register_activation_hook( __FILE__, 'uwd_rewrite_flush' );
function uwd_rewrite_flush() {
	//* You should *NEVER EVER* do this on every page load!!
	flush_rewrite_rules();
}