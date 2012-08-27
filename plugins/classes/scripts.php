<?php defined('SYSPATH') or die('No direct script access.');

class Scripts {
	const EXT = '.js';
	
	const MEDIA_FOLDER = 'media/';

	const JS_PATH = 'scripts/js/';

	const PROD_JS_SCRIPT = 'script.js';
	
	const FRAMEWORK = 0;
	
	const DEPENDENCY = 10;
	
	const PLUGIN = 20;
	
	const CONTROLLER = 30;

	protected static $_scripts = array();

	public static function add($name, $priority = Scripts::PlUGIN )
	{
		if (in_array($name, Scripts::$_scripts))
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

			Scripts::$_scripts[] = array(
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
					if(isset($default[1])){
						Scripts::add($default[0], $default[1]);
					}
					else{
						Scripts::add($default[0]);
					}
				}
				else{
					throw new Kohana_Exception('Expected array');
				}
			}
		}
		else{
			throw new Kohana_Exception('Expected array');
		}
		
		// Sort the scripts by priority
		$scripts = Scripts::subkey_sort(Scripts::$_scripts, 'priority');

		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			echo HTML::style(Scripts::JS_PATH.Scripts::PROD_JS_SCRIPT);	
		}

		foreach($scripts AS $script)
		{
			$prefix = $script['prefix']? $script['prefix'].'/' : '';
			
			if ((Kohana::$environment !== Kohana::PRODUCTION))
			{
				$path = Scripts::MEDIA_FOLDER.$prefix.Scripts::JS_PATH.$script['name'].Scripts::EXT;
				echo HTML::script($path);
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