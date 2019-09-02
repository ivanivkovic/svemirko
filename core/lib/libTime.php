<?php

class libTime
{
	public static function getCurrentTimestamp()
	{
		return time();
	} 

	public static function getCurrentTimestampInMiliseconds($bool = false)
	{
		return intval(microtime(true));
	}

	public static function stringToTime($string)
	{
		return strtotime($string);
	}

	public static function getDateFromTimestamp($timestamp, $format = 'm/d/y')
	{
		return date($format, $timestamp);
	}
}