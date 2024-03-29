<?php
/**
 * MODULE - Notification Banner.
 *
 * @link https://developer.wordpress.org/block-editor/
 */

/**
 * Expected values for 'position' are 'top' or 'bottom'.
 * 'Sticky' notifications bar will be set to 'position: fixed'.
 * Icon is not necessary if 'dismissible' is true as Close icon will be rendered automatically.
 */

use function demchco\blocks\print_element;
use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;

$abs_defaults = array(
	'class'       => array( 'demchco-module', 'demchco-module-notification' ),
	'text_args'   => array(),
	'icon'        => array(),
	'dismissible' => false,
	'type'        => array(
		'sticky'   => true,
		'position' => 'top',
	),
);

$abs_args = get_formatted_args( $args, $abs_defaults );

// Add default classes.
$abs_args['class'][] = $abs_args['type']['sticky'] ? 'is-sticky' : '';
$abs_args['class'][] = $abs_args['type']['sticky'] ? 'position-' . $abs_args['type']['position'] : '';

// Add an id.
$abs_args['id'] = 'notification-banner';

// Add the correct role.
$abs_args['role'] = $abs_args['dismissible'] ? 'alertdialog' : 'alert';

// Set up ARIA attributes.
$abs_args['aria']['labelledby'] = 'notification-title';

// Set up element attributes.
$abs_atts = get_formatted_atts( array( 'class', 'role', 'aria', 'id' ), $abs_args );

// Make sure the notification title has an id for accessibility.
if ( empty( $abs_args['text_args']['id'] ) ) :
	$abs_args['text_args']['id'] = 'notification-title';
endif;

?>
<aside <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	if ( $abs_args['text_args'] ) :
		print_element( 'heading', $abs_args['text_args'] );
	endif;
	if ( $abs_args['dismissible'] || $abs_args['icon'] ) :
		if ( $abs_args['dismissible'] ) :
			// This is dismissible, so let's render a close button.
			print_element(
				'button',
				array(
					'icon' => array(
						'color'        => '#c00',
						'icon'         => 'circle-x',
						'stroke-width' => '2px',
						'height'       => '32px',
						'width'        => '32px',
					),
					'aria' => array(
						'controls' => $abs_args['id'],
					),
				)
			);
		else :
			print_element(
				'icon',
				array(
					'svg_args' => $abs_args['icon'],
				)
			);
		endif;
	endif;
	?>
</aside>
