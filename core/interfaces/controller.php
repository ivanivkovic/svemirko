<?php

interface ControllerInterface
{
	public function __construct($route, $db);
	public function index();
}

class BaseController implements ControllerInterface
{
	protected $db;				# Stores the database object
	protected $dir;				# Logs its own include directory
	protected $params;			# GET parameters from router
	protected $post_fields;		# POST parameters from router
	protected $files;			# Template files ready for buffering
	protected $controller;		# Own controller name
	protected $action;			# Current method name
	protected $view_data;		# Contains data passable to template files, extracted during buffer

	public function __construct($route, $db)
	{
		$this->db 			= $db;
		$this->controller 	= $route->controller;
		$this->action 		= $route->action;
		$this->params 		= $route->params;
		$this->post_fields 	= $route->post_fields;
		$this->dir 			= DIR_CONTROLLER . $route->controller . '/';

		$this->view_data = array(
			'controller' => $this->controller,
			'action' => $this->action
		);
	}
	
	public function index(){}

	# Stores a template file for buffering by order
	protected function addTpl($file)
	{
		$this->files[] = DIR_TEMPLATE . $file . '.php';
	}

	# Stores a page view file for buffering by order
	protected function addView($file)
	{
		$this->files[] = $this->dir . $file . '.php';
	}

	# Start buffer, load variables and print output
	protected function runHTML($data = [])
	{
		$data['messages'] = $this->messages;

		//ob_end_clean();
		//ob_start();
		header('Content-Type:text/html');

		extract($data);
		extract($this->view_data);

		foreach($this->files as $file)
		{
			include($file);
		}

		//ob_end_flush();
		die();
	}

	# Include HTTP status code if needed
	protected function addHTTPStatusCode($code)
	{
		http_response_code($code);
	}

	# Start buffer, print JSON object
	protected function runJSON($json_data = [])
	{
		ob_end_clean();
		ob_start();
		
		header('Content-Type: application/json');
		echo json_encode($json_data);

		ob_end_flush(); die();
	}

	# Redirect to a location
	protected function redirect($url)
	{
		header('Location: ' . $url);
		die();
	}
}