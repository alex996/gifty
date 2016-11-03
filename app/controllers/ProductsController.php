<?php

class ProductsController {
	
	public static function index() {
		echo "products";
	}

	public static function show($id) {
		echo "product $id";
	}

	public static function store() {
		echo "products posted";
	}

	public static function update($id) {
		echo "product $id in update";
	}
}