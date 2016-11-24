<?php

class Router {
	
	private static $routes = array();

	private static $fallback;
	
	private function __construct() {}

	private function __clone() {}

	public static function get($pattern, $callback) {
		self::route('GET', $pattern, $callback);
	}

	public static function post($pattern, $callback) {
		self::route('POST', $pattern, $callback);
	}

	public static function put($pattern, $callback) {
		self::route('PUT', $pattern, $callback);
	}

	public static function patch($pattern, $callback) {
		self::route('PATCH', $pattern, $callback);
	}

	public static function delete($pattern, $callback) {
		self::route('DELETE', $pattern, $callback);
	}
	
	private static function route($method, $pattern, $callback) {
		$pattern = '/^\/' . str_replace('/', '\/', $pattern) . '$/';
		self::$routes[$method][$pattern] = $callback;
	}

	public static function fallback($callback) {
		self::$fallback = $callback;
	}
	
	public static function execute() {
		if (substr($_SERVER["REQUEST_URI"], -1) === '/')
			header ('Location: '.preg_replace('{/$}', '', $_SERVER['REQUEST_URI']));

		$url = self::url();
		$method = self::method();

		if (isset(self::$routes[$method])) {
			foreach (self::$routes[$method] as $pattern => $callback) {
				if (preg_match($pattern, $url, $params)) {
					array_shift($params);

					return self::dispatch($callback, $params);
				}
			}
		}

		self::fail();
	}

	public static function redirect($path) {
		$path = trim($path, "/");
		$host = $_SERVER["HTTP_HOST"];
		header("Location: http://$host/$path");
	}

	public static function redirect_back() {
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}

	public static function url() {
		return filter_var( '/' . trim( strtok($_SERVER["REQUEST_URI"], '?'), '/' ), FILTER_SANITIZE_URL);
	}

	private static function method() {
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			return 'GET';
		}
		else if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			if (isset($_POST['_method']) && preg_match('(PUT|PATCH|DELETE)', $_POST['_method']))
				return $_POST['_method'];
			else
				return 'POST';
		}
		else
			return null;
	}

	private static function dispatch($callback, $params) {
		if (is_callable($callback))
			return call_user_func_array($callback, array_values($params));
		else {
			if (stripos($callback, '@') !== false) {
				list($controller, $method) = explode('@', $callback);
	
				if (file_exists(CTRL_PATH . "$controller.php")) {
					require_once CTRL_PATH . "$controller.php";

					if (class_exists($controller) && method_exists($controller, $method))
						return call_user_func_array(array(new $controller(), $method), $params);
					else if (!class_exists($controller))
						throw new Exception("Controller class $controller not found in $controller.php");
					else
						throw new Exception("Controller method $method not found in $controller.php");
				}
				else
					throw new Exception("Controller file $controller.php not found");
			}
			else
				throw new Exception("Bad call to controller method in routes.php at $callback");
		}
	}

	private static function fail() {
		if (self::$fallback) {
            return self::dispatch(self::$fallback, []);
            //call_user_func(self::$fallback);
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        }
	}
}