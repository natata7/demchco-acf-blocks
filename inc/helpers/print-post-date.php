<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 */

namespace demchco\blocks;

/**
 * Prints HTML with date information for the current post.
 *
 * @param array $args Configuration args.
 */
function print_post_date( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'date_text'   => esc_html__( 'Posted on', 'abs' ),
		'date_format' => get_option( 'date_format' ),
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );
	?>
	<span class="posted-on">
		<?php echo esc_html( $args['date_text'] . ' ' ); ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_time( $args['date_format'] ) ); ?></time></a>
	</span>
	<?php
}
