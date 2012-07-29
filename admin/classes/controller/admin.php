<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Template {
	public $template = 'admin/template/main';
	
	public function before()
	{
		parent::before();
		
		if ( ! Auth::instance()->logged_in())
		{
			$this->request->redirect('admin/user/login');
		}
	}
}