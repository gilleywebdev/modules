<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Styles extends Media{
	const PRE_EXT = '.scss';

	const POST_EXT = '.css';

	const CSS_PATH = 'styles/css/';

	const BASE = 0; // Reset, normalize, etc.
	
	const INCLUDED = 10; // Forms, colors

	const PLUGIN = 20; // CSS for JS plugins

	const TEMPLATE = 30; // Global stylsheet

	const PAGE = 40; // 1-page tweaks
	
	public static function add ($name, $priority, $type = 'styles')
	{
		parent::add($name, $priority, $type);
	}
	
	public static function output ($prodfile = NULL, $defaults = NULL)
	{
		// Add defaults
		if ($defaults !== NULL)
		{
			Styles::add_defaults($defaults, 'styles');
		}

		// Sort the sheets by priority
		$sheets = Styles::prepare(Styles::$_buffer, 'priority', 'styles');

		// if production
		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			// Parse for slashes
			$file = Media::parse($prodfile);

			// Production (combined, compressed) stylesheet
			if ($prodfile !== NULL)
			{
				echo HTML::style(Styles::MEDIA_FOLDER.$file['prefix'].Styles::CSS_PATH.$file['name'].Styles::POST_EXT);
			}
		}

		foreach ($sheets AS $file)
		{
			// Dev: output everything, Prod: only if more specific than template (otherwise it's in the combined prod stylesheet)
			if ((Kohana::$environment !== Kohana::PRODUCTION) OR ($sheet['priority'] > Styles::TEMPLATE))
			{
				$path = Styles::MEDIA_FOLDER.$file['prefix'].Styles::CSS_PATH.$file['name'].Styles::POST_EXT;
				echo HTML::style($path);
			}
		}
	}
}