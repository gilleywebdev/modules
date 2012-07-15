<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Error_Handler extends Controller_Template {
	
	public $template = 'template/main';
	
	public function before()
	{
		parent::before();

		// Bind the initial request for the 404 page
		$initial_request = Request::$initial->uri();
		View::bind_global('page', $initial_request);
 
		// Internal request only!
		if (Request::$initial !== Request::$current)
		{
			if ($message = rawurldecode($this->request->param('message')))
			{
				View::bind_global('message', $message);
			}
		}
		else
		{
			$this->request->action(404);
		}
 
		$this->response->status((int) $this->request->action());
	}

	public function action_404()
	{
		$this->template->title = '404 Not Found';
		$this->template->content = View::factory('error/404');
 
		// HTTP Status code.
		$this->response->status(404);
	}

	public function action_500()
	{
		$this->template->title = 'Internal Server Error';
		$this->template->content = View::factory('error/505');		
	}

}
