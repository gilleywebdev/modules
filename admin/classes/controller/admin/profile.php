<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Profile extends Controller_Admin {
	public function action_index()
	{
		// Post
		if($post = Form::post())
		{
			// Rules
			$post->rule('password2', 'matches', array(':validation', ':field', 'password1'));

			if($post->check())
			{
				// Save profile
				$user = ORM::factory('user', $this->user->id);
				$user->password = $post['password1'];
				$user->save();
				
				// Success
				Form::success('admin/profile', 'profile_updated');
			}
			else{
				// Failure
				Form::errors($post->errors('contact'));
			}
		}
		
		// View
		$this->template->title = 'Profile';
		$this->template->content = View::factory('admin/profile/index');
	}
}