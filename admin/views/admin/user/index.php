<p><a class="button" href="/admin/user/add">Add User</a></p>
<div class="clear"></div>
<table>
	<tr>
		<th class="first">Username</th>
		<th>Email</th>
		<th class="edit_header">Edit</th>
		<th class="delete_header">Delete</th>
	</tr>

	<?php foreach($users AS $user): ?>
		<tr class="<?php echo $user['stripe'] ?>">
			<td class="first"><?php echo $user['obj']->username ?></td>
			<td><?php echo $user['obj']->email ?></td>
			<td class="edit"><a class="edit_button" href="/admin/user/edit/<?php echo $user['obj']->id ?>" title="Edit"><img src="/media/admin/graphics/edit.png" alt="Edit"></a></td>
			<td class="delete last"><a class="delete_button" href="/admin/user/delete/<?php echo $user['obj']->id ?>" title="Delete"><img src="/media/admin/graphics/delete.png" alt="Delete"></a></td>
		</tr>
	<?php endforeach; ?>
</table>
<div class="clear"></div>
<p><a class="button" href="/admin/user/add">Add User</a></p>