Production Files:

<?php foreach ($files as $file): ?>
	<?php echo $file['path'].'.'.$file['ext'] ?>

<?php endforeach ?>

List all: 

<?php var_dump($list) ?>