<?php

namespace demchco\blocks;

/**
 * Render an element.
 *
 * @param string $element_name The name of the element.
 * @param array  $args Args for the element.
 */
function print_element( $element_name = '', $args = array() ) {
	if ( ! $element_name ) {
		return;
	}

	// extract args.
	if ( ! empty( $args ) ) {
		extract( $args ); //phpcs:ignore WordPress.PHP.DontExtract.extract_extract -- We can use it here since we know what to expect on the arguments.
	}

	require DEMCHCO_ROOT_PATH . 'src/elements/' . $element_name . '.php';
}
