<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohana user guide and api browser.
 *
 * @package    Kohana/Download
 * @category   Controllers
 * @author     Gyll
 */
class Controller_Download extends Controller {
	
	// Public download links
	public function action_public()
	{
		// Look for the file in the downloads folder in document root
		$file_name = $this->request->param('file');
		$file_location = DOCROOT.'/downloads/'.$file_name;
		
		// Send file if it exists, 404 if it doesn't
		if(file_exists($file_location))
		{
			Request::current()->response()->send_file($file_location);
		}
		else{
			throw new HTTP_Exception_404($file_name.' not found');
		}
	}
}
