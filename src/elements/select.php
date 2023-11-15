<?php
/**
 * ELEMENT - Select
 *
 * Elements are analagous to 'Atoms' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#atoms
 */

use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;

$abs_defaults = array(
	'class'    => array( 'demchco-element', 'demchco-element-select' ),
	'name'     => false,
	'value'    => false,
	'disabled' => false,
	'required' => false,
	'options'  => array(),
);

$abs_args = get_formatted_args( $args, $abs_defaults );

// Add ID for <label> tags.
if ( $abs_args['name'] ) :
	$abs_args['id'] = $abs_args['name'];
endif;

// Set up element attributes.
$abs_atts = get_formatted_atts( array( 'id', 'name', 'class', 'disabled', 'required' ), $abs_args );

?>
<select <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php foreach ( $abs_args['options'] as $abs_option ) : ?>
		<option value='<?php echo esc_attr( $abs_option['value'] ); ?>' <?php echo $abs_args['value'] === $abs_option['value'] ? 'selected' : ''; ?>><?php echo esc_attr( $abs_option['text'] ); ?></option>
	<?php endforeach; ?>
</select>
