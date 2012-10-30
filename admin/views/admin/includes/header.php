<!-- Encoding -->
<meta charset="UTF-8">

<!-- SEO -->
<title><?php echo $title ?></title>

<!-- Styles -->
<?php Styles::output(
	array('admin', 'styles'),
	array(
		array('normalize', Styles::BASE),
		array(array('admin', 'template'), Styles::TEMPLATE),
	)) ?>

<!-- Vanity -->
<link rel="shortcut icon" href="/media/admin/favicon.ico">