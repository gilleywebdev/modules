<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Scripts extends Media {
	const EXT = '.js';

	const JS_PATH_DEV = 'scripts/max/';

	const JS_PATH_PROD = 'scripts/min/';

	const FRAMEWORK = 0; // jQuery, Prototype etc.

	const DEPENDENCY = 10; // jQuery UI and other dependencies

	const PLUGIN = 20; // Plugins
	
	const CUTOFF = 20; // The cutoff for what goes in the combined production script

	const CONTROLLER = 30; // Controllers

	public static function add($name, $priority, $type = 'scripts')
	{
		parent::add($name, $priority, $type);
	}

	public static function output ($profile = 'default')
	{
		Scripts::add_defaults($profile, 'scripts');
		Scripts::add_plugins($profile, 'scripts');
		
		// Sort the scripts by priority
		$scripts = Scripts::prepare(Scripts::$_buffer, 'priority', 'scripts');

		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			// Production settings
			$folder = Scripts::JS_PATH_PROD;
			$min = '.min';

			echo HTML::script('prod/scripts/'.$profile.Scripts::EXT);
		}
		else
		{
			// Development settings
			$folder = Scripts::JS_PATH_DEV;
			$min = '';
		}

		foreach($scripts AS $file)
		{
			// Dev: output everything, Prod: only if more specific than plugin (otherwise it's in the combined prod script)
			if ((Kohana::$environment !== Kohana::PRODUCTION) OR ($file['priority'] > Scripts::CUTOFF))
			{
				$path = Scripts::MEDIA_FOLDER.$file['prefix'].$folder.$file['name'].$min.Scripts::EXT;
				echo HTML::script($path);
			}
		}
	}

	public static function prepare_production_file ($profile = 'default')
	{
		Scripts::add_defaults($profile, 'scripts');
		Scripts::add_plugins($profile, 'scripts');
		
		// Sort the sheets by priority
		$scripts = Scripts::prepare(Scripts::$_buffer, 'priority', 'scripts');
		
		$return = array();
		foreach ($scripts AS $file)
		{
			// Add in everything that is global
			if ($file['priority'] <= Scripts::CUTOFF)
			{
				$path = $file['prefix'].Scripts::JS_PATH_PROD.$file['name'];
				$return_file = array(
					'path' => $path,
					'ext' => 'min.js',
				);
				
				$return[] = $return_file;
			}
		}
		
		return $return;
	}

}