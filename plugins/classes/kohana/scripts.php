<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Scripts extends Media {
	const EXT = '.js';

	const JS_PATH_DEV = 'scripts/max/';
	
	const JS_PATH_PROD = 'scripts/min/';
	
	const FRAMEWORK = 0;
	
	const DEPENDENCY = 10;
	
	const PLUGIN = 20;
	
	const CONTROLLER = 30;

	public static function add($name, $priority, $type = 'scripts')
	{
		parent::add($name, $priority, $type);
	}

	public static function output($prod_script = NULL, $defaults = NULL)
	{
		if ($defaults !== NULL)
		{
			Scripts::add_defaults($defaults, 'scripts');
		}
		
		// Sort the scripts by priority
		$scripts = Scripts::prepare(Scripts::$_buffer, 'priority', 'scripts');

		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			$scripts_folder = Scripts::JS_PATH_PROD;
			$min = '.min';

			// Break prefixes out of the first parameter
			if (strpos($prod_script, '/') !== FALSE)
			{
				$pieces = explode('/', $prod_script);

				$name = array_pop($pieces);
				$prefix = implode('/', $pieces);
			}
			else
			{
				$prefix = NULL;
				$name = $prod_script;
			}

			if ($prod_script !== NULL)
			{
				echo HTML::script(Scripts::MEDIA_FOLDER.$prefix.$scripts_folder.$name.$min.Scripts::EXT);
			}
		}
		else
		{
			$scripts_folder = Scripts::JS_PATH_DEV;
			$min = '';
		}

		foreach($scripts AS $script)
		{
			$prefix = $script['prefix'] ? $script['prefix'].'/' : '';
			
			// Dev: everything, Prod:priority > 20
			if ((Kohana::$environment !== Kohana::PRODUCTION) OR ($script['priority'] > Scripts::PLUGIN))
			{
				$path = Scripts::MEDIA_FOLDER.$prefix.$scripts_folder.$script['name'].$min.Scripts::EXT;
				echo HTML::script($path);
			}
		}
	}
}