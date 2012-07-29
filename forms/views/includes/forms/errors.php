<?php if(isset($errors)): ?>
	<div class="errors">
		<ul>
	<?php foreach($errors AS $message): ?>
		<li><?php echo $message; ?></li>
	<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>