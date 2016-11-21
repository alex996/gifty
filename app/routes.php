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

/*
 *	Account routes (customers ONLY).
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

/**
 *  Cart routes.
 */
Router::get('cart', 'CartController@index');
Router::post('cart', 'CartController@store');
Router::patch('cart/cart-details/(\d+)', 'CartController@update');
Router::delete('cart/cart-details/(\d+)', 'CartController@destroy');





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