<?php
/**
 * Add Plugin settings and info page
 *
 * This file contains functions to add a settings/info page below WordPress Settings menu
 *
 * @package      ucsc
 * @since        0.1.0
 * @link         https://github.com/ucsc/ucsc-news-functionality.git
 * @author       UC Santa Cruz
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/** 
 * Register new menu and page
 */
if ( ! function_exists( 'ucsc_news_add_settings_page' ) ) {
	function ucsc_news_add_settings_page() {
		add_options_page( 'UCSC News Functionality plugin page', 'UCSC News Functionality', 'manage_options', 'ucsc-news-functionality-settings', 'ucsc_news_render_plugin_settings_page' );
	}
}
add_action( 'admin_menu', 'ucsc_news_add_settings_page' );


/** 
 * HTML output of Settings page 
 *
 * note: This page typically displays a form for displaying any settings options. 
 * It is not needed at this point.
 * https://developer.wordpress.org/plugins/settings/custom-settings-page/
 */
if ( ! function_exists( 'ucsc_news_render_plugin_settings_page' ) ) {
	function ucsc_news_render_plugin_settings_page() {
		$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/ucsc-news-functionality/plugin.php');
		?>
		<div class="wrap ucsc-news-admin-settings-page">
		<h1><?php echo $plugin_data['Name']; ?></h1>
		<h2>Version: <?php echo $plugin_data['Version']; ?> <a href="https://github.com/ucsc/ucsc-news-functionality/releases">(release notes)</a></h2>
		<p><?php echo $plugin_data['Description']; ?></p>
		<hr>
		<h3>Features added by this plugin:</h3>
		
		</div>
		<?php
	}
}
