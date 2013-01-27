<?php foreach ($styles as $profile => $files): ?>
Compiling styles for profile <?php echo $profile ?>:

<?php foreach ($files as $file): ?>
	<?php echo $file['path'].'.'.$file['ext'] ?>

<?php endforeach ?>

<?php endforeach ?>