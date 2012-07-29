<?php defined('SYSPATH') or die('No direct script access.');

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

Route::set('adminpost-login', 'adminpost/login(/<action>)(/<var>)')
	->defaults(array(
		'controller' => 'adminpost_login',
		'action' => 'login'
	));

Route::set('adminpost-news', 'adminpost/news(/<action>)(/<var>)')
	->defaults(array(
		'controller' => 'adminpost_news',
	));