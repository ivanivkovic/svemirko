<?php

function debug($var, $die = false)
{
	if(DEVELOPMENT_MODE)
	{
		$file = DIR_TEMPLATE . '/debug.php';

		if(file_exists($file))
		{
			include($file);
		}
		else
		{
			var_dump($var);
		}

		if($die)
		{
			die();
		}
	}
}