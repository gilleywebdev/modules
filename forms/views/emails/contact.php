<?php
	foreach($post AS $key => $val)
	{
		if($key !== 'honeypot' && $key !== 'formaction')
		{
			echo '<p><b>'.$key.'</b>: '.$val.'</p>';
		}
	}
?>