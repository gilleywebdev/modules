<p><a href="/admin/auth/login">Back to admin login</a></p>
<?php
	echo View::factory('includes/forms/errors');
?>
<p>Enter your e-mail and we'll send you a link you can use to reset your password.</p>
<?php
	echo Form::open();
	echo Form::text('email', NULL, array('label' => 'Email', 'id' => 'email'));
	echo Form::submit(NULL, 'Send');
	echo Form::close();
?>