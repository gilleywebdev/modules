<h2>Change Password</h2>
<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	echo Form::password('password1', '', array('label' => 'New Password'));
	echo Form::password('password2', '', array('label' => 'Confirm Password'));
	echo Form::submit(NULL, 'Update');
	echo Form::close();
?>