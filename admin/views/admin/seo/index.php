<p>Hello SEO World!</p>

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
	<?php foreach($pages AS $page): ?>
		<tr>
			<td><?php echo $page ?></td>
			<td><?php echo Form::input($page.'_title', 'title') ?></td>
			<td><?php echo Form::input($page.'_description', 'description') ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
	<?php echo Form::submit(NULL, 'Save') ?>
	<?php echo Form::close() ?>
<?php else: ?>
	<p>No pages found</p>
<?php endif ?>