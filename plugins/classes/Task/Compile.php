
<?php defined('SYSPATH') or die('No direct script access.');
 
class Task_Compile extends Minion_Task
{
	protected function _execute(array $params)
    {
		// Styles
		$styles_config = Kohana::$config->load('styles');

		$styles = array();
		
		foreach ($styles_config as $profile => $files)
		{
			$files = Styles::prepare_production_file($profile);

			$styles[$profile] = $files;
		}

		$view = new View('minion/compile');

		$view->styles = $styles;

		echo $view;
	}
}