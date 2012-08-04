<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Template {
	public $template = 'admin/template/main';
	
	public function before()
	{
		parent::before();
		
		$this->user = Auth::instance()->get_user();
		if ( $this->user === null )
		{
			$this->request->redirect('admin/auth/login');
		}
		else
		{
			View::bind_global('user', $this->user);
		}
	}
}