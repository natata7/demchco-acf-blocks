<?php
/**
 * MODULE - Accordion
 *
 * @link https://developer.wordpress.org/block-editor/
 */

use function demchco\blocks\print_element;
use function demchco\blocks\get_formatted_args;
use function demchco\blocks\get_formatted_atts;

$abs_defaults = array(
	'class' => array( 'demchco-module', 'demchco-module-accordion' ),
	'items' => array(),
);

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( array( 'class' ), $abs_args );
?>

<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php foreach ( $abs_args['items'] as $abs_key => $abs_item ) : ?>
		<div class="accordion-item">
			<?php
			print_element(
				'button',
				array(
					'class' => array( 'accordion-title' ),
					'id'    => 'accordion-item-' . $abs_key,
					'title' => $abs_item['text'],
					'aria'  => array(
						'controls' => 'accordion-content-' . $abs_key,
					),
					'icon'  => array(
						'color'  => '#000',
						'icon'   => 'caret-down',
						'height' => '24',
						'width'  => '24',
					),
				)
			);
			?>

			<div
				id="accordion-content-<?php echo esc_attr( $abs_key ); ?>"
				role="region"
				aria-labelledby="accordion-item-<?php echo esc_attr( $abs_key ); ?>"
			>
			<?php
			print_element(
				'content',
				array(
					'class'   => array( 'accordion-content' ),
					'content' => $abs_item['content'],
				)
			);
			?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
