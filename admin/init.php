<?php defined('SYSPATH') or die('No direct script access.');

// Static file serving (CSS, JS, images)
Route::set('admin/media', 'admin/media(/<file>)', array('file' => '.+'))
	->defaults(array(
		'controller' => 'admin',
		'action'     => 'media',
		'file'       => NULL,
	));

Route::set('admin', 'admin(/<action>)')
	->defaults(array(
		'controller' => 'admin',
		'action'     => 'index',
	));

Route::set('admin-news', 'admin/news(/<action>)(/<var>)')
	->defaults(array(
		'controller' => 'admin_news',
		'action'     => 'index',
	));
	
Route::set('adminpost-news', 'adminpost/news(/<action>)(/<var>)')
	->defaults(array(
		'controller' => 'adminpost_news',
	));