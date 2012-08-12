<?php if(isset($error) && $error): ?>
	<div class="result errors">
		<ul>
	<?php foreach($error AS $message): 
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
		<li><?php echo $success; ?></li>
		</ul>
	</div>
<?php endif; ?>