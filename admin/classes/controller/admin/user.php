<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_User extends Controller_Admin {
	public function action_index()
	{
		// Get the list of users
		$users = ORM::factory('user')->find_all()->as_array();

		// Messaging Center
		$message_type = $this->request->param('var');
		$message = $this->request->param('subvar');
		
		if($message and ($message_type === 'success' or $message_type === 'error'))
		{
			Form::$message_type('admin/user', $message);
		}

		// View
		$this->template->title = 'Users';
		$this->template->content = View::factory('admin/user/index')
			->set('users', $users);
	}
	
	public function action_add()
	{
		if($post = Form::post())
		{
			$post->rule('username', 'not_empty')
				->rule('email', 'not_empty')
				->rule('email', 'email');

			if($post->check())
			{
				$user = ORM::factory('user');
				$user->username = $post['username'];
				$user->email = $post['email'];
				$user->password = $post['password'];

				$user->save();

				$user->add('roles', ORM::factory('role', array('name' => 'login')));

				$this->request->redirect('/admin/user/index/success/added');
			}
			else{
				$errors = $post->errors('contact');
				View::bind_global('errors', $errors);
			}
		}
		
		// View
		$this->template->content = View::factory('admin/user/add');
		$this->template->title = 'Add User';
	}
	
	public function action_delete()
	{
		// Get the user to be deleted
		$user = ORM::factory('user', $this->request->param('var'));

		// Can't delete self
		if($this->me->id === $user->id)
		{
			$this->request->redirect('/admin/user/index/error/deleteself');
		}

		// Can't delete me
		if($user->username === 'chris')
		{
			$this->request->redirect('/admin/user/index/error/deletechris');
		}

		// Otherwise delete ok
		if($post = Form::post())
		{
			if($post['response'] === 'yes')
			{
				$id = $this->request->param('var');
				$obj = ORM::factory('user')->where('id', '=', $id)->find();
				$obj->delete();

				$this->request->redirect('/admin/user/index/success/deleted');
			}
			else{
				$this->request->redirect('/admin/user/');
			}
		}

		// View
		Styles::add(array('admin', 'delete'), Styles::PAGE);
		$this->template->content = View::factory('admin/user/delete')->bind('user', $user);
		$this->template->title = 'Delete User';
	}
}