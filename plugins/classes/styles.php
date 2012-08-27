<?php defined('SYSPATH') or die('No direct script access.');

class Styles {
	const PRE_EXT = '.scss';

	const POST_EXT = '.css';
	
	const MEDIA_FOLDER = 'media/';

	const CSS_PATH = 'styles/css/';

	const PROD_CSS_SHEET = 'styles.css';

	const BASE = 0; // Reset, normalize, etc.
	
	const INCLUDED = 10; // Forms, colors

	const TEMPLATE = 20; // Global stylsheet

	const CATEGORY = 30; // Subpage, admin

	const PLUGIN = 40; // CSS for JS plugins

	const PAGE = 50; // 1-page tweaks

	protected static $_sheets = array();

	public static function add($name, $priority = Styles::TEMPLATE)
	{	
		if (in_array($name, Styles::$_sheets))
		{
			return false;
		}
		else{
			if(is_array($name))
			{
				$prefix = $name[0];
				$name = $name[1];
			}
			else{
				$prefix = NULL;
			}

			Styles::$_sheets[] = array(
				'name' => $name,
				'priority' => $priority,
				'prefix' => $prefix,
			);
			
			return true;
		}
	}
	
	public static function output($defaults = array())
	{
		if(is_array($defaults))
		{
			foreach($defaults AS $default)
			{
				if(is_array($default))
				{
					if(isset($default[2])){
						Styles::add($default[0], $default[1], $default[2]);
					}
					elseif(isset($default[1])){
						Styles::add($default[0], $default[1]);
					}
					else{
						Styles::add($default[0]);
					}
				}
				else{
					throw new Kohana_Exception('Expected array');
				}
			}
		}
		else
		{
			throw new Kohana_Exception('Expected array');
		}
		
		// Sort the sheets by priority
		$sheets = Styles::subkey_sort(Styles::$_sheets, 'priority');

		// if production, everything below 20 should be in this
		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			echo HTML::style(Styles::CSS_PATH.Styles::PROD_CSS_SHEET);	
		}

		foreach($sheets AS $sheet)
		{
			$prefix = $sheet['prefix']? $sheet['prefix'].'/' : '';
			// Dev: everything, Prod:priority > 20
			if ((Kohana::$environment !== Kohana::PRODUCTION) || ($sheet['priority'] > 20))
			{
				// Set the path up
				$path = Styles::MEDIA_FOLDER.$prefix.Styles::CSS_PATH.$sheet['name'].Styles::POST_EXT;
				echo HTML::style($path);
			}
		}
	}

	private static function subkey_sort(array $input, $subkey) {
		$sort_me = array();
		
		foreach($input AS $key => $subarray)
		{
			$sort_me[$key] = $subarray[$subkey];
		}
		
		asort($sort_me);

		$return_me = array();
		
		foreach($sort_me AS $key => $priority)
		{
			$return_me[] = $input[$key];
		}
		
		return $return_me;
	}
}