<?php
	echo Form::open('/adminpost/news/edit/'.$news->id);
	echo Form::date('date', $news->date, array('label' => 'Date'));
	echo Form::text('headline', $news->headline, array('label' => 'Headline'));
	echo Form::rte('text', $news->content, array('label' => 'Content'));
	echo Form::submit('sumbit', 'Submit');
	echo Form::close();