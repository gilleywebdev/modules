<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Styles extends Media{
	const PRE_EXT = '.scss';

	const POST_EXT = '.css';

	const CSS_PATH = 'styles/css/';

	const BASE = 0; // Reset, normalize, etc.
	
	const INCLUDED = 10; // Forms, colors

	const TEMPLATE = 20; // Global stylsheet

	const CATEGORY = 30; // Subpage, admin

	const PLUGIN = 40; // CSS for JS plugins

	const PAGE = 50; // 1-page tweaks
	
	public static function add ($name, $priority, $type = 'styles')
	{
		parent::add($name, $priority, $type);
	}
	
	public static function output ($prod_sheet = NULL, $defaults = array())
	{
		if ($defaults !== NULL)
		{
			Styles::add_defaults($defaults, 'styles');
		}

		// Sort the sheets by priority
		$sheets = Styles::prepare(Styles::$_buffer, 'priority', 'styles');

		// if production, everything below 20 should be in this
		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			// Break prefixes out of the first parameter
			if (is_array($prod_sheet))
			{
				$prefix = $prod_sheet[0].'/';
				$name = $prod_sheet[1];
			}
			else
			{
				$prefix = NULL;
				$name = $prod_sheet;
			}

			if ($prod_sheet !== NULL)
			{
				echo HTML::style(Styles::MEDIA_FOLDER.$prefix.Styles::CSS_PATH.$name.Styles::POST_EXT);
			}
		}

		foreach ($sheets AS $sheet)
		{
			$prefix = $sheet['prefix']? $sheet['prefix'].'/' : '';
			// Dev: everything, Prod:priority > 20
			if ((Kohana::$environment !== Kohana::PRODUCTION) OR ($sheet['priority'] > Styles::TEMPLATE))
			{
				// Set the path up
				$path = Styles::MEDIA_FOLDER.$prefix.Styles::CSS_PATH.$sheet['name'].Styles::POST_EXT;
				echo HTML::style($path);
			}
		}
	}
}