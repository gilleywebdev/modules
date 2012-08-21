<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Seo extends Controller_Admin {

	public function action_index()
	{
		// Post
		if ($post = Form::post())
		{
			// Transmute from post to useable array
			$seo = array();
			foreach ($post->data() AS $key => $value)
			{
				// key is name_title or name_description
				$key_shards = explode('_', $key);
				$pagename = $key_shards[0];
				$tag_type = $key_shards[1];
				
				$seo[$pagename][$tag_type] = $value;
			}
			
			// Take array and put into database
			foreach ($seo AS $pagename => $tags)
			{
				$page = ORM::factory('page')
				    ->where('pagename', '=', $pagename)
				    ->find();

					$page->pagename = $pagename;
					$page->title = $tags['title'];
					$page->description = $tags['description'];
				
					$page->save();
			}
			
			// Success
			Form::success('admin/seo', 'seo_updated');
		}

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
				$pages[$pagename] = array(
					'title' => $page->title,
					'description' => $page->description,
				);
			}
			else
			{
				// No DB entry, placeholders
				$pages[$pagename] = array(
					'title' => '*** NEEDS TITLE ***',
					'description' => '*** NEEDS DESCRIPTION ***',
				);
			}
		}

		// Messaging Center
		Form::messaging_center('admin/seo', 'var', 'subvar');

		// View
		$this->template->title = 'SEO';
		$this->template->content = View::factory('admin/seo/index')
			->set('pages', $pages);
	}
}