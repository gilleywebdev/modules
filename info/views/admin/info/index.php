<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	foreach($labels as $key => $val)
	{
		echo Form::text($key, $values[$key], array('label' => $val));
	}
	echo Form::submit('submit', 'Save');
	echo Form::close();