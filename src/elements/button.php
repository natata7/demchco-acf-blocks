<?php
/**
 * ELEMENT - Button
 *
 * Elements are analagous to 'Atoms' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#atoms
 */

use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;
use function demchco\blocks\print_svg;

$abs_defaults = array(
	'class'         => array( 'demchco-element', 'demchco-element-button' ),
	'id'            => '',
	'title'         => false,
	'url'           => false,
	'target'        => false,
	'type'          => false,
	'icon'          => array(),
	'icon_position' => 'after', // before, after.
	'role'          => '',
	'aria'          => array(
		'controls' => '',
		'disabled' => false,
		'expanded' => false,
		'label'    => false,
		'current'  => '',
	),
);

$abs_args = get_formatted_args( $args, $abs_defaults );

// Map the ACF link 'url' attribute to an 'href' attribute.
$abs_args['href'] = $abs_args['url'];

// Make sure element should render.
if ( $abs_args['title'] || $abs_args['icon'] ) :

	if ( ! empty( $abs_args['icon'] ) ) :
		$abs_args['class'][] = 'icon';
		$abs_args['class'][] = 'icon-' . $abs_args['icon_position'];
	endif;

	// Set up element attributes.
	$abs_atts = get_formatted_atts( array( 'id', 'href', 'target', 'class', 'type', 'aria', 'role' ), $abs_args );

	?>
	<<?php echo $abs_args['href'] ? 'a' : 'button'; ?> <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		if ( $abs_args['title'] ) :
			echo esc_html( $abs_args['title'] );
		endif;

		if ( ! empty( $abs_args['icon'] ) ) :
			print_svg( $abs_args['icon'] );
		endif;
		?>
	</<?php echo $abs_args['href'] ? 'a' : 'button'; ?>>

<?php endif; ?>
