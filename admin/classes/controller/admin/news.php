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
	
	public function after()
		{
			if ($this->auto_render)
			{
				// Get the media route
				$media = Route::get('admin/media');

				// Add styles
				$this->template->styles = array(
					$media->uri(array('file' => 'css/admin.css')) => 'screen',
					$media->uri(array('file' => 'css/ui-lightness/jquery-ui-1.8.20.custom.css')) => 'screen',
				);
			}

			return parent::after();
		}
}
