<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Info extends Controller_Admin {
	public $template = 'admin/template/main';
	
	public function action_index()
	{
		$labels = Kohana::$config->load('nap/labels')->as_array();

		$config = Kohana::$config->load('nap/values');

		if(Form::is_posted())
		{
			$post = Validation::factory($this->request->post());

			if($post->check())
			{				
				foreach($labels AS $key => $val)
				{
					$config->set($key, $post[$key]);
				}

				Kohana::$config->copy('nap');
				
				$success = array(Kohana::message('success', 'info_updated'));
				View::bind_global('success', $success);
			}
			else{
				$errors = $post->errors('contact');
				View::bind_global('errors', $errors);
			}
		}

		$values = $config->as_array();

		$this->template->title = 'Edit Info';
		$this->template->content = View::factory('admin/info/index')
									->bind('labels', $labels)
									->bind('values', $values);
	}
}