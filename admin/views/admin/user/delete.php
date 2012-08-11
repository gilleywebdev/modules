<p>Are you sure you want to delete <strong><?php echo $user->username; ?></strong>? This cannot be undone</p>
<div class="are_you_sure">
	<div class="response">
	<?php
		echo Form::open();
		echo Form::hidden('response', 'yes');
		echo Form::submit('submit', 'Yes');
		echo Form::close(); ?>
	</div>
	<div class="response">
	<?php	
		echo Form::open();
		echo Form::hidden('response', 'no');
		echo Form::submit('submit', 'No');
		echo Form::close(); ?>
	</div>
</div>