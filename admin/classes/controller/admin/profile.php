<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Profile extends Controller_Admin {
	public function action_index()
	{
		// Post
		if($post = Form::post())
		{
			$post->rule('password2', 'matches', array(':validation', ':field', 'password1'));

			if($post->check())
			{
				// Save profile
				$user = ORM::factory('user', $this->me->id);
				$user->password = $post['password1'];
				$user->save();
				
				// Success
				Form::success('admin/profile', 'profile_updated');
			}
			else{
				// Failure
				$errors = $post->errors('contact');
				View::bind_global('errors', $errors);
			}
		}
		
		// View
		$this->template->title = 'Profile';
		$this->template->content = View::factory('admin/profile/index');
	}
}