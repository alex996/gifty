CREATE TABLE products
(
	id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	description TEXT NOT NULL,
	category VARCHAR(50) NOT NULL,
	price DECIMAL(8, 2) UNSIGNED NOT NULL,
	promotion DECIMAL(4, 2) UNSIGNED NOT NULL DEFAULT 0, -- % in ex: 12.50; >= 0 and <= 99.99
	quantity INT(5) UNSIGNED NOT NULL, -- in stock
	featured BOOLEAN
);

CREATE TABLE reviews
(
	id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	customer_id INT(7) NOT NULL REFERENCES customers(id),
	comment TEXT NOT NULL,
	rating INT(1) NOT NULL CHECK rating BETWEEN 1 AND 5,
	date DATETIME NOT NULL
);

CREATE TABLE images
(
	id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id NOT NULL REFERENCES products(id),
	path VARCHAR(255) NOT NULL,
	text TEXT NOT NULL
);

CREATE TABLE users
(
	id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	role VARCHAR(10) NOT NULL CHECK IN ('ADMIN', 'CUSTOMER')
);

CREATE TABLE customers
(
	id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(7) NOT NULL REFERENCES users(id),
	first VARCHAR(255) NOT NULL,
	last VARCHAR(255) NOT NULL,
	dob DATETIME NOT NULL,
	phone VARCHAR(15) NOT NULL
);

CREATE TABLE payment_methods
(
	id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	customer_id INT(7) NOT NULL REFERENCES customers(id),
	type VARCHAR(20) NOT NULL CHECK IN ('VISA', 'MASTERCARD', 'INTERAC'),
	number INT(4) NOT NULL,
	address VARCHAR(255) NOT NULL,
	city VARCHAR(50) NOT NULL,
	state VARCHAR(50) NOT NULL,
	country VARCHAR(50) NOT NULL,
	zip VARCHAR(10) NOT NULL,
);

CREATE TABLE orders
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	customer_id INT(7) NOT NULL REFERENCES customers(id),
	address VARCHAR(255) NOT NULL,
	city VARCHAR(50) NOT NULL,
	state VARCHAR(50) NOT NULL,
	country VARCHAR(50) NOT NULL,
	zip VARCHAR(10) NOT NULL,
	date TIMESTAMP NOT NULL,
	status VARCHAR(20) NOT NULL CHECK IN ('PENDING', 'APPROVED', 'DELIVERED', 'CANCELLED', 'ERROR'),
	total DECIMAL(8, 2) UNSIGNED NOT NULL,
	pay_method_id INT(7) NOT NULL REFERENCES payment_methods(id),
);

CREATE TABLE order_details
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	order_id INT(7) NOT NULL REFERENCES orders(id),
	product_id INT(5) NOT NULL REFERENCES products(id),
	price DECIMAL(8, 2) UNSIGNED NOT NULL,
	quantity INT(5) UNSIGNED NOT NULL
);

CREATE TABLE carts
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(7) REFERENCES users(id),
	sess_id VARCHAR(50),
	date DATETIME NOT NULL
);

CREATE TABLE cart_details
(
	id INT(10) PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	cart_id INT(7) NOT NULL REFERENCES carts(id),
	product_id INT(5) NOT NULL REFERENCES products(id),
	quantity INT(5) UNSIGNED NOT NULL
);