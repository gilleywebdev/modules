<?php defined('SYSPATH') or die('No direct script access.');

// Configures headers for downloadable files
Route::set('download', 'download/<file>', array('file' => '[^/]+'))
	->defaults(array(
		'controller' => 'download',
		'action'     => 'public',
	));