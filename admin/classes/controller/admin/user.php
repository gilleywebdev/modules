<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_User extends Controller_Admin {
	public $template = 'admin/template/main';

	public function action_profile()
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
			}
			
			$errors = $post->errors('contact');
			View::bind_global('errors', $errors);
		}
		
		$this->template->title = 'Profile';
		$this->template->content = View::factory('admin/user/profile');
	}
}