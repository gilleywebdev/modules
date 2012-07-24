<!-- SEO -->
<title><?php echo $title ?></title>

<!-- Styles -->
<?php Styles::output(array(
		array('normalize', Styles::BASE),
		array('template', Styles::TEMPLATE, 'admin'),
	)) ?>

<!-- Vanity -->
<link rel="shortcut icon" href="/media/admin/favicon.ico">