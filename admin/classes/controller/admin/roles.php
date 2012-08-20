<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Roles extends Controller_Admin {
	public function action_index()
	{
		// Messaging Center
		Form::messaging_center('admin/roles', 'var', 'subvar');

		// View
		$this->template->title = 'Roles';
		$this->template->content = View::factory('admin/roles/index');
	}
}