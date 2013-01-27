<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_Media {
	const MEDIA_FOLDER = 'media/';

	protected static $_buffer = array();

	// Add the specified media to the buffer
	public static function add ($name, $priority, $type, $profile = 'default')
	{
		// Create the profile buffer if it doesn't exist
		if ( ! isset(Media::$_buffer[$profile]))
		{
			Media::$_buffer[$profile] = array();
		}
		
		// No doubles
		if (in_array($name, Media::$_buffer[$profile]))
		{
			return false;
		}
		else{
			// Break prefixes out of the first parameter
			$file = Media::parse($name);
			
			// Add it to the buffer
			Media::$_buffer[$profile][] = array(
				'name' => $file['name'],
				'priority' => $priority,
				'prefix' => $file['prefix'],
				'type' => $type
			);

			return true;
		}
	}
	
	// Add global styles & scripts from config files
	protected static function add_defaults ($profile, $type)
	{
		$config = Kohana::$config->load($type);
		
		$defaults = $config->get($profile);

		if (is_array($defaults))
		{
			foreach($defaults AS $default)
			{
				if (is_array($default))
				{
					// Name, priority, type, profile
					Media::add($default[0], $default[1], $type, $profile);
				}
				else {
					throw new Kohana_Exception('Expected array, given '.$default.' in add_defaults()');
				}
			}
		}
	}
	
	protected static function add_plugins ($profile, $type)
	{
		$plugins_config = Kohana::$config->load('plugins');
		$schemas_config = Kohana::$config->load('pluginschemas');
		
		$plugins = $plugins_config->get($profile);

		if (is_array($plugins))
		{
			foreach($plugins AS $plugin)
			{
				$schema = $schemas_config->get($plugin);
				if (is_array($schema[$type]))
				{
					$files = $schema[$type];
					foreach ($files AS $file)
					{
						// Name, priority, type, profile
						Media::add($file[0], $file[1], $type, $profile);
					}
				}
			}
		}
	}

	protected static function prepare (array $input, $subkey, $filter)
	{
		$sort_me = array();
		
		// Filter and add stubs to $sort_me
		foreach($input AS $key => $subarray)
		{
			if ($subarray['type'] === $filter)
			{
				$sort_me[$key] = $subarray[$subkey];
			}
		}

		// sort by priority, giving you the keys in desired order
		asort($sort_me);

		$return_me = array();

		// Add the full arrays to $return_me
		foreach($sort_me AS $key => $priority)
		{
			$return_me[] = $input[$key];
		}
		
		return $return_me;
	}
	
	protected static function parse ($name)
	{
		// $name will be either 'string' or 'prefix/string'
		$file = array();

		// Check for slash
		if (strpos($name, '/') !== FALSE)
		{
			$pieces = explode('/', $name);

			$file['name'] = array_pop($pieces);
			$file['prefix'] = implode('/', $pieces).'/';
		}
		else
		{
			$file['prefix'] = '';
			$file['name'] = $name;
		}
		
		return $file;
	}
}