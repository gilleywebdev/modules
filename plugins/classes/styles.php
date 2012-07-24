<?php defined('SYSPATH') or die('No direct script access.');

class Styles {
	const PRE_EXT = '.scss';

	const POST_EXT = '.css';
	
	const FOLDER = 'media';

	const CSS_PATH = 'styles/css';

	const PROD_CSS_SHEET = 'styles.css';

	const BASE = 0; // Reset, normalize, etc.
	
	const INCLUDED = 10; // Forms, colors

	const TEMPLATE = 20; // Global stylsheet

	const CATEGORY = 30; // Subpage, admin

	const PLUGIN = 40; // CSS for JS plugins

	const PAGE = 50; // 1-page tweaks

	protected static $_sheets = array();

	public static function add($name, $priority = 20, $prefix = '')
	{	
		if (in_array($name, Styles::$_sheets))
		{
			return false;
		}
		else{
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
		if($defaults)
		{
			foreach($defaults AS $default)
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
		}
		
		// Sort the sheets by priority
		$sheets = Styles::sksort(Styles::$_sheets, 'priority', TRUE);

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
				$path = Styles::FOLDER.'/'.$prefix.Styles::CSS_PATH.'/'.$sheet['name'].Styles::POST_EXT;
				echo HTML::style($path);
			}
		}
	}

	private static function sksort($array, $subkey, $sort_ascending=false) {

	    if (count($array))
	        $temp_array[key($array)] = array_shift($array);
		else
			return array();

	    foreach($array as $key => $val){
	        $offset = 0;
	        $found = false;
	        foreach($temp_array as $tmp_key => $tmp_val)
	        {
	            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
	            {
	                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
	                                            array($key => $val),
	                                            array_slice($temp_array,$offset)
	                                          );
	                $found = true;
	            }
	            $offset++;
	        }
	        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
	    }

	    if ($sort_ascending) $array = array_reverse($temp_array);

	    else $array = $temp_array;
	
		return $array;
	}
}