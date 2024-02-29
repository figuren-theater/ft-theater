<?php
/**
 * Figuren_Theater Theater Production_Subsites.
 *
 * @package figuren-theater/ft-theater
 */

namespace Figuren_Theater\Theater\Production_Subsites;

use Figuren_Theater;
use FT_VENDOR_DIR;
use function add_action;
use function is_network_admin;
use function is_user_admin;

const BASENAME   = 'theater-production-subsites/plugin.php';
const PLUGINPATH = '/figuren-theater/' . BASENAME;

/**
 * Bootstrap module, when enabled.
 *
 * @return void
 */
function bootstrap(): void {
	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugin', 9 );
}

/**
 * Conditionally load the plugin itself and its modifications.
 *
 * @return void
 */
function load_plugin(): void {

	// Do only load in "normal" admin view & public views.
	// Not for:
	// - network-admin views
	// - user-admin views.
	if ( is_network_admin() || is_user_admin() ) {
		return;
	}

	require_once FT_VENDOR_DIR . PLUGINPATH; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

	/**
	 * Register post_type support for our current(!) post_type 'ft_production'
	 * until the great re-invention of the "Theater" WordPress plugin is done.
	 * 
	 * @todo https://github.com/figuren-theater/ft-theater/issues/13 Deprecate 'ft_production' in favor of 'wp_theatre_prod'
	 * 
	 * @see  https://github.com/users/slimndap/projects/2 "Theater 1.0"
	 */
	\add_post_type_support( 'ft_production', Figuren_Theater\Production_Subsites\PT_SUPPORT );

	/**
	 * Register post_type supports for the new-to-be-created sub-post_types.
	 * 
	 * At least a minimal compatibility with some 3rd-party plugins.
	 * 
	 * - carstingaxion/cbstdsys-subtitles
	 * - figuren-theater/ft-theming
	 */
	\array_map(
		__NAMESPACE__ . '\\add_post_type_supports',
		Figuren_Theater\Production_Subsites\Registration\get_sub_types()
	);
}


/**
 * Add supports for each given post_type.
 *
 * @param  string $post_type The given post_type slug.
 *
 * @return void
 */
function add_post_type_supports( string $post_type ): void {
	// Registered in carstingaxion/cbstdsys-subtitles.
	\add_post_type_support(
		$post_type,
		'ft_sub_title'
	);
	// Registered in figuren-theater/ft-theming.
	\add_post_type_support(
		$post_type,
		'post-type-templates',
		[
			'templates' => [
				'blank.php' => \_x( 'Blank', 'Template Title', 'figurentheater' ),
			],
		]
	);
}
