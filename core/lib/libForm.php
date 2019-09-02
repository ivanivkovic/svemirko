<?php 

class libForm
{
	# Validates a form for mandatory filled values.
	public static function contains($data, $fields)
	{
		foreach($fields as $field)
		{
			if(!isset($data[$field]) || $data[$field] === '')
			{
				return false;
			}
		}

		return true;
	}
}