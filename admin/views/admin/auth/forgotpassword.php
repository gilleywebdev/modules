<!DOCTYPE html>
<html>
	<head>
		<?php 
			Styles::add(array('admin', 'forgotpassword'), Styles::PAGE);
		
			echo View::factory('admin/includes/header')
					->bind('title', $title)
		?>
	</head>
	<body class="<?php echo Request::current()->action(); ?>_page">
		<div class="wrapper">
			<div class="content">
				<p><a href="/admin/auth/login">Back to admin login</a></p>
				<p>Enter your e-mail and we'll send you a link you can use to reset your password.</p>
				<?php
					echo View::factory('includes/forms/errors');
					echo Form::open();
					echo Form::text('email', NULL, array('label' => 'Email', 'id' => 'email'));
					echo Form::submit(NULL, 'Send');
					echo Form::close();
				?>
			</div>
		</div>
	</body>
</html>
<?php
	Scripts::output()
?>