<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	echo Form::text('email', $user->email, array('label' => 'Email'));
	echo Form::submit('sumbit', 'Edit User');
	echo Form::close();