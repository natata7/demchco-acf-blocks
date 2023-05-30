<?php
/**
 * ELEMENT - Icon
 *
 * Elements are analagous to 'Atoms' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#atoms
 */

/**
 * Expected SVG Attributes are the same as for print_svg():
 *
 * 'color'        => '',
 * 'icon'         => '',
 * 'title'        => '',
 * 'desc'         => '',
 * 'stroke-width' => '',
 * 'height'       => '',
 * 'width'        => '',
 */

use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;
use function demchco\blocks\print_svg;

$abs_defaults = [
	'class'    => [ 'demchco-element', 'demchco-element-icon' ],
	'svg_args' => [],
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );

?>
<span <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php print_svg( $abs_args['svg_args'] ); ?></span>
