<?php

# Configuration and core library inclusion.
include('config.php');

include('core/lib/libSession.php');
include('core/lib/libDatabase.php');
include('core/lib/libForm.php');
include('core/lib/functions.php');

include('core/interfaces/controller.php');
include('core/interfaces/model.php');
include('core/route.php');

# Create/resume the session.
Session::start();

# Set an autoload function to include models/libs when required.
spl_autoload_register
(
	function($class)
	{
		if(strpos($class, 'Model') !== FALSE)
		{
	    		include(DIR_MODEL . $class . '.php');
   		}
    		else if(strpos($class, 'lib') !== FALSE)
    		{
    			include(DIR_LIB . $class . '.php');
    		}
	}
);

# Initizalize database connection.
$db = new Database($db_config);
if(!$db->connected())
{
	print($db->getLastLog()); die();
}

# Include base app controller if created.
if(BASE_APP_CONTROLLER !== '')
{
	include(DIR_APP . BASE_APP_CONTROLLER . '.php');
}

# Reading GET/POST information and setting up required variables.
$route = new Route(DEFAULT_CONTROLLER, DEFAULT_ACTION);

$controller_name = $route->controller . 'Controller';
$file_name = DIR_CONTROLLER . $route->controller . '/' . $controller_name . '.php';

if(file_exists($file_name))
{
	include($file_name);
}

# If there is no matching path, set up 404.
if(!is_callable(array($controller_name, $route->action)))
{
	$route->controller = DEFAULT_NOT_FOUND;
	$route->action = DEFAULT_ACTION;

	$controller_name = DEFAULT_NOT_FOUND . 'Controller';
	$file_name = DIR_CONTROLLER . DEFAULT_NOT_FOUND . '/' . $controller_name . '.php';

	if(file_exists($file_name)){ include($file_name); }
}

# Once the routing is setup, run z MVC app.
$action = $route->action;

$controller = new $controller_name($route, $db);
$controller->$action();

# Clean up
$db->disconnect();
