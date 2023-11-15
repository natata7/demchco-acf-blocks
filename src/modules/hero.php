<?php
/**
 * MODULE - Hero.
 * Modules are analagous to 'Molecules' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#molecules
 */

use function demchco\blocks\print_element;
use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;

$abs_defaults = array(
	'class'       => array( 'demchco-module', 'demchco-module-hero' ),
	'image'       => false,
	'overlay'     => false,
	'eyebrow'     => false,
	'heading'     => false,
	'content'     => false,
	'button_args' => false,
);
$abs_args     = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( array( 'class' ), $abs_args );

?>
<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="background">
		<?php
		// Image.
		if ( $abs_args['image'] ) :
			print_element(
				'image',
				array(
					'attachment_id' => $abs_args['image']['attachment_id'],
				)
			);
		endif;
		?>

		<?php if ( $abs_args['overlay'] ) : ?>
			<div class="overlay" style="background-color: <?php echo esc_attr( $abs_args['overlay'] ); ?>;"></div>
		<?php endif; ?>
	</div>

	<div class="hero-content">
		<?php
		// Eyebrow.
		if ( $abs_args['eyebrow'] ) :
			print_element(
				'eyebrow',
				array(
					'text' => $abs_args['eyebrow'],
				)
			);
		endif;

		// Heading.
		if ( $abs_args['heading'] ) :
			print_element(
				'heading',
				array(
					'text'  => $abs_args['heading'],
					'level' => 1,
				)
			);
		endif;

		// Content.
		if ( $abs_args['content'] ) :
			print_element(
				'content',
				array(
					'content' => $abs_args['content'],
				)
			);
		endif;

		// Button.
		if ( $abs_args['button_args'] ) :
			print_element(
				'button',
				$abs_args['button_args']['button']
			);
		endif;
		?>
	</div>
</div>
