<?php defined('SYSPATH') or die('No direct script access.');

class Controller_adminpost_login extends Controller {

	public function action_login()
	{
		$post = $this->request->post();
		$success = Auth::instance()->login($post['username'], $post['password']);

		if ($success)
		{
		  $this->request->redirect('admin');
		}
		else
		{
		  $this->request->redirect('admin/login');
		}
	}
}