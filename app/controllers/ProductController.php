<?php

class ProductController extends Controller {
	
	public function index() {
		
	}

	public function create() {
		
	}


	// Create a new user:
	public function store() {
		print_r($_POST);
	}

	public function show($id) {
		
	}

	public function edit() {
		
	}

	public function update() {
		print_r($_POST);
	}

	public function destroy() {
		print_r($_POST);
	}

	public function index() {
		
	}

	public function show($id) {
		echo "product $id";
	}
}