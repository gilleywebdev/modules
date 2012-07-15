<?php defined('SYSPATH') or die('No direct script access.');

class Controller_download extends Controller {
	
	public function action_public()
	{
		$file_name = $this->request->param('file');
		$file_location = DOCROOT.'/downloads/'.$file_name;
		if(file_exists($file_location))
		{
			Request::current()->response()->send_file($file_location);
		}
		else{
			throw new HTTP_Exception_404($file_name.' not found');
		}
	}
}
