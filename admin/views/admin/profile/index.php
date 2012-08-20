<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
?>
<h2>Change Info</h2>
<?php
	echo Form::text('username', $me->username, array('label' => 'Username'));
	echo Form::text('email', $me->email, array('label' => 'Email'));
?>
<h2>Change Password</h2>
<?php
	echo Form::password('password', '', array('label' => 'New Password'));
	echo Form::password('password_confirm', '', array('label' => 'Confirm Password'));
	echo Form::submit(NULL, 'Update');
	echo Form::close();
?>