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
				
				$success = array(Kohana::message('admin/user', 'password_changed'));
				View::bind_global('success', $success);
			}
			else{
				$errors = $post->errors('contact');
				View::bind_global('errors', $errors);
			}
		}
		
		$this->template->title = 'Profile';
		$this->template->content = View::factory('admin/user/profile');
	}
	
	public function action_index()
	{
		// Get the list of users
		$obj = ORM::factory('user');
		$all_user_objs = $obj->find_all();
		
		$i = 1;
		$users = array();
		
		foreach($all_user_objs AS $user_obj)
		{
			$stripe = $i%2 !== 0 ? 'odd' : 'even';
			$i++;
			$users[] = array('obj' => $user_obj, 'stripe' => $stripe);
		}

		// Messaging Center
		$message_type = $this->request->param('var');
		$message = $this->request->param('subvar');
		
		if($message_type === 'success')
		{
			if($message)
			{
				$success = array(Kohana::message('admin/user', $message));
				View::set_global('success', $success);
			}
		}
		elseif($message_type === 'error')
		{
			if($message)
			{
				$errors = array(Kohana::message('admin/user', $message));
				View::set_global('errors', $errors);
			}
		}

		$this->template->content = View::factory('admin/user/index');
		$this->template->title = 'Users';

		View::set_global('users', $users);

		Styles::add(array('admin', 'users'), Styles::PAGE);
	}
	
	public function action_add()
	{
		if(Form::is_posted())
		{
			$post = Validation::factory($this->request->post())
				->rule('username', 'not_empty')
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
		
		$this->template->content = View::factory('admin/user/add');
		$this->template->title = 'Add User';
	}
	
	public function action_edit()
	{
		$user = ORM::factory('user', $this->request->param('var'));

		if(Form::is_posted())
		{
			$post = Validation::factory($this->request->post())
				->rule('email', 'not_empty');

			if($post->check())
			{
				$user->email = $post['email'];

				$user->save();

				$this->request->redirect('/admin/user/index/success/edited');
			}
			else{
				$errors = $post->errors('contact');
				View::bind_global('errors', $errors);
			}
		}
		
		$this->template->content = View::factory('admin/user/edit')->bind('user', $user);
		$this->template->title = 'Edit User';
	}
	
	public function action_delete()
	{
		$user = ORM::factory('user', $this->request->param('var'));
		if($this->user->id === $user->id)
		{
			$this->request->redirect('/admin/user/index/error/deleteself');
		}
		elseif($user->username === 'chris')
		{
			$this->request->redirect('/admin/user/index/error/deletechris');
		}
		else
		{
			if(Form::is_posted())
			{
				$post = $this->request->post();

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
		
			Styles::add(array('admin', 'delete'), Styles::PAGE);
		
			$this->template->content = View::factory('admin/user/delete')->bind('user', $user);
			$this->template->title = 'Delete User';
		}
	}
}