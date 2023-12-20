<?php
/**
 * Figuren_Theater Theater Label_Printing.
 *
 * @package figuren-theater/ft-theater
 */

namespace Figuren_Theater\Theater\Label_Printing;

use Figuren_Theater;

use FT_VENDOR_DIR;

use function add_action;
use function add_filter;
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
function bootstrap(): void {
	add_action( 'init', __NAMESPACE__ . '\\load_plugin', -1 );
}

/**
 * Conditionally load the plugin itself and its modifications.
 *
 * @return void
 */
function load_plugin(): void {

	$config = Figuren_Theater\get_config()['modules']['theater'];
	if ( ! $config['label-printing'] ) {
		return;
	}

	// Do only load in "normal" admin view & public views.
	// Not for:
	// - network-admin views
	// - user-admin views.
	if ( is_network_admin() || is_user_admin() ) {
		return;
	}

	require_once FT_VENDOR_DIR . PLUGINPATH; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

	add_filter(
		'Figuren_Theater\Label_Printing\Patterns\bootstrap_labels',
		__NAMESPACE__ . '\\filter_default_labels'
	);
}

/**
 * Swap out the default labels, that will be created if none exist.
 *
 * @param array<int, array<string, string|int|float>> $default_labels An array of static default label configurations.
 *
 * @return array<int, array<string, string|int|float>>
 */
function filter_default_labels( array $default_labels ): array {
	$default_labels = [
		[
			'name'         => 'A6 Landscape (4 Stück)',
			'width'        => 148,
			'height'       => 105,
			'a4_border_tb' => 0,
			'a4_border_lr' => 0,
			'orientation'  => 'landscape',
		],
		[
			'name'         => 'niceday (8 Stück)',
			'width'        => 105,
			'height'       => 74,
			'a4_border_tb' => 0,
			'a4_border_lr' => 0,
			'orientation'  => 'portrait',
		],
		[
			'name'         => 'HERMA Neon No. 5147 (8 Stück)',
			'width'        => 96,
			'height'       => 67,
			'a4_border_tb' => 14,
			'a4_border_lr' => 9,
			'orientation'  => 'portrait',
		],
		[
			'name'         => 'LABELident (64 Stück)',
			'width'        => 48,
			'height'       => 17,
			'a4_border_tb' => 13,
			'a4_border_lr' => 8,
			'orientation'  => 'portrait',
		],
	];
	return $default_labels;
}
