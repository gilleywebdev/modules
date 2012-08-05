<?php defined('SYSPATH') or die('No direct script access.');

class Nap{
	public static function get($key)
	{
		$nap = Kohana::$config->load('nap/values');
		if($key == 'address')
		{
			return View::factory('includes/address')
				->set('address_1', $nap->get('address_1'))
				->set('address_2', $nap->get('address_2'))
				->set('city', $nap->get('city'))
				->set('zip', $nap->get('zip'));
		}
		else{
			return $nap->get($key);
		}
	}
}