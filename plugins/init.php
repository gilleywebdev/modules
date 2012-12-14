<?php defined('SYSPATH') or die('No direct script access.');

// Static file serving (CSS, JS, images)
Route::set('media', 'media(/<file>)', array('file' => '.+'))
	->defaults(array(
		'controller'	=> 'assets',
		'action'    	=> 'media',
		'file'      	=> NULL,
	));
	
// Concatenated production styles
Route::set('prodstyles', 'prod/styles/<profile>.css', array('profile' => '.+'))
	->defaults(array(
		'controller'	=> 'assets',
		'action'		=> 'prodstyles',
		'profile'		=> NULL,
	));

// Concatenated production styles
Route::set('prodscripts', 'prod/scripts/<profile>.js', array('profile' => '.+'))
	->defaults(array(
		'controller'	=> 'assets',
		'action'		=> 'prodscripts',
		'profile'		=> NULL,
	));