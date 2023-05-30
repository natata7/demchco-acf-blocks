<?php
/**
 * MODULE - Carousel Slide.
 * Modules are analagous to 'Molecules' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#molecules
 */

use function demchco\blocks\print_element;
use function demchco\blocks\get_formatted_atts;
use function demchco\blocks\get_formatted_args;

$abs_defaults = [
	'class'         => [ 'demchco-module', 'demchco-module-carousel-slide' ],
	'attachment_id' => false,
	'overlay'       => false,
	'eyebrow'       => false,
	'heading'       => false,
	'content'       => false,
	'button'        => false,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );

?>
<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="background">
		<?php
		// Image.
		if ( $abs_args['attachment_id'] ) :
			print_element(
				'image',
				[
					'attachment_id' => $abs_args['attachment_id'],
				]
			);
		endif;
		?>
	</div>

	<?php if ( $abs_args['overlay'] ) : ?>
		<div class="overlay" style="background: <?php echo esc_attr( $abs_args['overlay'] ); ?>"></div>
	<?php endif; ?>

	<div class="carousel-slide-container">
		<div class="carousel-slide-content">
			<?php

			// Heading.
			if ( $abs_args['heading'] ) :
				print_element(
					'heading',
					[
						'text'  => $abs_args['heading'],
						'level' => 1,
					]
				);
			endif;


			// Button.
			if ( $abs_args['button'] ) :
				print_element(
					'button',
					$abs_args['button']
				);
			endif;
			?>
		</div>
	</div>
</div>
