<?php defined('SYSPATH') OR die('No direct access allowed.');

class Email extends Email_Core {
	
	public static function send($to, $from, $subject, $body, $html = FALSE)
	{
		Kohana::$log->add(
			Log::NOTICE,
			sprintf(
				'EMAIL SENT
				From: %s
				To: %s
				Subject: %s
				Body: %s
				HTML: %s',
				$from, $to, $subject, $body, $html
			)
		);
		
		parent::send($to, $from, $subject, $body, $html);
	}
}
