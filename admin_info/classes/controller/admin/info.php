<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Info extends Controller_Admin {
	public $template = 'admin/template/main';
	
	public function action_index()
	{
		// Load info configs
		$labels = Kohana::$config->load('info/labels')->as_array();
		$config = Kohana::$config->load('info/values');

		// Post
		if($post = Form::post())
		{
			// Save new info to database
			foreach($labels AS $key => $val)
			{
				$config->set($key, $post[$key]);
			}
			Kohana::$config->copy('info');
			
			// Success
			Form::success('admin/info', 'info_updated');
		}

		// Put the values in an array for displaying
		$values = $config->as_array();
		
		// View
		Styles::add(array('admin','info'), Styles::PAGE);
		$this->template->title = 'Edit Info';
		$this->template->content = View::factory('admin/info/index')
			->bind('labels', $labels)
			->bind('values', $values);
	}
}