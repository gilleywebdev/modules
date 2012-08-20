<p><a href="/admin/auth/login">Back to admin login</a></p>
<p>Hi, <strong><?php echo $me->username; ?></strong></p>
<h2>New Password</h2>
<?php
	echo View::factory('includes/forms/errors');
	echo Form::open();
	echo Form::password('password', '', array('label' => 'New Password'));
	echo Form::password('password_confirm', '', array('label' => 'Confirm Password'));
	echo Form::submit(NULL, 'Update');
	echo Form::close();
?>
