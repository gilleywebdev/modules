<?php
	echo Form::open('adminpost/login');
	echo Form::text('username', NULL, array('label' => 'Username'));
	echo Form::password('password', NULL, array('label' => 'Password'));
	echo Form::submit(NULL, 'Login');
	echo Form::close();