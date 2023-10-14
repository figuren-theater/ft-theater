<?php
/**
 * Figuren_Theater Theater Label_Printing.
 *
 * @package figuren-theater/ft-theater
 */

namespace Figuren_Theater\Theater\Label_Printing;

use FT_VENDOR_DIR;

use function add_action;
use function is_network_admin;
use function is_user_admin;

const BASENAME   = 'label-printing/plugin.php';
const PLUGINPATH = '/figuren-theater/' . BASENAME;
// const PLUGINPATH = '/wpackagist-plugin/' . BASENAME; // Not yet, see #6.

/**
 * Bootstrap module, when enabled.
 *
 * @return void
 */
function bootstrap() :void {
	add_action( 'init', __NAMESPACE__ . '\\load_plugin', -1 );
}

/**
 * Conditionally load the plugin itself and its modifications.
 *
 * @return void
 */
function load_plugin() :void {

	// Do only load in "normal" admin view & public views.
	// Not for:
	// - network-admin views
	// - user-admin views.
	if ( is_network_admin() || is_user_admin() ) {
		return;
	}

	require_once FT_VENDOR_DIR . PLUGINPATH; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant
}

