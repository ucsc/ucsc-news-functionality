<?php

add_action( 'init', 'ucsc_news_blocks_setup' );

/**
*  Initialize blocks.
*/
if ( ! function_exists( 'ucsc_news_blocks_setup' ) ) {
	
	function ucsc_news_blocks_setup() {
	
		/**
		*  Array custom functionality blocks for news.
		*/
		$news_blocks = [
			'acf/article-source',
		]; 
		
		foreach ($news_blocks as $block) {
			$block_name = explode('/', $block);
		
			/**
			* Register new blocks.
			*/
			register_block_type( NEWS_DIR . '/lib/blocks/' . $block_name[1] );
		
			/**
			* Load additional block styles if present.
			*/
			if ( file_exists( NEWS_DIR . '/lib/blocks/' . $block_name[1] . '/' . 'style.css' ) ) {

				$args = [
					'handle' => "ucsc-news-$block_name[1]",
					'src' => plugin_dir_url( __FILE__ ) . $block_name[1] . '/' . 'style.css',
					($args['path'] = plugin_dir_url( __FILE__ ) . $block_name[1] . '/' . 'style.css'),
				];

				wp_enqueue_block_style($block, $args);
			}
			
		}
	}
}

/**
*  Callback functions for blocks.
*/

if ( ! function_exists( 'ucsc_news_article_source_block' ) ) {
	
	// ACF Article Source block callback
	function ucsc_news_article_source_block( $block ) {
		
		// Get the post ID
		$post_id = get_the_ID();
	
		// Get the "Article Source" ACF field
		$article_source = get_field('article_source', $post_id);
	
		$attrs = get_block_wrapper_attributes();
	
		// Display the article source
		?>
		<p <?php echo $attrs; ?>>
			<?php echo $article_source; ?>
		</p>
		<?php
	}
}
