<?php
	if($errors)
	{
		foreach($errors AS $message)
		{
			echo '<p>'.$message.'</p>';
		}
	}
	echo Form::open('contact');
	echo Form::input('name', NULL, array('label' => 'Name:'));
	echo Form::input('email', NULL, array('label' => 'Email:'));
	echo Form::input('honeypot', NULL, array('label' => 'Leave this blank:'));	
	echo Form::hidden('formaction', 'contact');
	echo Form::textarea('message', NULL, array('label' => 'Message:'));
	echo Form::submit(NULL, 'Submit');
	echo Form::close();
