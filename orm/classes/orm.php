<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
	// Simplified "create" wrapper
	public function create(Validation $validation = NULL, array $values = array())
	{
		return $this->values($validation->data(), $values)->parent_create($validation);
	}
	
	private function parent_create(Validation $validation)
	{
		return parent::create($validation);
	}
}
