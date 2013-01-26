<?php defined('SYSPATH') or die('No direct script access.');

class Controller_assets extends Controller {
	protected $media;

	public function action_media()
	{
		// Get the file path from the request
		$file = $this->request->param('file');

		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));

		if ($file = Kohana::find_file('media', $file, $ext))
		{
			// Check if the browser sent an "if-none-match: <etag>" header, and tell if the file hasn't changed
			$this->check_cache(sha1($this->request->uri()).filemtime($file));
			
			// Send the file content as the response
			$this->response->body(file_get_contents($file));

			// Set the proper headers to allow caching
			$this->response->headers('content-type',  File::mime_by_ext($ext));
			$this->response->headers('last-modified', date('r', filemtime($file)));
		}
		else
		{
			// Page Not Found
			throw HTTP_Exception::factory(404, 'The requested URL :uri was not found on this server.', array(
			        ':uri' => $this->request->uri(),
			    ));
		}
	}
	
	public function action_prodstyles()
	{
		$profile = $this->request->param('profile');
		
		$files = Styles::prepare_production_file($profile);
		
		$response = '';
		
		foreach($files AS $file)
		{
			$path = $file['path'];
			$ext = $file['ext'];
			
			if ($file = Kohana::find_file('media', $path, $ext))
			{
				// Check if the browser sent an "if-none-match: <etag>" header, and tell if the file hasn't changed
				$this->check_cache(sha1($this->request->uri()).filemtime($file));

				// Send the file content as the response
				$response .= file_get_contents($file);

				// Set the proper headers to allow caching
				$this->response->headers('content-type',  File::mime_by_ext($ext));
				$this->response->headers('last-modified', date('r', filemtime($file)));
			}
		}
		
		$this->response->body($response);
	}

	public function action_prodscripts()
	{
		$profile = $this->request->param('profile');
		
		$files = Scripts::prepare_production_file($profile);
		
		$response = '';
		
		foreach($files AS $file)
		{
			$path = $file['path'];
			$ext = $file['ext'];
			
			if ($file = Kohana::find_file('media', $path, $ext))
			{
				// Check if the browser sent an "if-none-match: <etag>" header, and tell if the file hasn't changed
				$this->check_cache(sha1($this->request->uri()).filemtime($file));

				// Send the file content as the response
				$response .= file_get_contents($file);

				// Set the proper headers to allow caching
				$this->response->headers('content-type',  File::mime_by_ext($ext));
				$this->response->headers('last-modified', date('r', filemtime($file)));
			}
		}
		
		$this->response->body($response);
	}

}