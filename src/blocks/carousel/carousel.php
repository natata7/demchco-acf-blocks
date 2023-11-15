<?php

/**
 * BLOCK - Renders a Carousel
 *
 * @link https://developer.wordpress.org/block-editor/
 */

use function demchco\blocks\get_acf_fields;
use function demchco\blocks\print_element;
use function demchco\blocks\print_module;
use function demchco\blocks\setup_block_defaults;

$abs_block = isset( $block ) ? $block : '';
$abs_args  = isset( $args ) ? $args : '';

$abs_defaults = array(
	'class'               => array( 'wds-block', 'wds-block-carousel' ),
	'show_arrows'         => true,
	'show_pagination'     => true,
	'allowed_innerblocks' => array( '' ),
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => array(), // Fields passed via the print_block() function.
);

// Returns updated $abs_defaults array with classes from Gutenberg or from the print_block() function.
// Returns formatted attributes as $abs_atts array.
[$abs_defaults, $abs_atts] = setup_block_defaults( $abs_args, $abs_defaults, $abs_block );

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_carousels = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( array( 'slides' ), $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . '../assets/images/block-previews/carousel-preview.jpg' ); ?>" alt="<?php esc_html_e( 'Preview of the Carousel Block', 'demchco' ); ?>">
	</figure>
<?php elseif ( $abs_carousels['slides'] ) : ?>
	<section 
	<?php
	echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
				>
		<?php
		if ( ! empty( $abs_defaults['allowed_innerblocks'] ) ) :
			echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />';
		endif;
		?>
		<section class="carousel-wrap">
			<div class="gallery-top">
				<div class="gallery-slider gallery-slider-top swiper swiper-slider">
					<div class="swiper-wrapper carousel-items">
						<?php foreach ( $abs_carousels['slides'] as $abs_slide ) : ?>
							<div class="gallery-slider-top-item swiper-slide carousel-item">
								<?php
								if ( $abs_slide['attachment_id'] ) :
									print_element(
										'image',
										array(
											'attachment_id' => $abs_slide['attachment_id'],
										)
									);
								endif;
								?>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>

			<div class="carousel-wrap__bottom-wrap">
				<div class="gallery-bottom">
					<div class="gallery-slider gallery-slider-bottom swiper-slider">
						<div class="swiper-wrapper carousel-items">
							<?php foreach ( $abs_carousels['slides'] as $abs_slide ) : ?>
								<div class="gallery-slider-bottom-item swiper-slide carousel-item">
									<?php
									if ( $abs_slide['attachment_id'] ) :
										print_element(
											'image',
											array(
												'attachment_id' => $abs_slide['attachment_id'],
											)
										);
									endif;
									?>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				</div>
				<div class="carousel-wrap__nav-wrap">

					<div class="carousel-wrap__pagination-wrap">
						<div class="slider-pagination"></div>
					</div>

					<div class="carousel-button carousel-button__button-prev slider-button-prev btn">
						<svg class="btn-arrow">
							<use xlink:href="#arrow"></use>
						</svg>
					</div>
					<div class="carousel-button carousel-button__button-next slider-button-next btn">
						<svg class="btn-arrow">
							<use xlink:href="#arrow"></use>
						</svg>
					</div>

				</div>
			</div>

		</section>
	</section>
<?php endif; ?>
