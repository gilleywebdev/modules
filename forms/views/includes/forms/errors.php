<?php if(isset($errors) && $errors): ?>
	<div class="result errors">
		<ul>
	<?php foreach($errors AS $message): ?>
		<li><?php echo $message; ?></li>
	<?php endforeach; ?>
		</ul>
	</div>
<?php elseif(isset($success)): ?>
	<div class="result success">
		<ul>
	<?php foreach($success AS $message): ?>
		<li><?php echo $message; ?></li>
	<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>