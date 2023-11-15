<?php
/**
 * Display SVG Markup.
 */

namespace demchco\blocks;

/**
 * Display SVG Markup.
 *
 * @param array $args The parameters needed to get the SVG.
 */
function print_svg( $args = array() ) {
	$kses_defaults = wp_kses_allowed_html( 'post' );

	$svg_args = array(
		'svg'   => array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!
			'color'           => true,
			'stroke-width'    => true,
		),
		'g'     => array( 'color' => true ),
		'title' => array(
			'title' => true,
			'id'    => true,
		),
		'path'  => array(
			'd'     => true,
			'color' => true,
		),
		'use'   => array(
			'xlink:href' => true,
		),
	);

	$allowed_tags = array_merge(
		$kses_defaults,
		$svg_args
	);

	echo wp_kses(
		get_svg( $args ),
		$allowed_tags
	);
}
