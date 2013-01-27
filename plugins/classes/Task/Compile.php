
<?php defined('SYSPATH') or die('No direct script access.');
 
class Task_Compile extends Minion_Task
{
	protected function _execute(array $params)
    {
		$list_all = Kohana::list_files('media/styles/css');
	
		$profile = 'default';

		$files = Styles::prepare_production_file($profile);

		foreach($files AS $file)
		{
			$path = $file['path'];
			$ext = $file['ext'];
		}
		
		$view = new View('minion/compile');

		$view->files = $files;
		$view->list = $list_all;

		echo $view;
    }
}