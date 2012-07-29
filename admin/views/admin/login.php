<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	echo Form::text('username', NULL, array('label' => 'Username'));
	echo Form::password('password', NULL, array('label' => 'Password'));
	echo Form::submit(NULL, 'Login');
	echo Form::close();