<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Template {
	public $template = 'admin/template/main';
	
	public function before()
	{
		parent::before();
		
		// User must be logged in to access admin page
		$this->me = Auth::instance()->get_user();
		if ( ! is_object($this->me))
		{
			// Send to login screen if not
			$this->request->redirect('admin/auth/login');
		}
		else
		{
			// Bind variable for "Hi Chris", profile, etc.
			View::bind_global('me', $this->me);
		}
	}
	
	public function after()
	{
		// Load modules from config
		View::set_global('modules',Kohana::$config->load('admin/modules'));

		// Header from info config
		$this->template->set('header', Info::get('name'));

		parent::after();
	}
}