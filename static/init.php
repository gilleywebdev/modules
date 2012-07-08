<?php defined('SYSPATH') or die('No direct script access.');

/*
 * Default to static plus controller. Static plus calls static is the action isn't found
*/

Route::set('default', '(<action>)')
	->defaults(array(
		'controller' => 'staticplus',
		'action'     => 'index',
	));