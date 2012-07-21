<p><a class="button" href="/admin/news/add">Add News</a></p>
<div class="clear"></div>
	<table>
		<tr>
			<th class="first">Date</th>
			<th>Headline</th>
			<th class="edit_header">Edit</th>
			<th class="delete_header">Delete</th>
		</tr>

		<?php
			$i = 1;
			foreach($news AS $story)
			{
				if($i%2){
					echo '<tr class="odd">';
				}
				else{
					echo '<tr class="even">';
				}
				echo '<td class="first">'.date('M d, Y', $story->date).'</td>';
				echo '<td>'.$story->headline.'</td>';
				echo '<td class="edit"><a href="/admin/news/edit/'.$story->id.'" title="Edit"><img src="/admin/media/graphics/edit.png" alt="Edit"></td>';
				echo '<td class="delete last"><a href="/adminpost/news/delete/'.$story->id.'" title="Delete"><img src="/admin/media/graphics/delete.png" alt="Delete"></td>';
				echo '</tr>';
				$i++;
			}
		?>
	</table>
	<div class="clear"></div>
<p><a class="button" href="/admin/news/add">Add News</a></p>