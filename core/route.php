<?php

class Route
{
	public $path; 			# route path, such as /login/redirect/4
	public $controller;		# application controller
	public $action;			# controller's method
	public $params;			# GET values
	public $post_fields;	# POST values

	# Construct the route & define values
	public function __construct($default_controller='', $default_action='')
	{
		if($default_controller !== "" && $default_action !== "")
		{
			$this->setRoute($default_controller, $default_action);
		}
	}
	
	# Set route data based on HTTP input	
	public function setRoute($default_controller, $default_action)
	{
		# .htaccess config rewrites GET string to $_GET['rt'] string.

		# 1st label 	= controller
		# 2nd label 	= method
		# 3rd and above = GET parameters without key

		if( isset( $_GET['rt'] ) )
		{
			$this->path = $_GET['rt'];
			
			$parts = explode('/', $this->path);
			
			# If bad string, replace it with default controller and method.
			$this->controller = isset($parts[0]) && $parts[0] != '' ? $parts[0] : $default_controller;
			$this->action = isset($parts[1]) && $parts[1] != '' ? $parts[1] : $default_action;

			# Any remaining string parts are stored as GET values.  
			if( count( $parts ) > 2 )
			{
				unset($parts[0]);
				unset($parts[1]);
				
				foreach ($parts as $param)
				{
					$this->params[] = $param;
				}
			}
		}
		else
		{
			# In case no path, load default controller and method.
			$this->controller = $default_controller;
			$this->action = $default_action;
		}

		# $_POST fields are stored as $post_field
		$this->post_fields = $_POST;
	}
}