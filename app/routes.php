<?php

Router::get('[/]', 'HomeController@index');

// Auth routes
Router::get('login', 'AuthController@showLogin');
Router::post('login', 'AuthController@login');
Router::get('register', 'AuthController@showRegister');
Router::post('register', 'AuthController@register');
Router::post('logout', 'AuthController@logout');

// User routes

// Customer routes
Router::post('customers', 'CustomerController@store');

// Account routes
Router::get('account', 'AccountController@index');
Router::post('account', 'AccountController@store');

Router::get('users', 'UserController@index');

Router::get('blog/(\w+)/(\d+)', function($category, $id){
	print $category . ':' . $id;
});

Router::get('products', 'ProductController@index');

Router::get('products/(\d+)', 'ProductController@show');

Router::post('products', 'ProductController@store');

Router::fallback(function() {
	echo "404";
});