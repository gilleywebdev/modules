<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Auth extends Controller_Template {
	public $template = 'admin/template/outside';

	public function action_login()
	{
		// If they're already logged in, bump them to the main screen
		$this->user = Auth::instance()->get_user();
		if (is_object($this->user))
		{
			$this->redirect('admin');
		}

		// Post
		if($post = Form::post())
		{
			// Attempt Login
			$success = Auth::instance()->login($post['username'], $post['password'], isset($post['remember_me']));			

			if ($success)
			{
				// Success
				$this->redirect('admin');
			}
			else
			{
				// Failure
				Form::error('admin/auth', 'bad_login');
			}
		}

		// View
		Styles::add('admin/login', Styles::PAGE, 'styles', 'admin');
		Scripts::add('admin/login', Scripts::CONTROLLER, 'scripts', 'admin_outside');
		$this->template->content = View::factory('admin/auth/login');
		$this->template->title = 'Login';
	}

	public function action_logout()
	{
		Auth::instance()->logout();
		$this->redirect('admin/auth/login');
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
				// Reset Data
				$data = array(
					'user_id'    => $user->id,
					'expires'    => time() + (60 * 60 * 48), // 48 hours
				);

				// Create a new reset token
				$token = ORM::factory('user_reset')
							->values($data)
							->create();
							
				$link = 'http://'.DOMAIN.'/admin/auth/reset/'.$token->token;

				//Mail
				$subject = 'Password request for '.$user->username;
				$from = 'info@'.DOMAIN;
				$to = $user->email;
				$message = View::factory('admin/emails/forgotpassword')
					->set('link', $link);
			
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
		
		// Messaging Center
		Form::messaging_center('admin/auth', 'var', 'subvar');
		
		// View
		$this->template->content = View::factory('admin/auth/forgotpassword');
		$this->template->title = 'Forgot Password';
	}
	
	public function action_reset()
	{
		// Get the user
		$token = $this->request->param('var');
		$reset = ORM::factory('user_reset', array('token' => $token));
		$user = ORM::factory('user', $reset->user_id);

		if($user->loaded())
		{
			// Post
			if($post = Form::post())
			{
				// Rules
				$post->add_password_validation();

				if($post->check())
				{
					// Save profile
					$user->password = $post['password'];
					$user->save();

					// Delete the reset codes for this user
					$user_resets = ORM::factory('user_reset')
						->where('user_id', '=', $user->id)
						->find_all();

					foreach($user_resets AS $row)
					{
						$row->delete();
					}

					// Success
					Auth::instance()->force_login($user);
					$this->redirect('admin/dashboard/index/success/password_reset');
				}
				else{
					// Failure
					Form::errors($post->errors('contact'));
				}
			}

			// View
			$this->template->content = View::factory('admin/auth/reset')
				->set('me', $user);
			$this->template->title = 'Set New Password';
		}
		else
		{
			// User didn't load, token is out of date
			$this->redirect('admin/auth/forgotpassword/error/reset_expired');
		}
	}
}