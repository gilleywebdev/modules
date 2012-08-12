<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Profile extends Controller_Admin {
	public function action_index()
	{
		$id = $this->user->id;

		if(Form::is_posted())
		{
			$post = Validation::factory($this->request->post())
			    ->rule('password2', 'matches', array(':validation', ':field', 'password1'));

			if($post->check())
			{
				$user = ORM::factory('user', $id);
				$user->password = $post['password1'];
				$user->save();
				
				$success = array(Kohana::message('admin/profile', 'profile_updated'));
				View::bind_global('success', $success);
			}
			else{
				$errors = $post->errors('contact');
				View::bind_global('errors', $errors);
			}
		}
		
		$this->template->title = 'Profile';
		$this->template->content = View::factory('admin/profile/index');
	}
}