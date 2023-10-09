<?php
/**
 * Figuren_Theater theater.
 *
 * @package figuren-theater/theater
 */

namespace Figuren_Theater\theater;

use Altis;

/**
 * Register module.
 *
 * @return void
 */
function register() :void {

	$default_settings = [
		'enabled' => true, // Needs to be set.
	];
	$options = [
		'defaults' => $default_settings,
	];

	Altis\register_module(
		'theater',
		DIRECTORY,
		'theater',
		$options,
		__NAMESPACE__ . '\\bootstrap'
	);
}

/**
 * Bootstrap module, when enabled.
 *
 * @return void
 */
function bootstrap() :void {

	/**
	 * Automatically load Plugins.
	 *
	 * @example NameSpace\bootstrap();
	 */

	/**
	 * Load 'Best practices'.
	 *
	 * @example NameSpace\bootstrap();
	 */
}
