<?php defined('SYSPATH') or die('No direct script access.');

Route::set('admin', 'admin(/<controller>(/<action>))')
	->defaults(array(
		'directory'		=>	'admin',
		'controller'	=>	'dashboard',
		'action'		=>	'index'
	));