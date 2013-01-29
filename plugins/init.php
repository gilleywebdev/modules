<?php defined('SYSPATH') or die('No direct script access.');

// Static file serving (CSS, JS, images)
Route::set('media', 'media(/<file>)', array('file' => '.+'))
	->defaults(array(
		'controller'	=> 'assets',
		'action'    	=> 'media',
		'file'      	=> NULL,
	));