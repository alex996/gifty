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

// Start the session:
session_start();

// Load the DB class:
require_once(SRC_PATH . "DB.php");

// Load the Model class:
require_once(SRC_PATH . "Model.php");

// Load the Router class:
require_once(SRC_PATH . "Router.php");

// Load the View class:
require_once(SRC_PATH . "View.php");

// Load user-defined routes:
require_once(APP_PATH . "routes.php");

// Begin routing:
Router::execute();
