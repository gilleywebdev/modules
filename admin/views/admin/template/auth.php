<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
	</head>
	<body class="<?php echo Request::current()->action(); ?>_page">
		<div class="wrapper">
			<div class="content">
				<?php echo $content; ?>
			</div>
		</div>
	</body>
</html>
<?php Scripts::output() ?>