<?php
/**
 * Safe check for ACF 6.0.
 */

namespace demchco\blocks;

/**
 * Checks if porable blocks can be used since it requires acf 6.0.
 */
function is_portable() {

	if ( ! function_exists( 'acf' ) || 6 > absint( acf()->version ) ) :
		return false;
	endif;

	return true;
}
