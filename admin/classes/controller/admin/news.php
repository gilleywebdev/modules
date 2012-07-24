<?php defined('SYSPATH') or die('No direct script access.');

class Controller_admin_news extends Controller_Template {
	public $template = 'admin/template/main';
	
	public function action_add()
	{
		$this->template->title = 'Add News';
		$this->template->content = View::factory('admin/news/add');
	}
	
	public function action_edit()
	{
		$this->template->title = 'Edit News';

		$id = $this->request->param('var');
		$news = ORM::factory('news')->where('id', '=', $id)->find();

		View::set_global('news', $news);

		$this->template->content = View::factory('admin/news/edit');
	}
}
