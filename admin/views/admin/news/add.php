<?php
	echo Form::open('/adminpost/news/add');
	echo Form::date('date', NULL, array('label' => 'Date'));
	echo Form::text('headline', NULL, array('label' => 'Headline'));
	echo Form::rte('text', NULL, array('label' => 'Content'));
	echo Form::submit('sumbit', 'Submit');
	echo Form::close();