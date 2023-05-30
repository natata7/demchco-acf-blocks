<?php
/**
 * Plugin Name: Demchco ACF Blocks
 * Description: A set of custom Gutenberg blocks built lovingly with Advanced Custom Fields.
 * Author: Demch.co
 * Version: 1.0.0
 * Text Domain: demchco
 *
 * @package demchco
 */

namespace demchco\blocks;

// Define a global version number.
define( 'DEMCHCO_ACF_VERSION', '1.0.0' );
define( 'DEMCHCO_ROOT_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'DEMCHCO_ROOT_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Check to see if ACF Pro is active.
 */
function blocks_has_parent_plugin() {
	if ( is_admin() && current_user_can( 'activate_plugins' ) && ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) || ! is_portable() ) ) {

		// If we try to activate this plugin while the parent plugin isn't active.
		if ( isset( $_GET['activate'] ) && ! wp_verify_nonce( $_GET['activate'] ) ) {
			add_action( 'admin_notices', __NAMESPACE__ . '\blocks_parent_plugin_notice' );
			unset( $_GET['activate'] );
			// If we deactivate the parent plugin while this plugin is still active.
		} elseif ( ! isset( $_GET['activate'] ) ) {
			add_action( 'admin_notices', __NAMESPACE__ . '\blocks_parent_plugin_notice' );
			unset( $_GET['activate'] );
		}

		deactivate_plugins( plugin_basename( __FILE__ ) );

	}
}
add_action( 'admin_init', __NAMESPACE__ . '\blocks_has_parent_plugin' );


/**
 * Provide a notice message if the parent plugin has been deactivated.
 */
function blocks_parent_plugin_notice() {
	?>
	<div class="error">
		<p><?php esc_html_e( 'Demchco ACF Blocks has been deactivated because Advanced Custom Fields Pro 6.0+ has been deactivated. Advanced Custom Fields Pro 6.0+ must be active in order for you to use Demchco ACF Blocks.', 'demchco' ); ?></p>
	</div>
	<?php
}


/**
 * Register Blocks
 */
function register_blocks() {
	$acf_blocks = glob( plugin_dir_path( __FILE__ ) . 'build/*' );

	foreach ( $acf_blocks as $block ) {
		register_block_type( $block );
	}
}
add_action( 'acf/init', __NAMESPACE__ . '\register_blocks' );

/**
 * Includes helper files
 *
 * @return void
 */
function include_helper_files() {
	$files = [
		'inc/helpers/',
		'wpcli/',
		'inc/',
	];

	foreach ( $files as $include ) {
		$include = trailingslashit( DEMCHCO_ROOT_PATH ) . $include;

		// Loop into the directory for php files.
		foreach ( glob( $include . '*.php' ) as $file ) {
			require $file;
		}
	}
}
include_helper_files();
