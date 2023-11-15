<?php
/**
 * Render a block.
 *
 * To be used from a template part to render a block.
 */

namespace demchco\blocks;

/**
 * Example Usage in a template part in wd_s or another theme.
 *
 * Top of file:
 * use function demchco\blocks\print_block;
 *
 * Prints a Call to Action Block.
 * if ( function_exists( 'demchco\blocks\print_block' ) ) :
 *  print_block(
 *      'call-to-action',
 *      [
 *          'allowed_innerblocks' => [],
 *          'fields'              => [
 *              'eyebrow'     => 'CTA Eyebrow text',
 *              'heading'     => 'CTA Heading text',
 *              'content'     => '<p>Lorem ipsum dolor sit amet.</p>',
 *              'button_args' => [
 *                  'button' => [
 *                      'title'  => 'CTA Button Text',
 *                      'target' => '',
 *                  ],
 *              ],
 *              'layout'      => 'center',
 *          ],
 *      ]
 *  );
 * endif;
 */


/**
 * Render a block.
 *
 * @param string $block_name The name of the block.
 * @param array  $args Args for the block.
 */
function print_block( $block_name = '', $args = array() ) {
	if ( ! $block_name ) {
		return;
	}

	// extract args.
	if ( ! empty( $args ) ) {
		extract( $args ); //phpcs:ignore WordPress.PHP.DontExtract.extract_extract -- We can use it here since we know what to expect on the arguments.
	}

	require DEMCHCO_ROOT_PATH . 'src/blocks/' . $block_name . '/' . $block_name . '.php';
}
