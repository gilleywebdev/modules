<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	echo Form::text('name', NULL, array('label' => 'Name'));
	echo Form::text('email', NULL, array('label' => 'Email'));
	echo Form::text('honeypot', NULL, array('label' => 'Leave this blank'));	
	echo Form::textarea('message', NULL, array('label' => 'Message'));
	echo Form::submit(NULL, 'Submit');
	echo Form::close();