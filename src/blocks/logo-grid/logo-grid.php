<?php
/**
 * BLOCK - Renders a Logo Grid section
 *
 * @link https://developer.wordpress.org/block-editor/
 */

use function demchco\blocks\get_acf_fields;
use function demchco\blocks\print_module;
use function demchco\blocks\setup_block_defaults;

$abs_block = isset( $block ) ? $block : '';
$abs_args  = isset( $args ) ? $args : '';

$abs_defaults = [
	'class'               => [ 'demchco-block', 'demchco-block-logo-grid' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];

// Returns updated $abs_defaults array with classes from Gutenberg or from the print_block() function.
// Returns formatted attributes as $abs_atts array.
[ $abs_defaults, $abs_atts ] = setup_block_defaults( $abs_args, $abs_defaults, $abs_block );

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_logo_grid = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( [ 'logos' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . '../assets/images/block-previews/logo-grid-preview.jpg' ); ?>"
			alt="<?php esc_html_e( 'Preview of the Logo Grid Block', 'demchco' ); ?>"
		>
	</figure>
<?php elseif ( $abs_logo_grid['logos'] ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		if ( ! empty( $abs_defaults['allowed_innerblocks'] ) ) :
			echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />';
		endif;
		?>
		<div class="demchco-grid">
			<?php
			foreach ( $abs_logo_grid['logos'] as $abs_logo ) :
				print_module(
					'figure',
					$abs_logo
				);
			endforeach;
			?>
		</div>
	</section>
<?php endif; ?>
