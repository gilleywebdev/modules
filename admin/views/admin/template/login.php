<!DOCTYPE html>
<html>
	<head>
		<?php echo View::factory('admin/includes/header')
				->bind('title', $title) ?>
	</head>
	<body class="<?php echo Request::current()->action(); ?>_page">
		<div class="wrapper">
			<div class="content">
				<?php
					echo View::factory('includes/forms/errors');
					echo Form::open();
					echo Form::text('username', NULL, array('label' => 'Username'));
					echo Form::password('password', NULL, array('label' => 'Password'));
					echo Form::submit(NULL, 'Login');
					echo Form::close();
				?>
			</div>
		</div>
	</body>
</html>
<?php Scripts::output() ?>