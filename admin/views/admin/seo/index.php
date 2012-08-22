<?php if ($pages): ?>
	<?php echo View::factory('includes/forms/errors') ?>
	<?php echo Form::open() ?>

<table>
	<thead>
		<tr>
			<th>Page</th>
			<th>Title</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($pages AS $name => $tags): ?>
		<tr>
			<td class="first"><?php echo $name ?></td>
			<td><?php echo Form::text($name.'_title', $tags['title']) ?></td>
			<td class="last"><?php echo Form::textarea($name.'_description', $tags['description']) ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
	<?php echo Form::submit(NULL, 'Save') ?>
	<?php echo Form::close() ?>
<?php else: ?>
	<p>No pages found</p>
<?php endif ?>