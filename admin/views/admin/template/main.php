<!DOCTYPE html>
<html>
	<head>
		<?php //echo View::factory('admin/includes/header'); ?>
		<?php foreach ($styles as $style => $media) echo HTML::style($style, array('media' => $media), NULL, TRUE), "\n" ?>
 
		<script type="text/javascript" src="/admin/media/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/admin/media/js/jquery-ui-1.8.20.custom.min.js"></script>
		<script type="text/javascript" src="/admin/media/js/wymeditor/jquery.wymeditor.js"></script>		
		<script type="text/javascript" src="/admin/media/js/admin.js"></script>
		<title><?php echo $title; ?></title>
	</head>
	<body id="<?php echo Request::current()->action(); ?>">
		<div id="wrapper">
			<div id="navigation">
				<?php echo View::factory('admin/includes/navigation'); ?>
			</div>
			<div id="content">
				<div id="page_title" class="clear">
					<h2><?php echo $title; ?></h2>
					<h3>Logged in as <a href="/admin/user" title="User">chris</a>. <a href="/admin/logout">Log out</a></h3>
				</div>
				<div id="inner_content">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
	</body>
</html>