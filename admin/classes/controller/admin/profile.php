<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Profile extends Controller_Admin {
	public function action_index()
	{
		// Post
		if($post = Form::post())
		{
			try
			{
				// Update these fields
				$update = array('username', 'email');
				
				// and password if it's set
				if($post['password'] !== '')
				{
					$update[] = 'password';
					
					// Add Password Validation
					$post->add_password_validation();
				}
				
				// Save profile
				$user = ORM::factory('user', $this->user->id)
					->update($post, $update);
				
				// Refresh user data
				$this->user = $user;

				// Success
				Form::success('admin/profile', 'profile_updated');
			}
			catch( ORM_Validation_Exception $e)
			{
				// Errors
				Form::errors($e->errors('contact'));
			}
		}
		
		// View
		$this->template->title = 'Profile';
		$this->template->content = View::factory('admin/profile/index');
	}
}