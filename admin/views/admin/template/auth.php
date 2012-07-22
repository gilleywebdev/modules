<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
	</head>
	<body id="<?php echo Request::current()->action(); ?>">
		<div id="wrapper">
			<div id="content">
				<?php echo $content; ?>
			</div>
		</div>
	</body>
</html>