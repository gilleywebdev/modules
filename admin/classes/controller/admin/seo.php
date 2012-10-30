<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Seo extends Controller_Admin {

	public function before()
	{
		parent::before();

		// If not installed
		if ( ! DB::check_for_tables('pages'))
		{
			//Install
			$query = View::factory('admin/install/seo');
			$result = DB::query(Database::INSERT, $query)->execute();
		}
	}

	public function action_index()
	{
		// Messaging Center
		Form::messaging_center('admin/seo', 'var', 'subvar');

		// View
		$this->template->title = 'SEO';
		$this->template->content = View::factory('admin/seo/index');

		Scripts::add(array('admin', 'seo'), Scripts::CONTROLLER);
		Styles::add(array('admin', 'seo'), Styles::PAGE);
	}
	
	public function action_load()
	{
		$pages = array();

		// Get names for all the pages
		$files = Kohana::list_files('views/pages');

		foreach ($files AS $filename)
		{
			$pagename = basename($filename, EXT);

			// Look for page in database
			$page = ORM::factory('page')
				->where('pagename', '=', $pagename)
			    ->find();
			
			if($page->loaded())
			{
				// DB entry, use data
				$pages[] = array(
					$pagename,
					$page->title,
					$page->description,
				);
			}
			else
			{
				// No DB entry, placeholders
				$pages[] = array(
					$pagename,
					'',
					'',
				);
			}
		}

		$data = json_encode($pages);
		
		// View
		$this->template = View::factory('admin/seo/load')
			->set('data', $data);
	}
	
	public function action_save()
	{
		// Called with ajax
		$post = $this->request->post();
		$data = $post['data'];

		foreach($data AS $datum)
		{
			$page = ORM::factory('page')
				->where('pagename', '=', $datum[0])
			    ->find();
			
			if( ! $page->loaded())
			{
				// New entry
				$page = ORM::factory('page');
				$page->pagename = $datum[0];
			}

			$page->title = $datum[1];
			$page->description = $datum[2];
			$page->save();
		}
	
		$this->template = View::factory('admin/seo/save');
	}
}