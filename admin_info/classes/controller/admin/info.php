<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Info extends Controller_Admin {
	public $template = 'admin/template/main';
	
	public function action_index()
	{
		$labels = Kohana::$config->load('info/labels')->as_array();
		$config = Kohana::$config->load('info/values');

		if($post = Form::post())
		{
			if($post->check())
			{				
				foreach($labels AS $key => $val)
				{
					$config->set($key, $post[$key]);
				}

				Kohana::$config->copy('info');
				
				$success = array(Kohana::message('admin/info', 'info_updated'));
				View::bind_global('success', $success);
			}
			else{
				$errors = $post->errors('contact');
				View::bind_global('errors', $errors);
			}
		}

		$values = $config->as_array();
		
		Styles::add(array('admin','info'), Styles::PAGE);

		$this->template->title = 'Edit Info';
		$this->template->content = View::factory('admin/info/index')
									->bind('labels', $labels)
									->bind('values', $values);
	}
}