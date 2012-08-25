<!DOCTYPE html>
<html>
	<head>
		<?php echo View::factory('admin/includes/header')
				->bind('title', $title) ?>
	</head>
	<body class="<?php echo Request::current()->action(); ?>_page">
		<div class="wrapper">
			<div class="menu">
				<h1 class="site_name"><a href="/admin/" title="Site Name" class="site_name_link"><?php echo $header; ?></a></h1>
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
			<img src="/media/admin/graphics/button-hover.png" alt="">
		</div>
	</body>
	<?php Scripts::output() ?>
</html>