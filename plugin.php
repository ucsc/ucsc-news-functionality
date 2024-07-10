<?php
/**
 * Plugin Name: UCSC News Functionality
 * Plugin URI: https://github.com/ucsc/ucsc-news-functionality/
 * Description: Adds additional news content management tools to UCSC WordPress websites.
 * Version: 1.0.0
 * Author: UC Santa Cruz
 * Author URI: https://github.com/ucsc
 * License: GPL2
 * Network: true
 * Update URI: https://github.com/ucsc/ucsc-news-functionality/
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
