<h1 class="site_name"><a href="/admin/" title="Site Name" class="site_name_link"><?php echo Info::get('name'); ?></a></h1>

<ul class="navigation">
	<?php foreach(Admin::modules() AS $module): ?>
		<li class="nav_item <?php echo $module['name'] ?>"><a href="/admin/<?php echo $module['name'] ?>" title="<?php echo $module['label'] ?>" class="nav_item_link"><?php echo $module['label'] ?></a></li>
	<?php endforeach; ?>
	<li class="nav_item users first"><a href="/admin/user" title="Users" class="nav_item_link">Users</a></li>
</ul>