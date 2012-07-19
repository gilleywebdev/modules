<?php defined('SYSPATH') or die('No direct script access.');

class Form extends Kohana_Form {	
	private static function wrap($string, $name, $class)
	{
		return '<div id="'.$name.'_wrap" class="'.$class.' wrap">'.$string.'</div>';
	}
	
	private static function intercept($attributes, $key)
	{
		if (isset($attributes[$key]))
		{
			$return = $attributes[$key];
			unset($attributes[$key]);
			return $return;
		}
		else{
			return false;
		}
	}

	public static function have($string)
	{
		if (isset($_POST))
		{
			if (isset($_POST['formaction']))
			{
				if ($_POST['formaction'] === $string)
				{
					return true;
				}
				else{
					return false;
				}
			}
		}
		else{
			return false;
		}
	}
	
	public static function action($string)
	{
		return Form::hidden('formaction', $string);
	}

	public static function text($name, $value = NULL, array $attributes = NULL)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = self::intercept(&$attributes, 'label')) ? self::label($name, $label) : '';

		$inner .= parent::input($name, $value, $attributes);

		return self::wrap(
			$inner,
			$name,
			'textbox'
		);
	}

	public static function password($name, $value = NULL, array $attributes = NULL)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = self::intercept(&$attributes, 'label')) ? self::label($name, $label) : '';
		
		$inner .= parent::password($name, $value, $attributes);

		return self::wrap(
			$inner,
			$name,
			'password'
		);
	}

	public static function file($name, array $attributes = NULL)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = self::intercept(&$attributes, 'label')) ? self::label($name, $label) : '';
		
		$inner .= parent::file($name, $attributes);

		return self::wrap(
			$inner,
			$name,
			'file'
		);
	}

	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = self::intercept(&$attributes, 'label')) ? self::label($name, $label) : '';
		
		$inner .= parent::select($name, $options, $selected, $attributes);

		return self::wrap(
			$inner,
			$name,
			'select'
		);
	}
	
	public static function textarea($name, $body = '', array $attributes = NULL, $double_encode = TRUE)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = self::intercept(&$attributes, 'label')) ? self::label($name, $label) : '';
		
		$inner .= parent::textarea($name, $body, $attributes, $double_encode);

		return self::wrap(
			$inner,
			$name,
			'textarea'
		);
	}
}
