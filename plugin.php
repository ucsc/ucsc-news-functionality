<?php
/**
 * Plugin Name: UCSC News Functionality
 * Plugin URI: https://github.com/ucsc/ucsc-news-functionality.git
 * Description: Adds custom functionality to UCSC News information.
 * Version: 0.1.0
 * Author: UC Santa Cruz
 * Author URI: https://github.com/ucsc
 * Update URI: https://github.com/ucsc
 * License: GPL2
 * Requires Plugins: advanced-custom-fields-pro
 * 
 * @package ucsc-news-functionality
 */

// Set plugin directory and basename.
if ( ! defined( 'NEWS_DIR' ) ) {
	define( 'NEWS_DIR', dirname( __FILE__ ) );
}

if ( ! defined( 'NEWS_BASE' ) ) {
	define( 'NEWS_BASE', plugin_basename( __FILE__ ) );
}

// Include Customization files.

// General functions.
if ( file_exists( NEWS_DIR . '/lib/functions/general.php' ) ) {
	include_once NEWS_DIR . '/lib/functions/general.php';
}

// Settings.
if ( file_exists( NEWS_DIR . '/lib/functions/settings.php' ) ) {
	include_once NEWS_DIR . '/lib/functions/settings.php';
}

// Custom Post Types.
if ( file_exists( NEWS_DIR . '/lib/functions/post-types.php' ) ) {
	include_once NEWS_DIR . '/lib/functions/post-types.php';
}

// Advanced Custom Fields.
if ( file_exists( NEWS_DIR . '/lib/functions/acf.php' ) ) {
	include_once NEWS_DIR . '/lib/functions/acf.php';
}

// Custom Blocks.
if ( file_exists( NEWS_DIR . '/lib/blocks/blocks.php' ) ) {
	include_once NEWS_DIR . '/lib/blocks/blocks.php';
}

/** 
 * Add link to Settings page from Plugins
 */
// add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ucsc_news_functionality_plugin_action_links' );

if ( ! function_exists( 'ucsc_news_functionality_plugin_action_links' ) ){
	function ucsc_news_functionality_plugin_action_links( $links ) {
		// Build and escape the URL.
		$url = esc_url( add_query_arg(
			'page',
			'ucsc-news-functionality-settings',
			get_admin_url() . 'options-general.php'
		) );
		// Create the link.
		$settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
		// Adds the link to the end of the array.
		array_push(
			$links,
			$settings_link
		);
		return $links;
	}
}