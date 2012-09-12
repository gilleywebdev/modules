<?php defined('SYSPATH') or die('No direct script access.');

class Helper {
	public static $pagename = '';
	
	public static function active($check)
	{
		if ($check == Helper::$pagename)
		{
			return 'active';
		}
		else
		{
			return '';
		}
	}
}