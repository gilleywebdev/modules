<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends ORM {
	protected $_has_many = array(
		'user_tokens' => array('model' => 'user_token'),
		'roles'       => array('model' => 'role', 'through' => 'roles_users'),
	);

	public function unique_key($value)
	{
		return Valid::email($value) ? 'email' : 'username';
	}

	public function complete_login()
	{
		if ($this->_loaded)
		{
			// Update the number of logins
			$this->logins = new Database_Expression('logins + 1');

			// Set the last login date
			$this->last_login = time();

			// Save the user
			$this->update();
		}
	}
}