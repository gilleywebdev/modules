<?php defined('SYSPATH') or die('No direct script access.');

Route::set('default', '(<action>)')
	->defaults(array(
		'controller' => 'staticplus',
		'action'     => 'index',
	));