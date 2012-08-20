<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	echo Form::text('username', NULL, array('label' => 'Username', 'id' => 'user_login'));
	echo Form::password('password', NULL, array('label' => 'Password'));
	echo Form::checkbox('remember_me', NULL, FALSE, array('label' => 'Remember Me'));
	echo Form::submit(NULL, 'Login');
	echo Form::close();
?>
<p><a href="/admin/auth/forgotpassword">Forgot password?</a></p>