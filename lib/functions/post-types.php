<?php
/**
 * Post Types
 *
 * This file registers custom post types
 *
 * @package   ucsc
 * @since     0.1.0
 * @link      https://github.com/ucsc/ucsc-news-functionality.git
 * @author    UC Santa Cruz
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! function_exists( 'ucsc_news_register_media_coverage_post_type' ) ) {
	/**
	 * Create Media Coverage post type
	 *
	 * @since 1.0.0
	 * @link  http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	function ucsc_news_register_media_coverage_post_type()
	{
		$labels = array(
		'name' => 'Media Coverage',
		'singular_name' => 'Media Coverage',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Media Coverage',
		'edit_item' => 'Edit Media Coverage link',
		'new_item' => 'New Media Coverage link',
		'view_item' => 'View Media Coverage link',
		'search_items' => 'Search Media Coverage links',
		'not_found' =>  'No Media Coverage links found',
		'not_found_in_trash' => 'No Media Coverage links found in trash',
		'parent_item_colon' => '',
		'menu_name' => 'Media Coverage',
		);

		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true, // To use Gutenberg editor.
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_icon' => 'dashicons-welcome-view-site',
		'menu_position' => 23,
		'supports' => array('author', 'editor', 'excerpt', 'thumbnail', 'title'),
		'taxonomies' => array( 'post_tag', 'category')
		);

		register_post_type('media_coverage', $args);
	}
}

add_action('init', 'ucsc_news_register_media_coverage_post_type');

/**
	 * Add query loop block variation for Media Coverage
	 *
	 * @since 1.0.1
	 * @link  https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/extending-the-query-loop-block/
	 */
function ucsc_news_enqueue_block_variations() {
	wp_enqueue_script(
		'ucsc-news-enqueue-block-variations',
		plugin_dir_url( __DIR__ ) . '/scripts/variations.js',
		array( 'wp-blocks', 'wp-dom-ready' ),
		wp_get_theme()->get( 'Version' ),
		false
	);
}
add_action( 'enqueue_block_editor_assets', 'ucsc_news_enqueue_block_variations' );

