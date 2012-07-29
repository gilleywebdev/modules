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

	public static function is_posted()
	{
		if (isset($_POST))
		{
			if (isset($_POST['is_posted']))
			{
				if ($_POST['is_posted'] === 'TRUE')
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
	
	public static function action()
	{
		return Form::hidden('is_posted', 'TRUE');
	}
	
	public static function open($action = NULL, array $attributes = NULL)
	{
		$return = parent::open($action, $attributes);
		$return .= Form::action();
		return $return;
	}

	public static function text($name, $value = NULL, array $attributes = NULL)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = Form::intercept(&$attributes, 'label')) ? Form::label($name, $label) : '';

		$inner .= parent::input($name, $value, $attributes);

		return Form::wrap(
			$inner,
			$name,
			'textbox'
		);
	}
	
	public static function date($name, $value = NULL, array $attributes = NULL)
	{
		$attributes['class'] = 'datepick';
		
		return Form::text(
			$name,
			$value,
			$attributes
		);
	}

	public static function password($name, $value = NULL, array $attributes = NULL)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = Form::intercept(&$attributes, 'label')) ? Form::label($name, $label) : '';
		
		$inner .= parent::password($name, $value, $attributes);

		return Form::wrap(
			$inner,
			$name,
			'textbox'
		);
	}

	public static function file($name, array $attributes = NULL)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = Form::intercept(&$attributes, 'label')) ? Form::label($name, $label) : '';
		
		$inner .= parent::file($name, $attributes);

		return Form::wrap(
			$inner,
			$name,
			'file'
		);
	}

	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = Form::intercept(&$attributes, 'label')) ? Form::label($name, $label) : '';
		
		$inner .= parent::select($name, $options, $selected, $attributes);

		return Form::wrap(
			$inner,
			$name,
			'select'
		);
	}
	
	public static function textarea($name, $body = '', array $attributes = NULL, $double_encode = TRUE)
	{
		// if $attributes['label'] is set, append an html label and unset it
		$inner = ($label = Form::intercept(&$attributes, 'label')) ? Form::label($name, $label) : '';
		
		$inner .= parent::textarea($name, $body, $attributes, $double_encode);

		return Form::wrap(
			$inner,
			$name,
			'textarea'
		);
	}

	public static function rte($name, $body = '', array $attributes = NULL, $double_encode = TRUE)
	{
		$attributes['class'] = 'wymeditor';
		
		return Form::textarea(
			$name,
			$body,
			$attributes,
			$double_encode
		);
	}
	
	public static function submit($name, $value, array $attributes = NULL)
	{
		$attributes['class'] = 'submit';
		$attributes['type'] = 'submit';

		return Form::input($name, $value, $attributes);
	}
}
