<?php

/**
 * Specify which blocks are allowed.
 */

function allowed_blocks( $abs_allowed_blocks ) {

	// Defines the default set of allowed blocks.
	$abs_allowed_blocks = array(
		'core/heading',
		'core/paragraph',
		'core/columns',
		'core/freeform',
		'core/gallery',
		'core/html',
		'core/image',
		'core/list',
		'core/separator',
		'core/spacer',
		'core/table',
		'core/embed',
		'core/file',
		'core/video',
		'core/audio',
		'core/shortcode',
		'core/quote',
		'core/pullquote',
	);

	// Add ACF blocks.
	$abs_acf_blocks = acf_get_block_types();

	foreach ( array_keys( $abs_acf_blocks ) as $abs_block_name ) :
		$abs_allowed_blocks[] = $abs_block_name;
	endforeach;

	return $abs_allowed_blocks;
}

// add_filter('allowed_block_types_all', 'allowed_blocks');
