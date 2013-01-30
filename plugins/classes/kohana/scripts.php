<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Scripts extends Media {
	const EXT = 'js';

	const JS_PATH = 'scripts/max/';

	const FRAMEWORK = 0; // jQuery, Prototype etc.

	const DEPENDENCY = 10; // jQuery UI and other dependencies

	const PLUGIN = 20; // Plugins
	
	const CUTOFF = 20; // The cutoff for what goes in the combined production script

	const CONTROLLER = 30; // Controllers

	public static function add ($name, $priority = Scripts::CONTROLLER, $type = 'scripts')
	{
		parent::add($name, $priority, $type);
	}

	public static function output ($profile = 'default')
	{
		$scripts = Media::get_assets($profile, 'scripts');
		
		// if production
		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			echo HTML::script('media/scripts/prod/'.$profile.'.'.Scripts::EXT);
		}
		
		foreach($scripts AS $file)
		{
			// Dev: output everything, Prod: only if more specific than plugin (otherwise it's in the combined prod script)
			if ((Kohana::$environment !== Kohana::PRODUCTION) OR ($file['priority'] > Scripts::CUTOFF))
			{
				$path = Media::MEDIA_FOLDER.'/'.Scripts::get_path($file).'.'.Scripts::EXT;
				echo HTML::script($path);
			}
		}
	}
	
	public static function get_path ($file)
	{
		$path = $file['prefix'].Scripts::JS_PATH.$file['name'];
		return $path;
	}
}