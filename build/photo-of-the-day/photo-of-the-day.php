<?php

/**
 * @link https://developer.wordpress.org/block-editor/
 */

use function demchco\blocks\get_acf_fields;
use function demchco\blocks\print_element;
use function demchco\blocks\setup_block_defaults;

$abs_block = isset($block) ? $block : '';
$abs_args  = isset($args) ? $args : '';

$abs_defaults = [
	'class'               => ['demchco-block', 'demchco-block-photo-of-the-day'],
	'show_arrows'         => true,
	'show_pagination'     => true,
	'allowed_innerblocks' => [],
	'id'                  => (isset($block) && !empty($block['anchor'])) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];

// Returns updated $abs_defaults array with classes from Gutenberg or from the print_block() function.
// Returns formatted attributes as $abs_atts array.
[$abs_defaults, $abs_atts] = setup_block_defaults($abs_args, $abs_defaults, $abs_block);

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_photo = !empty($abs_defaults['fields']) ? $abs_defaults['fields'] : get_acf_fields(['image', 'heading', 'eyebrow', 'content', 'author'], $block['id']);

?>

<?php if (!empty($block['data']['_is_preview'])) : ?>
	<figure>
		<img src="<?php echo esc_url(plugin_dir_url(__DIR__) . '../assets/images/block-previews/hero-preview.jpg'); ?>" alt="<?php esc_html_e('Preview of the Hero Block', 'demchco'); ?>">
	</figure>
<?php elseif ($abs_photo['image']) : ?>
	<section <?php echo $abs_atts; ?>>

		<?php // Heading.
		if ($abs_photo['heading']) :
			print_element(
				'heading',
				[
					'text'  => $abs_photo['heading'],
					'class' => "photo-of-the-day__title",
					'level' => 4,
				]
			);
		endif; ?>

		<?php
		// Image.
		if ($abs_photo['image']) :
			print_element(
				'image',
				[
					'attachment_id' => $abs_photo['image']['attachment_id'],
					'class' => "photo-of-the-day__image",
				]
			);
		endif;
		?>

		<div class="photo-of-the-day__caption-wrap">
			<?php
			if ($abs_photo['content']) :
				print_element(
					'content',
					[
						'content' => $abs_photo['content'],
					]
				);
			endif;

			if ($abs_photo['author']) : ?>
				<div class="photo-of-the-day__author-wrap">
					<?php _e('Автор фото:', 'demchco');

					print_element(
						'eyebrow',
						[
							'text' => $abs_photo['author'],
							'class' => "photo-of-the-day__author",
						]
					); ?>
				</div>
			<?php endif;

			?>
		</div>

	</section>
<?php endif; ?>
