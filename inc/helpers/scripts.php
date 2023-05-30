<?php
/**
 * Enqueue scripts and styles.
 */

namespace demchco\blocks;

/**
 * Enqueue admin scripts and styles.
 */
function admin_scripts_styles() {

	// Enqueue global plugin styles for the Admin.
	wp_enqueue_style( 'demchco-admin-styles', DEMCHCO_ROOT_URL . '/dist/admin.css', [], DEMCHCO_ACF_VERSION );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\admin_scripts_styles' );


/**
 * Enqueue frontend scripts and styles.
 */
function frontend_scripts_styles() {

	// Enqueue global plugin styles for the Frontend.
	wp_enqueue_style( 'demchco-frontend-styles', DEMCHCO_ROOT_URL . '/dist/frontend.css', [], DEMCHCO_ACF_VERSION );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\frontend_scripts_styles' );
