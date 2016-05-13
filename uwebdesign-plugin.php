<?php
/**
 * Plugin Name: uWebDesign Functional Plugin
 * Plugin URI: https://github.com/websanya/uwebdesign-plugin
 * Description: Плагин с функционалом для комьюнити сайта uWebDesign.
 * Version: 1.0.1
 * Author: Alexander Goncharov
 * Author URI: https://websanya.ru
 * GitHub Plugin URI: https://github.com/websanya/uwebdesign-plugin
 * GitHub Branch: master
 */

//* Include PageTemplater Class.
require_once( plugin_dir_path( __FILE__ ) . 'class.pagetemplater.php' );

//* Include PostTyper Class.
require_once( plugin_dir_path( __FILE__ ) . 'class.posttyper.php' );

//* Flush rewrite rules on plugin activation.
register_activation_hook( __FILE__, 'uwd_rewrite_flush' );
function uwd_rewrite_flush() {
	//* You should *NEVER EVER* do this on every page load!!
	flush_rewrite_rules();
}