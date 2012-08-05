<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	echo Form::text('username', NULL, array('label' => 'Username'));
	echo Form::text('email', NULL, array('label' => 'Email'));
	echo Form::password('password1', NULL, array('label' => 'Password'));
	echo Form::password('password2', NULL, array('label' => 'Confirm Password'));
	echo Form::submit('sumbit', 'Add User');
	echo Form::close();