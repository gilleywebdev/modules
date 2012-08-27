<?php defined('SYSPATH') or die('No direct script access.');

abstract class Media {
	const MEDIA_FOLDER = 'media/';

	protected static $_buffer = array();

	// Add the specified media to the buffer
	public static function add ($name, $priority, $type)
	{
		// No doubles
		if (in_array($name, Media::$_buffer))
		{
			return false;
		}
		else{
			// Break prefixes out of the first parameter
			if (is_array($name))
			{
				$prefix = $name[0];
				$name = $name[1];
			}
			else
			{
				$prefix = NULL;
			}

			// Add it to the buffer
			Media::$_buffer[] = array(
				'name' => $name,
				'priority' => $priority,
				'prefix' => $prefix,
				'type' => $type
			);

			return true;
		}
	}
	
	// Make sure it's an array of arrays and then add those to the buffer
	protected static function add_defaults ($defaults, $type)
	{
		if(is_array($defaults))
		{
			foreach($defaults AS $default)
			{
				if(is_array($default))
				{
					Media::add($default[0], $default[1], $type);
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
}