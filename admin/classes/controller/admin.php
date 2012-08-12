<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Template {
	public $template = 'admin/template/main';
	
	public function before()
	{
		parent::before();
		
		$this->user = Auth::instance()->get_user();
		if ( ! is_object($this->user))
		{
			$this->request->redirect('admin/auth/login');
		}
		else
		{
			View::bind_global('me', $this->user);
		}
	}
	
	public function after()
	{
		View::set_global('modules',Kohana::$config->load('admin/modules'));
		
		if( class_exists('Info'))
		{
			$this->template->set('header', Info::get('name'));
		}
		else{
			$admin_config = Kohana::$config->load('admin');
			$this->template->set('header', $admin_config['header']);
		}
		
		parent::after();
	}
}