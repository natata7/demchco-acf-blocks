<?php

/**
 * @link https://developer.wordpress.org/block-editor/
 */

use function demchco\blocks\get_acf_fields;
use function demchco\blocks\setup_block_defaults;

$abs_block = isset($block) ? $block : '';
$abs_args  = isset($args) ? $args : '';

$abs_defaults = [
	'class'               => ['demchco-block', 'demchco-block-crosslink'],
	'allowed_innerblocks' => [''],
	'id'                  => (isset($block) && !empty($block['anchor'])) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];

// Returns updated $abs_defaults array with classes from Gutenberg or from the print_block() function.
// Returns formatted attributes as $abs_atts array.
[$abs_defaults, $abs_atts] = setup_block_defaults($abs_args, $abs_defaults, $abs_block);

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_crosslink = !empty($abs_defaults['fields']) ? $abs_defaults['fields'] : get_acf_fields(['publication-id', 'heading'], $block['id']);

?>

<?php if (!empty($abs_block['data']['_is_preview'])) : ?>
	<figure>
		<img src="<?php echo esc_url(plugin_dir_url(__DIR__) . '../assets/images/block-previews/call-to-action-preview.jpg'); ?>" alt="<?php esc_html_e('Preview of the Crosslink Block', 'demchco'); ?>">
	</figure>
<?php else : ?>
	<section <?php echo $abs_atts; ?>>
		<div class="crosslink__introduction">
			<?php _e('Читайте також', 'demchco'); ?>
		</div>
		<div class="crosslink crosslink-wrap">

			<?php if ($abs_crosslink['publication-id']) :
				$sections = get_the_terms($abs_crosslink['publication-id'], 'section');
				if ($sections) {
					$section = array_shift($sections);
				};
				$external_link = get_field('external-link', $abs_crosslink['publication-id']);
				$external_link_arr = parse_url($external_link);
			?>

				<?php if (isset($section)) : ?>
					<a href="<?php echo get_term_link($section->slug, 'section'); ?>" class="crosslink__section">

						<svg class="crosslink__section--icon icon">
							<use xlink:href="#diamond-icon"></use>
						</svg>

						<span>
							<?php echo $section->name; ?>
						</span>
					</a>
				<?php endif; ?>
				<h6 class="crosslink__title">
					<?php echo get_the_title($abs_crosslink['publication-id']); ?>
				</h6>

				<a href="<?php if ($external_link) {
								echo $external_link;
							} else {
								the_permalink();
							}
							?>" class="crosslink__links items-link" <?php if ($external_link) echo 'target="_blank"'; ?>></a>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>
