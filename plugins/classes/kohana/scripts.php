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

	public static function output ($prodfile = NULL, $defaults = NULL)
	{
		// Add defaults
		if ($defaults !== NULL)
		{
			Scripts::add_defaults($defaults, 'scripts');
		}
		
		// Sort the scripts by priority
		$scripts = Scripts::prepare(Scripts::$_buffer, 'priority', 'scripts');

		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			// Production settings
			$folder = Scripts::JS_PATH_PROD;
			$min = '.min';

			// Parse for slashes
			$file = Media::parse($prodfile);

			// Production (combined, compressed) script
			if ($prodfile !== NULL)
			{
				echo HTML::script(Scripts::MEDIA_FOLDER.$file['prefix'].$folder.$file['name'].$min.Scripts::EXT);
			}
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
			if ((Kohana::$environment !== Kohana::PRODUCTION) OR ($file['priority'] > Scripts::PLUGIN))
			{
				$path = Scripts::MEDIA_FOLDER.$file['prefix'].$folder.$file['name'].$min.Scripts::EXT;
				echo HTML::script($path);
			}
		}
	}
}