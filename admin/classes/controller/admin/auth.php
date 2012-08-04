<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Auth extends Controller_Template {
	public $template = 'admin/template/login';

	public function action_login()
	{
		// Post
		if(Form::is_posted())
		{
			$post = $this->request->post();
			$rm = isset($post['remember_me']) ? $post['remember_me'] : '';
			$success = Auth::instance()->login($post['username'], $post['password'], $rm);

			if ($success)
			{
			  $this->request->redirect('admin');
			}

			$errors = array('Incorrect login/pass');
		
			View::bind_global('errors', $errors);
		}

		$this->template->title = 'Login';
	}

	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect('admin/auth/login');
	}
}