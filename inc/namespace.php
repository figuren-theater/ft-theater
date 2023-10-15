<?php
/**
 * Figuren_Theater Theater.
 *
 * @package figuren-theater/ft-theater
 */

namespace Figuren_Theater\Theater;

use Altis;

/**
 * Register module.
 *
 * @return void
 */
function register() :void {

	$default_settings = [
		'enabled'        => true, // Needs to be set.
		'label-printing' => false,
	];
	$options = [
		'defaults' => $default_settings,
	];

	Altis\register_module(
		'theater',
		DIRECTORY,
		'Theater',
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
	Label_Printing\bootstrap();
}
