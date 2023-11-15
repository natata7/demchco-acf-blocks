<?php
/**
 * MODULE - Badges.
 *
 * @link https://developer.wordpress.org/block-editor/
 */

use function demchco\blocks\print_element;
use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;

$abs_defaults = array(
	'class'  => array( 'demchco-module', 'demchco-module-badges' ),
	'badges' => array(),
);

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( array( 'class' ), $abs_args );
?>
<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	foreach ( $abs_args['badges'] as $abs_badge ) :
		print_element(
			'badge',
			$abs_badge
		);
	endforeach;
	?>
</div>
