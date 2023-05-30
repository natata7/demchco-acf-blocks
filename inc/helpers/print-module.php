<?php
/**
 * Render a module.
 */

namespace demchco\blocks;

/**
 * Render a module.
 *
 * @param string $module_name The name of the module.
 * @param array  $args Args for the module.
 */
function print_module( $module_name = '', $args ) {
	if ( ! $module_name ) {
		return;
	}

	// extract args.
	if ( ! empty( $args ) ) {
		extract( $args ); //phpcs:ignore WordPress.PHP.DontExtract.extract_extract -- We can use it here since we know what to expect on the arguments.
	}

	require DEMCHCO_ROOT_PATH . 'src/modules/' . $module_name . '.php';
}
