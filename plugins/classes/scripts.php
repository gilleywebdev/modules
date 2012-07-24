<?php defined('SYSPATH') or die('No direct script access.');

class Scripts {
	const EXT = '.js';

	const JS_PATH = 'media/scripts/js/';

	const PROD_JS_SCRIPT = 'script.js';
	
	const FRAMEWORK = 0;
	
	const PLUGIN = 10;
	
	const CONTROLLER = 20;

	protected static $_scripts = array();

	public static function add($name, $priority = 10)
	{
		if (in_array($name, Scripts::$_scripts))
		{
			return false;
		}
		else{
			Scripts::$_scripts[] = array(
				'name' => $name,
				'priority' => $priority
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
				if(isset($default[1])){
					Scripts::add($default[0], $default[1]);
				}
				else{
					Scripts::add($default[0]);
				}
			}
		}
		
		// Sort the scripts by priority
		$scripts = Scripts::sksort(Scripts::$_scripts, 'priority', TRUE);

		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			echo HTML::style(Scripts::JS_PATH.Scripts::PROD_JS_SCRIPT);	
		}

		foreach($scripts AS $script)
		{
			if ((Kohana::$environment !== Kohana::PRODUCTION))
			{
				$path = Scripts::JS_PATH.$script['name'].Scripts::EXT;
				echo HTML::script($path);
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