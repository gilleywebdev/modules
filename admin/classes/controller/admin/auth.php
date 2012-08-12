<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Auth extends Controller {
	public function action_login()
	{
		// Post
		if($post = Form::post())
		{
			// Attempt Login
			$success = Auth::instance()->login($post['username'], $post['password'], isset($post['remember_me']));

			if ($success)
			{
				// Success
				$this->request->redirect('admin');
			}
			else
			{
				// Failure
				Form::error('admin/auth', 'bad_login');
			}
		}

		// View
		$this->template = View::factory('admin/auth/login');
		$this->template->title = 'Login';
		$this->response->body($this->template->render());
	}

	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect('admin/auth/login');
	}
	
	public function action_forgotpassword()
	{
		// Post
		if ($post = Form::post())
		{
			// Get user
			$user = ORM::factory('user')
				->where('email', '=', $post['email'])
				->find();

			if ($user->loaded())
			{
				//Mail
				$subject = 'Password request for '.$user->username;
				$from = 'info@'.$_SERVER['SERVER_NAME'];
				$to = $user->email;
				$message = View::factory('admin/emails/forgotpassword');
			
				Email::send($to, $from, $subject, $message, $html = true);
				
				// Success
				Form::success('admin/auth', 'password_email_sent');
			}
			else
			{
				// Email does not belong to any user
				Form::error('admin/auth', 'no_such_email');
			}
		}
		
		// View
		$this->template = View::factory('admin/auth/forgotpassword');
		$this->template->title = 'Forgot Password';
		$this->response->body($this->template->render());
	}
}