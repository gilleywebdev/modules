<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Auth extends Controller_Template {
	public $template = 'admin/auth/login';

	public function action_login()
	{
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
	
	public function action_forgotpassword()
	{
		if(Form::is_posted())
		{
			$post = $this->request->post();

			$email = $post['email'];
			
			$user = ORM::factory('user')
				->where('email', '=', $email)
				->find();

			if($user->loaded())
			{
				//Mail
				$subject = 'Password request for '.$user->username;
				$from = 'info@'.$_SERVER['SERVER_NAME'];
				$to = $user->email;
				$message = View::factory('admin/emails/forgotpassword');
			
				Email::send($to, $from, $subject, $message, $html = true);
				
				$success = array(Kohana::message('admin/auth', 'password_email_sent'));
				View::bind_global('success', $success);
			}
			else{
				$errors = array(Kohana::message('admin/auth', 'no_such_email'));
				View::bind_global('errors', $errors);
			}
		}
		
		$this->template = View::factory('admin/auth/forgotpassword');
		$this->template->title = 'Forgot Password';
	}

	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect('admin/auth/login');
	}
}