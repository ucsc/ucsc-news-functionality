<?php
/**
 * General Functions
 *
 * This file adds general functions. Analagous to functions.php
 *
 * @package      ucsc-news
 * @since        0.1.0
 * @link         https://github.com/ucsc/ucsc-news-functionality.git
 * @author       UC Santa Cruz
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


/**
*	Enqueue admin settings styles
*/ 
if ( ! function_exists( 'ucsc_news_enqueue_admin_styles' ) ) {
	
	function ucsc_news_enqueue_admin_styles($hook){
		$settings_css = plugin_dir_url(__FILE__) . 'lib/css/admin-settings.css';
		$current_screen = get_current_screen();
		
		// Check if it's "?page=ucsc-news-functionality-settings." If not, just empty return. 
		if ( strpos($current_screen->base, 'ucsc-news-functionality-settings') === false) {
			return;
		} else {
			wp_register_style( 'ucsc-news-admin-settings', $settings_css,);
			wp_enqueue_style( 'ucsc-news-admin-settings');
		}
	}
}
add_action( 'admin_enqueue_scripts', 'ucsc_news_enqueue_admin_styles' );

/** 
 * Add link to Settings page from Plugins
 */
add_filter( 'plugin_action_links_' . NEWS_BASE, 'ucsc_news_functionality_plugin_action_links' );

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

/**
*	Set permalinks to the external URL  
*/
if ( ! function_exists( 'ucsc_news_link_filter' ) ){
	function ucsc_news_link_filter($post_link, $post) {
		if ( ( 'media_coverage' === $post->post_type ) ) {
			$external_url = get_field('article_url');
			if(!empty ($external_url)){
				$safe_url = esc_attr($external_url);
				return $safe_url;
			}
		}
		return $post_link;
	}
}

add_filter('post_type_link', 'ucsc_news_link_filter', 10, 2);

/**
*	Replace default placeholder value
*/
if ( ! function_exists( 'ucsc_news_change_media_coverage_title_placeholder' ) ){
	function ucsc_news_change_media_coverage_title_placeholder( $title ){
		$screen = get_current_screen();
	
		if  ( 'media_coverage' == $screen->post_type ) {
			$title = 'Add headline';
		}
	
		return $title;
	}
}

add_filter( 'enter_title_here', 'ucsc_news_change_media_coverage_title_placeholder' );
