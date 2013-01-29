<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Styles extends Media{
	const EXT = '.css';

	const CSS_PATH = 'styles/css/';

	const BASE = 0; // Reset, normalize, etc.
	
	const INCLUDED = 10; // Forms, colors

	const PLUGIN = 20; // CSS for JS plugins

	const TEMPLATE = 30; // Global stylsheet
	
	const CUTOFF = 30; // The cutoff for what goes in the combined production stylesheet

	const PAGE = 40; // 1-page tweaks
	
	public static function add ($name, $priority, $type = 'styles')
	{
		parent::add($name, $priority, $type);
	}

	public static function output ($profile = 'default')
	{
		$assets = Media::get_assets($profile, 'styles');

		$sheets = Styles::prepare($assets, 'priority', 'styles');

		// if production
		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			echo HTML::style('prod/styles/'.$profile.Styles::EXT);
		}

		foreach ($sheets AS $file)
		{
			// Dev: output everything, Prod: only if more specific than template (otherwise it's in the combined prod stylesheet)
			if ((Kohana::$environment !== Kohana::PRODUCTION) OR ($file['priority'] > Styles::CUTOFF))
			{
				$path = Styles::MEDIA_FOLDER.'/'.$file['prefix'].Styles::CSS_PATH.$file['name'].Styles::EXT;
				echo HTML::style($path);
			}
		}
	}
	
	public static function prepare_production_file ($profile = 'default')
	{
		Styles::add_defaults($profile, 'styles');
		Styles::add_plugins($profile, 'styles');
		
		// Sort the sheets by priority
		if (isset(Styles::$_buffer[$profile]))
		{
			$sheets = Styles::prepare(Styles::$_buffer[$profile], 'priority', 'styles');
		}
		else {
			$sheets = array();
		}
		
		$return = array();
		foreach ($sheets AS $file)
		{
			// Add in everything that is global
			if ($file['priority'] <= Styles::CUTOFF)
			{
				$path = $file['prefix'].Styles::CSS_PATH.$file['name'];
				$return_file = array(
					'path' => $path,
					'ext' => 'css',
				);
				
				$return[] = $return_file;
			}
		}

		return $return;
	}
}