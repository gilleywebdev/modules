<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Seo extends Controller_Admin {

	public function action_index()
	{
		// Messaging Center
		Form::messaging_center('admin/seo', 'var', 'subvar');

		// View
		$this->template->title = 'Search Engine Optimization';
		$this->template->content = View::factory('admin/seo/index');
	}
}