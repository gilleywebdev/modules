<?php defined('SYSPATH') or die('No direct script access.');

class Controller_adminpost_news extends Controller {

	public function action_add()
	{
		$post = Validation::factory($_POST);
		$obj = ORM::factory('news');
		$obj->date = strtotime($post['date']);
		$obj->headline = $post['headline'];
		$obj->content = $post['text'];
		$obj->save();

		$this->request->redirect('/admin/news');
	}

	public function action_edit()
	{
		$post = Validation::factory($_POST);
		$obj = ORM::factory('news', $this->request->param('var'));
		$obj->date = strtotime($post['date']);
		$obj->headline = $post['headline'];
		$obj->content = $post['text'];
		$obj->save();

		$this->request->redirect('/admin/news');
	}

	public function action_delete()
	{
		if($this->request->param('var'))
		{
			$id = $this->request->param('var');
			$obj = ORM::factory('news')->where('id', '=', $id)->find();
			$obj->delete();
		}
		
		$this->request->redirect('/admin/news');
	}
	
}
