<?php defined('SYSPATH') or die('No direct script access.');

class Plugins{
	public static function init($profile = 'default')
	{
		$plugins = Kohana::$config->load('plugins');

		// Check the profile
		if ( ! empty($plugins['enabled'][$profile]))
		{
			foreach ($plugins['enabled'][$profile] AS $plugin)
			{
				// Check if the specified plugin is available
				if ($plugin = $plugins['available'][$plugin])
				{					
					// Add styles
					if (isset($plugin['styles']))
					{
						$styles = $plugin['styles'];
						foreach ($styles AS $style)
						{
							Styles::add($style[0], $style[1]);
						}
					}

					// Add scripts
					if (isset($plugin['scripts']))
					{
						$scripts = $plugin['scripts'];
						foreach ($scripts AS $script)
						{
							Scripts::add($script[0], $script[1]);
						}
					}
				
				}
				else{
					throw new Kohana_Exception($plugin.' is not an available plugin, check config/plugins');
				}
			}
		}
	}
}