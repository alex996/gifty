<?php

Router::get('[/]', function() {
	View::render('welcome.php', ['name' => 'alex']);
});

// Auth routes
Router::get('login', 'AuthController@showLogin');
Router::post('login', 'AuthController@login');
Router::get('register', 'AuthController@showRegister');
Router::post('register', 'AuthController@register');
Router::post('logout', 'AuthController@logout');

Router::get('users', 'UsersController@index');

Router::get('blog/(\w+)/(\d+)', function($category, $id){
	print $category . ':' . $id;
});

Router::get('products', 'ProductsController@index');

Router::get('products/(\d+)', 'ProductsController@show');

Router::post('products', 'ProductsController@store');

Router::fallback(function() {
	echo "404";
});