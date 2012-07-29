<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_User extends Controller_Template {
	public $template = 'admin/template/user';

	public function action_login()
	{
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

		$this->template->content = View::factory('admin/login');
		$this->template->title = 'Login';
	}
	
	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect('admin/user/login');
	}
}