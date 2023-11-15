<?php
/**
 * Returns an array of ACF fields.
 */

namespace demchco\blocks;

/**
 * Returns an array of ACF fields.
 *
 * @param array $fields Array of field names ie: [ 'layout', 'eyebrow_heading', 'content', 'heading' ].
 * @param int   $block_id (optional) ID of the post or of the block ($block[id]).
 */
function get_acf_fields( $fields = array(), $block_id = false ) {

	if ( ! function_exists( 'get_field' ) ) :
		return;
	endif;

	$block_id      = $block_id ? $block_id : get_the_ID();
	$return_fields = array();
	foreach ( $fields as $field ) :
		$value                   = get_field( $field, $block_id );
		$return_fields[ $field ] = $value;
	endforeach;

	return $return_fields;
}
