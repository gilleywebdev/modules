<!DOCTYPE html>
<html>
	<head>
		<?php 
			Styles::add(array('admin', 'login'), Styles::PAGE);
		
			echo View::factory('admin/includes/header')
					->bind('title', $title)
		?>
	</head>
	<body class="<?php echo Request::current()->action(); ?>_page">
		<div class="wrapper">
			<div class="content">
				<?php
					echo View::factory('includes/forms/errors');
					echo Form::open();
					echo Form::text('username', NULL, array('label' => 'Username', 'id' => 'user_login'));
					echo Form::password('password', NULL, array('label' => 'Password'));
					echo Form::checkbox('remember_me', NULL, FALSE, array('label' => 'Remember Me'));
					echo Form::submit(NULL, 'Login');
					echo Form::close();
				?>
			</div>
			<p><a href="/admin/auth/forgotpassword">Forgot password?</a></p>
		</div>
	</body>
</html>
<?php
	Scripts::output(
		array(
			array('login', Scripts::CONTROLLER),
		)
	)
?>