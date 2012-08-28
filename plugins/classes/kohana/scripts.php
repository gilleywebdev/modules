<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Scripts extends Media {
	const EXT = '.js';

	const JS_PATH = 'scripts/max/';

	const PROD_JS_SCRIPT = 'script.js';
	
	const FRAMEWORK = 0;
	
	const DEPENDENCY = 10;
	
	const PLUGIN = 20;
	
	const CONTROLLER = 30;

	public static function add($name, $priority, $type = 'scripts')
	{
		parent::add($name, $priority, $type);
	}

	public static function output($defaults = array())
	{	
		Scripts::add_defaults($defaults, 'scripts');
		
		// Sort the scripts by priority
		$scripts = Scripts::prepare(Scripts::$_buffer, 'priority', 'scripts');

		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			echo HTML::style(Scripts::JS_PATH.Scripts::PROD_JS_SCRIPT);	
		}

		foreach($scripts AS $script)
		{
			$prefix = $script['prefix'] ? $script['prefix'].'/' : '';
			
			if ((Kohana::$environment !== Kohana::PRODUCTION))
			{
				$path = Scripts::MEDIA_FOLDER.$prefix.Scripts::JS_PATH.$script['name'].Scripts::EXT;
				echo HTML::script($path);
			}
		}
	}
}