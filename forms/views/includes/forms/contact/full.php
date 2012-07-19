<?php
	if($errors)
	{
		echo '<div class="errors"><ul>';
		foreach($errors AS $message)
		{
			echo '<li>'.$message.'</li>';
		}
		echo '</ul></div>';
	}
	echo Form::open('contact');
	echo Form::text('name', NULL, array('label' => 'Name'));
	echo Form::text('email', NULL, array('label' => 'Email'));
	echo Form::text('honeypot', NULL, array('label' => 'Leave this blank'));	
	echo Form::action('contact');
	echo Form::textarea('message', NULL, array('label' => 'Message'));
	echo Form::submit(NULL, 'Submit');
	echo Form::close();