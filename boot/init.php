<?php

// Define directory path constants:
require_once('../config/dir.php');

// Define application constants:
require_once('../config/app.php');

// Turn error reporting on:
error_reporting(E_ALL);

// Configure the environment:
if (DEV_MODE) {
	// Turn error displaying on:
	ini_set('display_errors', 1);
}
else {
	// Turn error displaying off:
	ini_set('display_errors', 0);
	// Turn error loggin on:
	ini_set('log_errors', 1);
	ini_set('error_log', ROOT_PATH.'error.log');
}

// Set timezone to UTC (i.e. GMT) with 0 offset
date_default_timezone_set('UTC');

// Start the session:
session_start();

// Load the Router class:
require_once(SRC_PATH . "Router.php");

// Load the Connection class:
require_once(SRC_PATH . "Connection.php");

// Load the Database class:
require_once(SRC_PATH . "DB.php");

// Load the Model class:
require_once(SRC_PATH . "Model.php");

// Load the Model Name Resolver class:
require_once(SRC_PATH . "ModelResolver.php");

// Load the Controller class:
require_once(SRC_PATH . "Controller.php");

// Load the View class:
require_once(SRC_PATH . "View.php");

// Load the Authentication class:
require_once(SRC_PATH . "Auth.php");

// Load the Validator class:
require_once(SRC_PATH . "Validator.php");

// Load user-defined routes:
require_once(APP_PATH . "routes.php");

// Begin routing:
Router::execute();
