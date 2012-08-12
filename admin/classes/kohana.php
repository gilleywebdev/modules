<?php defined('SYSPATH') or die('No direct script access.');

class Kohana extends Kohana_Core {
	public static function message($file, $path = NULL, $default = NULL)
	{
		$message = parent::message($file, $path, $default);

		if (! $message)
		{
			throw new Kohana_Exception('Message not found at '.$file.$path);
		}
		else{
			return $message;
		}
	}
}