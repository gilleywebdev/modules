<?php defined('SYSPATH') or die('No direct script access.');

class Admin{
	protected static $_modules = array();
	
	public static function add($name, $label)
	{
		$module = array(
			'name' => $name,
			'label' => $label,
		);
		
		Admin::$_modules[] = $module;
	}
	
	public static function modules()
	{
		return Admin::$_modules;
	}
}