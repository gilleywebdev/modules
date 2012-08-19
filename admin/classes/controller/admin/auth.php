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
				// Reset Data
				$data = array(
					'user_id'    => $user->id,
					'expires'    => time() + (60 * 60 * 48), // 48 hours
				);

				// Create a new reset token
				$token = ORM::factory('user_reset')
							->values($data)
							->create();
							
				$link = 'http://'.$_SERVER['SERVER_NAME'].'/admin/auth/reset/'.$token->token;

				//Mail
				$subject = 'Password request for '.$user->username;
				$from = 'info@'.$_SERVER['SERVER_NAME'];
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
		
		// View
		$this->template = View::factory('admin/auth/forgotpassword');
		$this->template->title = 'Forgot Password';
		$this->response->body($this->template->render());
	}
	
		public function action_reset()
		{
			// Get the user
			$token = $this->request->param('var');
			$reset = ORM::factory('user_reset', array('token' => $this->request->param('var')));
			$user = ORM::factory('user', $reset->user_id);

			if($user->loaded())
			{
				// Post
				if($post = Form::post())
				{
					// Rules
					$post->rule('password', 'matches', array(':validation', ':field', 'password_confirm'));

					if($post->check())
					{
						// Save profile
						$user->password = Auth::instance()->hash($post['password']);
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
						$this->request->redirect('admin/dashboard/index/success/password_reset');
					}
					else{
						// Failure
						Form::errors($post->errors('contact'));
					}
				}

				// View
				$this->template = View::factory('admin/auth/reset')
					->set('me', $user);
				$this->template->title = 'Set New Password';
				$this->response->body($this->template->render());				
			}
			else
			{
				echo '<p>This reset code has expired</p>';
				echo '<p><a href="/admin">Get a new one</a></p>';
			}
		}
}