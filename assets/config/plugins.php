<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'enabled' => array
	(
		'default' => array(),
	),
	'available' => array
	(
		'jscrollpane' => array
		(
			'styles' => array(
				array('jscrollpane', Styles::PLUGIN),
			),
			'scripts' => array
			(
				array('jquery', Scripts::FRAMEWORK),
				array('mousewheel', Scripts::PLUGIN - 1),
				array('jscrollpane', Scripts::PLUGIN),
			)
		),
	)
);