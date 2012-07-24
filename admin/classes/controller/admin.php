<?php defined('SYSPATH') or die('No direct script access.');

class Controller_admin extends Controller_Template {
	public $template = 'admin/template/main';

	public function action_index()
	{
		$this->template->content = View::factory('admin/index');
		$this->template->title = 'Dashboard';
	}

	public function action_news()
	{
		$this->template->content = View::factory('admin/news');
		$this->template->title = 'News';
		
		$obj = ORM::factory('news');
		$news = $obj->order_by('date', 'desc')->find_all();

		View::set_global('news', $news);
	}
	
	public function action_seo()
	{
		$this->template->content = View::factory('admin/seo');
		$this->template->title = 'SEO';
		
		$pages = Kohana::list_files('views/pages');
		
		foreach($pages AS $key => $val){
			$pages[$key] = basename($val, EXT);
		}
		
		View::bind_global('pages', $pages);
	}

	public function action_login()
	{
		$this->template = View::factory('admin/template/auth');
		$this->template->content = View::factory('admin/login');
		$this->template->title = 'Login';
	}
}
