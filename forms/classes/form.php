<?php defined('SYSPATH') or die('No direct script access.');

class Form extends Kohana_Form {	
	private static function wrap($string, $name, $class)
	{
		return '<div id="'.$name.'_wrap" class="'.$class.' form_field_wrapper">'.$string.'</div>';
	}
	
	public static function input($name, $value = NULL, array $attributes = NULL)
	{
		// Intercept label
		if(isset($attributes['label']))
		{
			$inner = self::label($name, $attributes['label']);
			unset($attributes['label']);
		}
		else{
			$inner = '';
		}
		
		$inner .= parent::input($name, $value, $attributes);

		return self::wrap(
			$inner,
			$name,
			'textbox'
		);
	}

	public static function password($name, $value = NULL, array $attributes = NULL)
	{
		// Intercept label
		if(isset($attributes['label']))
		{
			$inner = self::label($name, $attributes['label']);
			unset($attributes['label']);
		}
		else{
			$inner = '';
		}
		
		$inner .= parent::password($name, $value, $attributes);

		return self::wrap(
			$inner,
			$name,
			'password'
		);
	}

	public static function file($name, array $attributes = NULL)
	{
		// Intercept label
		if(isset($attributes['label']))
		{
			$inner = self::label($name, $attributes['label']);
			unset($attributes['label']);
		}
		else{
			$inner = '';
		}
		
		$inner .= parent::file($name, $attributes);

		return self::wrap(
			$inner,
			$name,
			'file'
		);
	}

	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL)
	{
		// Intercept label
		if(isset($attributes['label']))
		{
			$inner = self::label($name, $attributes['label']);
			unset($attributes['label']);
		}
		else{
			$inner = '';
		}
		
		$inner .= parent::select($name, $options, $selected, $attributes);

		return self::wrap(
			$inner,
			$name,
			'select'
		);
	}
	
	public static function textarea($name, $body = '', array $attributes = NULL, $double_encode = TRUE)
	{
		// Intercept label
		if(isset($attributes['label']))
		{
			$inner = self::label($name, $attributes['label']);
			unset($attributes['label']);
		}
		else{
			$inner = '';
		}
		
		$inner .= parent::textarea($name, $body, $attributes, $double_encode);

		return self::wrap(
			$inner,
			$name,
			'textarea'
		);
	}

}
