<?php

Router::get('[/]', 'HomeController@index');

/**
 *	Auth routes.
*/
Router::get('login', 'AuthController@show_login');
Router::post('login', 'AuthController@login');
Router::get('register', 'AuthController@show_register');
Router::post('register', 'AuthController@register');
Router::post('logout', 'AuthController@logout');

/**
 *	Account routes (customers ONLY).
*/
Router::get('account', 'AccountController@index');
Router::post('account', 'CustomerController@store');
Router::get('account/profile', 'CustomerController@show');
Router::patch('account/profile', 'CustomerController@update_phone');

Router::get('account/orders', 'OrderController@index');
Router::get('account/orders/(\d+)', 'OrderController@show');
Router::patch('account/orders/(\d+)/order-details/(\d+)', 'OrderController@update_quantity');
Router::delete('account/orders/(\d+)/order-details/(\d+)', 'OrderController@delete_detail');

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


/**
 *	Product routes.
 */
Router::get('products', 'ProductController@index');
Router::get('products/(\d+)', 'ProductController@show');
Router::get('products/(\w+)', 'ProductController@index_category');
Router::post('products/(\d+)/reviews', 'ProductController@store_review');

/**
 * 	Checkout routes.
 */
Router::get('/checkout/shipping', 'CheckoutController@show_shipping');
Router::post('/checkout/shipping', 'CheckoutController@store_shipping');
Router::get('/checkout/payment', 'CheckoutController@show_payment');
Router::post('/checkout/payment', 'CheckoutController@store_payment');
Router::get('/checkout/confirmation', 'CheckoutController@show_confirmation');
Router::post('/checkout/confirmation', 'CheckoutController@confirm');
Router::get('/checkout/success', 'CheckoutController@success');

/**
 *	Fallback route (404 error).
 */
Router::fallback('HomeController@fallback');