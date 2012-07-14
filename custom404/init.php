<?php defined('SYSPATH') or die('No direct script access.');

Route::set('error', 'error/<action>(/<message>)', array('action' => '[0-9]++', 'message' => '.+'))
->defaults(array(
    'controller' => 'Error_Handler',
));

if (Kohana::$errors === FALSE)
{
	set_exception_handler(array('Kohana_Exception_Custom', 'handler'));
}