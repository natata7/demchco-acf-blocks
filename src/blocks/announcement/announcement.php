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
	'class'               => ['demchco-block', 'demchco-block-announcement'],
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
$abs_announcement = !empty($abs_defaults['fields']) ? $abs_defaults['fields'] : get_acf_fields(['heading', 'event', 'content'], $block['id']);

?>

<?php if (!empty($block['data']['_is_preview'])) : ?>
	<figure>
		<img src="<?php echo esc_url(plugin_dir_url(__DIR__) . '../assets/images/block-previews/hero-preview.jpg'); ?>" alt="<?php esc_html_e('Preview of the Hero Block', 'demchco'); ?>">
	</figure>
<?php elseif ($abs_announcement['event']) : ?>
	<section <?php echo $abs_atts; ?>>

		<?php // Heading.
		if ($abs_announcement['heading']) :
			print_element(
				'heading',
				[
					'text'  => $abs_announcement['heading'],
					'class' => "announcement-block__title",
					'level' => 4,
				]
			);
		endif; ?>

		<div class="announcement__wrap">

			<?php if ($abs_announcement['event']) :
				$sections = get_the_terms($abs_announcement['event'], 'section');
				if ($sections) {
					$section = array_shift($sections);
				};
				$external_link = get_field('external-link', $abs_announcement['event']);
				$external_link_arr = parse_url($external_link);

				$event_status = get_field('event-status', $abs_announcement['event']);
				if (isset($event_status) && $event_status == 'announcement') {
					$announcement = get_field('event-announcement', $abs_announcement['event']);
					$format = $announcement['format'];
					$location = $announcement['location'];
					$registration_status = $announcement['registration-status'];

					$adzhenda = $announcement['adzhenda'];

					$event_datetime_start = get_field('event-datetime-start', $abs_announcement['event']);
					$event_datetime_end = get_field('event-datetime-end', $abs_announcement['event']);
					$timezone = get_field('timezone', $abs_announcement['event']);

					$now = wp_date("U");

					if ($event_datetime_end) {
						$datetime_format = 'd.m.Y g:i';
						$datetime_end_format = 'd.m.Y g:i';
						$end_date_formated = DateTime::createFromFormat('d.m.Y g:i', $event_datetime_end);
						$start_date_formated = DateTime::createFromFormat('d.m.Y g:i', $event_datetime_start);
						if ($start_date_formated->format('d.m.Y') == $end_date_formated->format('d.m.Y')) {
							$datetime_end_format = 'g:i';
						}
					}

					$registration_deadline = $announcement['registration-deadline'];
					if ($registration_deadline) {
						$registration_deadline_formated = DateTime::createFromFormat('d.m.Y g:i', $registration_deadline);

						$isUpcoming = $registration_deadline_formated >= $now ? true : false;
					} else {
						$start_date_formated = DateTime::createFromFormat('d.m.Y g:i', $event_datetime_start);

						$isUpcoming = $registration_deadline_formated->format('U') >= $now ? true : false;
					}
				}

			?>

				<?php if (isset($section)) : ?>
					<a href="<?php echo get_term_link($section->slug, 'section'); ?>" class="announcement__section">

						<svg class="announcement__section--icon icon">
							<use xlink:href="#diamond-icon"></use>
						</svg>

						<span>
							<?php echo $section->name; ?>
						</span>
					</a>
				<?php endif; ?>

				<h6 class="announcement__title">
					<?php echo get_the_title($abs_announcement['event']); ?>
				</h6>
				<div class="announcement__info">

					<?php if ($event_datetime_end) { ?>
						<div class="announcement__event-datetime">
							<div class="announcement__event-datetime--heading">
								<?php _e('Дата та час', 'demchco'); ?>
							</div>

							<div class="announcement__event-datetime--row">
								<time datetime="<?php echo wp_date('c', strtotime($event_datetime_start)); ?>"><?php echo $event_datetime_start; ?></time> &ndash;
							</div>
							<div class="announcement__event-datetime--row">
								<time datetime="<?php echo wp_date('c', strtotime($event_datetime_end)); ?>"><?php echo $end_date_formated->format($datetime_end_format); ?></time>
								<?php if ($timezone) echo $timezone; ?>
							</div>
						</div>
					<?php }
					if ($event_datetime_start) { ?>
						<div class="announcement__event-datetime">
							<div class="announcement__event-datetime--heading">
								<?php _e('Дата та час', 'demchco'); ?>
							</div>
							<div class="announcement__event-datetime--row">
								<time datetime="<?php echo wp_date('c', strtotime($event_datetime_start)); ?>"><?php echo $event_datetime_start; ?></time>
							</div>
							<div class="announcement__event-datetime--row">
								<?php if ($timezone) echo $timezone; ?>
							</div>
						</div>
					<?php } ?>

					<?php if (isset($format)) { ?>
						<div class="announcement__event-location">
							<div class="announcement__event-location--heading">
								<?php _e('Місце проведення', 'demchco'); ?>
							</div>

							<?php if ($format == 'offline' && $location) { ?>
								<?php echo $location; ?>
							<?php } ?>
							<?php if ($format == 'online') { ?>
								<?php _e('Онлайн', 'demchco') ?>
							<?php } ?>
						</div>
					<?php } ?>
				</div>

				<a href="<?php if ($external_link) {
								echo $external_link;
							} else {
								the_permalink();
							}
							?>" class="announcement__links items-link" <?php if ($external_link) echo 'target="_blank"'; ?>></a>
			<?php endif; ?>
		</div>

		<div class="announcement__caption-wrap">
			<?php
			if ($abs_announcement['content']) :
				print_element(
					'content',
					[
						'content' => $abs_announcement['content'],
					]
				);
			endif;

			?>
		</div>

	</section>
<?php endif; ?>
