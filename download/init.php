<?php defined('SYSPATH') or die('No direct script access.');

Route::set('download', 'download/<file>', array('file' => '[^/]+'))
	->defaults(array(
		'controller' => 'download',
		'action'     => 'public',
	));