<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contact extends Controller {
	public function action_index()
	{
		if(Form::action('contact'))
		{
			$post = Validation::factory($_POST)
				->rule('name', 'not_empty')
				->rule('email', 'not_empty')
				->rule('email', 'email')
				->rule('comment', 'not_empty');

			if($post->check())
			{
				$this->request->redirect('thank-you');
			}

			$errors = $post->errors('validation');
		}
		else{
			$errors = array();
		}
		
		View::bind_global('errors', $errors);
		
		$this->response->body(
			View::factory('template/main')
				->set('title', 'Contact Us')
				->set('description', 'Contact Us Today.')
				->set('pagename', 'contact')
				->set('content', View::factory('contact'))
			);
	}
}