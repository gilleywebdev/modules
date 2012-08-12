<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Auth extends Controller {
	public function action_login()
	{
		if($post = Form::post())
		{
			$success = Auth::instance()->login($post['username'], $post['password'], isset($post['remember_me']));

			if ($success)
			{
			  $this->request->redirect('admin');
			}
			else{
				$errors = array(Kohana::message('admin/auth', 'bad_login'));
				View::bind_global('errors', $errors);
			}
		}

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
		if($post = Form::post())
		{
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
		$this->response->body($this->template->render());
	}
}