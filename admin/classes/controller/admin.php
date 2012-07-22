<?php defined('SYSPATH') or die('No direct script access.');

class Controller_admin extends Controller_Template {
	public $template = 'admin/template/main';

	protected $media;

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

	public function before()
	{
		if ($this->request->action() === 'media')
		{
			// Do not template media files
			$this->auto_render = FALSE;
			parent::before();
		}
		else{
			parent::before();
		}
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
			);
		}

		return parent::after();
	}

	public function action_media()
	{
		// Get the file path from the request
		$file = $this->request->param('file');

		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));

		if ($file = Kohana::find_file('media/admin', $file, $ext))
		{
			// Check if the browser sent an "if-none-match: <etag>" header, and tell if the file hasn't changed
			$this->response->check_cache(sha1($this->request->uri()).filemtime($file), $this->request);
			
			// Send the file content as the response
			$this->response->body(file_get_contents($file));

			// Set the proper headers to allow caching
			$this->response->headers('content-type',  File::mime_by_ext($ext));
			$this->response->headers('last-modified', date('r', filemtime($file)));
		}
		else
		{
			// Return a 404 status
			$this->response->status(404);
		}
	}
}
