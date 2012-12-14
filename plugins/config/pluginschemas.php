<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'jscrollpane' => array(
		'styles' => array(
			array('jscrollpane', Styles::PLUGIN),
		),
		'scripts' => array(
			array('jquery', Scripts::FRAMEWORK),
			array('mousewheel', Scripts::DEPENDENCY),
			array('jscrollpane', Scripts::PLUGIN),
		)
	),
	'cycle' => array(
		'scripts' => array(
			array('jquery', Scripts::FRAMEWORK),
			array('cycle', Scripts::PLUGIN),
		),
	),
	'cyclelite' => array(
		'scripts' => array(
			array('jquery', Scripts::FRAMEWORK),
			array('cyclelite', Scripts::PLUGIN),
		),
	),
	'handsontable' => array(
		'scripts' => array(
			array('jquery', Scripts::FRAMEWORK),
			array('autoresize', Scripts::DEPENDENCY),
			array('handsontable', Scripts::PLUGIN),
		),
		'styles' => array(
			array('handsontable', Styles::PLUGIN),
		)
	),
);