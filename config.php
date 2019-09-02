<?php

# PHP config
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

# Paths
define('BASE_PATH', 'http://localhost/');

define('DIR_LIB',			'core/lib/');
define('DIR_APP',			'app/');
define('DIR_CONTROLLER',	'app/controller/');
define('DIR_MODEL',			'app/model/');
define('DIR_TEMPLATE',		'app/tpl/');
define('DIR_JS',			'src/');

# MVC settings
define('DEFAULT_CONTROLLER',	'arrivals');
define('DEFAULT_ACTION', 		'index');
define('DEFAULT_NOT_FOUND', 	'notFound');

define('BASE_APP_CONTROLLER', 'baseAppController');

define('DEVELOPMENT_MODE', true);

#Database
$db_config = [
	"server" => "localhost",
	"database" => "svemirko",
	"username" => "root",
	"password" => "pass",
	"prefix" => "svemirko"
];
