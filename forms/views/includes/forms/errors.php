<?php if(isset($errors) && $errors): ?>
	<div class="result errors">
		<ul>
	<?php foreach($errors AS $message): 
			if(is_array($message)): 
				foreach($message AS $inner): ?>
					<li><?php echo $inner ?></li>
				<?php endforeach; ?>
			<?php else: ?>
				<li><?php echo $message ?></li>
			<?php endif; ?>
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