<?php

Router::get('[/]', 'HomeController@index');

/*
 *	Auth routes.
*/
Router::get('login', 'AuthController@showLogin');
Router::post('login', 'AuthController@login');
Router::get('register', 'AuthController@showRegister');
Router::post('register', 'AuthController@register');
Router::post('logout', 'AuthController@logout');

// User routes

// Customer routes
//Router::post('customers', 'CustomerController@store');

// Account routes. 'account' substitutes 'customer/(\d+)''

/*
 *	Account routes.
*/
Router::get('account', 'AccountController@index');

Router::post('account', 'CustomerController@store');
Router::get('account/profile', 'CustomerController@show');
Router::patch('account/profile', 'CustomerController@update_phone');

Router::get('account/orders', 'OrderController@index');
Router::get('account/orders/(\d+)', 'OrderController@show');
Router::get('account/orders/(\d+)/edit', 'OrderController@edit');

Router::get('account/payment-methods', 'PaymentMethodController@index');

Router::get('account/security', 'UserController@edit_password');
Router::patch('account/security', 'UserController@update_password');






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