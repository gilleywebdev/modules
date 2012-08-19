<h2>New Password</h2>
<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	echo Form::password('password', '', array('label' => 'New Password'));
	echo Form::password('password_confirm', '', array('label' => 'Confirm Password'));
	echo Form::submit(NULL, 'Update');
	echo Form::close();
?>