<?php if ($pages): ?>
	<?php echo View::factory('includes/forms/errors') ?>
	<div class="spreadsheet"></div>
	<?php echo Form::open() ?>
	<?php echo Form::submit(NULL, 'Save') ?>
	<?php echo Form::close() ?>
<?php else: ?>
	<p>No pages found</p>
<?php endif ?>