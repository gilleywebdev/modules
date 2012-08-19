<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
	// Simplified "create" wrapper
	public function create(Validation $validation = NULL)
	{
		// Can be called with array as second parameter in controller
		if (func_num_args() >= 2)
		{
			$values = func_get_arg(1);
			if ( ! is_array($values))
			{
				throw new Kohana_Exception('second argument must be array');
			}
		}
		else
		{
			$values = NULL;
		}

		if ($values !== NULL)
		{
			// New function
			return $this->values($validation->data(), $values)->parent_create($validation);
		}
		else
		{
			// Default function
			return parent::create($validation);
		}
	}
	
	private parent_create(Validation $validation = NULL)
	{
		return parent::create($validation);
	}
}
