<?php
/**
 * BLOCK - Renders an Accordion
 *
 * @link https://developer.wordpress.org/block-editor/
 */

use function demchco\blocks\get_acf_fields;
use function demchco\blocks\print_module;
use function demchco\blocks\setup_block_defaults;

$abs_block = isset( $block ) ? $block : '';
$abs_args  = isset( $args ) ? $args : '';

$abs_defaults = array(
	'class'               => array( 'demchco-block', 'demchco-block-accordion' ),
	'allowed_innerblocks' => array( 'core/heading', 'core/paragraph' ),
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => array(), // Fields passed via the print_block() function.
);

// Returns updated $abs_defaults array with classes from Gutenberg or from the print_block() function.
// Returns formatted attributes as $abs_atts array.
[ $abs_defaults, $abs_atts ] = setup_block_defaults( $abs_args, $abs_defaults, $abs_block );

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_accordion = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( array( 'accordion_items' ), $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . '../assets/images/block-previews/accordion-preview.jpg' ); ?>"
			alt="<?php esc_html_e( 'Preview of the Accordion Block', 'demchco' ); ?>"
		>
	</figure>
<?php elseif ( $abs_accordion['accordion_items']['items'] ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		if ( ! empty( $abs_defaults['allowed_innerblocks'] ) ) :
			echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />';
		endif;

		print_module( 'accordion', $abs_accordion['accordion_items'] );
		?>
	</section>
<?php endif; ?>
