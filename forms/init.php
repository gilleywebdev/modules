<?php defined('SYSPATH') or die('No direct script access.');

Route::set('contact', 'contact(/<action>)')
	->defaults(array(
		'controller' => 'contact',
		'action'     => 'index',
	));