<?php
/**
 * Registers a 'Demchco Blocks' block category with Gutenberg.
 */

add_filter(
	'block_categories_all',
	function ( $categories ) {

		// Adding a new category.
		$categories[] = array(
			'slug'  => 'demchco',
			'title' => 'Demchco Blocks',
		);

		return $categories;
	}
);
