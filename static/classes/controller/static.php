<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Static extends Controller_Template {

	public $template = 'template/main';
	public $content = '<p>Page needs content</p>';
	
	public function action_fallback()
	{
		// Pure static, get the matching view from the static folder
		$this->template->content = View::factory('pages/'.$this->pagename);
	}

	public function before()
	{
		parent::before();
		
		// Get the page name
		$this->pagename = $this->request->action();

		// Bind it to a variable for use in views
		View::bind_global('pagename', $this->pagename);
		
		// The page might be static plus, set content to the action for now
		$this->template->content = View::factory('pages/'.$this->request->action());
	}

	public function after()
	{
		// Make $page_title available to all views
		View::bind_global('title', $this->title);
		View::bind_global('description', $this->description);

		parent::after();
	}

}
