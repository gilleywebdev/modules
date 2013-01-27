<?php defined('SYSPATH') or die('No direct script access.');
 
class Task_Compile extends Minion_Task
{
	protected function _execute(array $params)
    {
		require Kohana::find_file('vendor', 'cssmin/CssMin');

		// Styles
		$styles_config = Kohana::$config->load('styles');

		$styles_profiles = array();
		
		foreach ($styles_config as $profile => $files)
		{
			$styles_profiles[$profile] = array(
				'stylesheets' => array(),
				'combined' => '',
			);

			$files = Styles::prepare_production_file($profile);

			$styles_profiles[$profile]['stylesheets'] = $files;
			
			foreach ($files as $file)
			{
				$styles_profiles[$profile]['combined'] .= file_get_contents(Kohana::find_file('media', $file['path'], $file['ext']));
			}
			
			$output = CssMin::minify($styles_profiles[$profile]['combined']);

			$output_folder = APPPATH.'media/styles/prod';

			file_put_contents($output_folder.'/'.$profile.'.css', $output);
		}
/*
		$view = new View('minion/compile');

		$view->styles = $stylesheets;

		echo $view;
*/
	}
}