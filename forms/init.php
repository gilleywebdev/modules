<?php defined('SYSPATH') or die('No direct script access.');

Route::set('contact', 'contact/post')
	->defaults(array(
		'controller' => 'contact',
		'action'     => 'post',
	));