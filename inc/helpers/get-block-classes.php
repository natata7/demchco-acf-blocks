<?php
/**
 * Returns an array of classes from a block's Gutenberg fields.
 */

namespace demchco\blocks;

/**
 * Returns an updated array of classes.
 *
 * @param array $block Array of block attributes.
 *
 * return array The updated array of classes.
 */
function get_block_classes( $block ) {
	$abs_block_classes = array();

	if ( ! empty( $block['className'] ) ) :
		$abs_block_classes[] = $block['className'];
	endif;

	if ( ! empty( $block['backgroundColor'] ) ) {
		$abs_block_classes[] = 'has-background';
		$abs_block_classes[] = 'has-' . $block['backgroundColor'] . '-background-color';
	}

	if ( ! empty( $block['textColor'] ) ) {
		$abs_block_classes[] = 'has-text-color';
		$abs_block_classes[] = 'has-' . $block['textColor'] . '-color';
	}

	return $abs_block_classes;
}
