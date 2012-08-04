<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_User extends Controller_Template {
	public $template = 'admin/template/main';

	public function action_login()
	{
		// Post
		if(Form::is_posted())
		{
			$post = $this->request->post();
			$success = Auth::instance()->login($post['username'], $post['password']);

			if ($success)
			{
			  $this->request->redirect('admin');
			}

			$errors = array('Incorrect login/pass');
			
			View::bind_global('errors', $errors);
		}

		$this->template = View::factory('admin/template/login');
		$this->template->title = 'Login';
		$this->template->content = View::factory('admin/user/login');
	}
	
	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect('admin/user/login');
	}
	
	public function action_profile()
	{
		$id = Auth::instance()->get_user()->id;

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