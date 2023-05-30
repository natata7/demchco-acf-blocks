<?php
/**
 * ELEMENT - Eyebrow
 *
 * Elements are analagous to 'Atoms' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#atoms
 */

use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;

$abs_defaults = [
	'class' => [ 'demchco-element', 'demchco-element-eyebrow' ],
	'text'  => false,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Make sure element should render.
if ( $abs_args['text'] ) :

	// Set up element attributes.
	$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );

	?>
	<span <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $abs_args['text'] ); ?></span>
<?php endif; ?>
