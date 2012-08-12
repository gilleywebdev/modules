<?php echo View::factory('includes/forms/errors') ?>
<p><a class="button" href="/admin/user/add">Add User</a></p>
<div class="clear"></div>
<table>
	<thead>
		<tr>
			<th class="first">Username</th>
			<th>Email</th>
			<th class="delete_header">Delete</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($users AS $user): ?>
		<tr>
			<td class="first"><?php echo $user->username ?></td>
			<td><?php echo $user->email ?></td>
			<td class="delete last"><a class="delete_button" href="/admin/user/delete/<?php echo $user->id ?>" title="Delete"><img src="/media/admin/graphics/delete.png" alt="Delete"></a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<div class="clear"></div>
<p><a class="button" href="/admin/user/add">Add User</a></p>