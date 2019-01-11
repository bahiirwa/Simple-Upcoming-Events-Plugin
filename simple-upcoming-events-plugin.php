<?php
/**
 * Plugin Name: Simple Upcoming Events Plugin
 * Plugin URI: http://omukiguy.com
 * Description: Get an unordered list of upcoming events on the front-end via a Widget.
 * Version: 1.0
 * Author: Laurence Bahiirwa
 * Author URI: http://omukiguy.com
 * License: GPL2
 */

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Unauthorized Access!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}
 
/**
 * Flushing rewrite rules on plugin activation/deactivation
 * for better working of permalink structure
 */
function suep_activation_deactivation() {
	Inc\Base\CustomPost::suep_custom_post_type();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'suep_activation_deactivation' );

/**
 * Initialize all the core classes
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}