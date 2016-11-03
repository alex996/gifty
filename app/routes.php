<?php

Router::get('[/]', function() {
	View::render('welcome.php', ['name' => 'alex']);
});

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