<?php
/**
 * MODULE - Search.
 *
 * Modules are analagous to 'Molecules' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#molecules
 */

use function demchco\blocks\print_element;
use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;

$abs_defaults = [
	'class'       => [ 'wds-module', 'wds-module-search' ],
	'action'      => home_url( '/' ),
	'method'      => 'get',
	'placeholder' => false,
	'button_text' => false,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class', 'method', 'action' ], $abs_args );

?>
<form <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	// Input.
	print_element(
		'input',
		[
			'class'       => [],
			'type'        => 'text',
			'name'        => 's',
			'value'       => get_search_query(),
			'placeholder' => esc_html__( 'Search', 'demchco' ),
		]
	);

	// Submit.
	print_element(
		'button',
		[
			'class' => [],
			'type'  => 'submit',
			'text'  => esc_html__( 'Search', 'demchco' ),
		]
	);
	?>
</form>
