<ul class="navigation">
	<?php foreach($modules AS $name => $label): ?>
		<li class="nav_item <?php echo $name ?>"><a href="/admin/<?php echo $name ?>" title="<?php echo $label ?>" class="nav_item_link"><?php echo $label ?></a></li>
	<?php endforeach; ?>
</ul>