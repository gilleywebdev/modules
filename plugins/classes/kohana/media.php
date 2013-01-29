<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_Media {
	const MEDIA_FOLDER = 'media';

	protected static $_buffer = array(
		'scripts' => array(),
		'styles' => array(),
	);

	// Add the specified media to the buffer
	public static function add ($name, $priority, $type)
	{
		Media::$_buffer[$type] = Media::add_to_array(Media::$_buffer[$type], $name, $priority, $type);
	}
	
	protected static function add_to_array ($array, $name, $priority, $type)
	{
		// No doubles
		if ( ! in_array($name, $array))
		{
			// Break prefixes out of the first parameter
			$file = Media::parse($name);

			// Add it to the buffer
			$array[] = array(
				'name' => $file['name'],
				'priority' => $priority,
				'prefix' => $file['prefix'],
				'type' => $type
			);
		}
		return $array;
	}

	public static function get_assets ($profile, $type)
	{
		$assets = array();

		$assets = Media::add_defaults($assets, $profile, $type);
		$assets = Media::add_plugins($assets, $profile, $type);
		$assets = Media::add_from_buffer($assets, $profile, $type);

		return $assets;
	}

	protected static function add_from_buffer ($array, $profile, $type)
	{
		$buffer = Media::$_buffer[$type];
		
		// Clear the buffer
		Media::$_buffer[$type] = array();
		
		if (is_array($buffer))
		{
			foreach ($buffer as $file)
			{
				if (is_array($file))
				{
					// Name, priority, type, profile
					$array = Media::add_to_array($array, $file['name'], $file['priority'], $type);
				}
				else {
					throw new Kohana_Exception('Expected array, given '.$default.' in add_from_buffer()');
				}
			}
		}
		return $array;
	}

	// Add global styles & scripts from config files
	protected static function add_defaults ($array, $profile, $type)
	{
		$config = Kohana::$config->load($type);
		
		$defaults = $config->get($profile);

		if (is_array($defaults))
		{
			foreach($defaults as $default)
			{
				if (is_array($default))
				{
					// Name, priority, type, profile
					$array = Media::add_to_array($array, $default[0], $default[1], $type);
				}
				else {
					throw new Kohana_Exception('Expected array, given '.$default.' in add_defaults()');
				}
			}
		}
		return $array;
	}
	
	protected static function add_plugins ($array, $profile, $type)
	{
		$plugins_config = Kohana::$config->load('plugins');
		$schemas_config = Kohana::$config->load('pluginschemas');
		
		$plugins = $plugins_config->get($profile);

		if (is_array($plugins))
		{
			foreach($plugins as $plugin)
			{
				$schema = $schemas_config->get($plugin);
				if (is_array($schema[$type]))
				{
					$files = $schema[$type];
					foreach ($files AS $file)
					{
						Media::add_to_array($array, $file[0], $file[1], $type, $profile);
					}
				}
			}
		}
		return $array;
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