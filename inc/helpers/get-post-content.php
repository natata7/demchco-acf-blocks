<?php
/**
 * Filters WYSIWYG content with the_content filter.
 */

namespace demchco\blocks;

/**
 * Filters WYSIWYG content with the_content filter.
 *
 * @param string $content content dump from WYSIWYG.
 *
 * @return string|bool Content string if content exists, else empty.
 */
function get_post_content( $content ) {
	return ! empty( $content ) ? $content : false;
}

add_filter( 'the_content', __NAMESPACE__ . '\get_post_content', 20 );
