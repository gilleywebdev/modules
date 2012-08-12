<!DOCTYPE html>
<html>
	<head>
		<?php echo View::factory('admin/includes/header')
				->bind('title', $title) ?>
	</head>
	<body class="<?php echo Request::current()->action(); ?>_page">
		<div class="wrapper">
			<div class="menu">
				<?php echo View::factory('admin/includes/navigation'); ?>
			</div>
			<div class="content">
				<div class="header clear">
					<h2 class="page_title"><?php echo $title; ?></h2>
					<h3 class="user_info">Logged in as <a href="/admin/profile" title="User" class="user_info_link"><?php echo $me->username ?></a>. <a href="/admin/auth/logout" class="user_info_link">Logout</a></h3>
				</div>
				<div class="inner_content">
					<?php echo $content ?>
				</div>
			</div>
		</div>
		<div id="preload">
			<img src="/media/admin/graphics/button-hover.png">
		</div>
	</body>
</html>
<?php Scripts::output() ?>