CREATE TABLE products
(
	id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	description TEXT NOT NULL,
	category_id INT(3) UNSIGNED NOT NULL,
	price DECIMAL(8, 2) UNSIGNED NOT NULL,
	promotion_id INT(5) UNSIGNED,
	quantity INT(5) UNSIGNED NOT NULL,
	status VARCHAR(20) NOT NULL,
	featured BOOLEAN NOT NULL,
    CHECK (status IN ('IN_STOCK', 'OUT_OF_STOCK', 'END_OF_LIFE')),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (promotion_id) REFERENCES promotions(id)
);

CREATE TABLE categories
(
	id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL
);

CREATE TABLE promotions
(
	id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	starts_at TIMESTAMP NOT NULL DEFAULT 'CURRENT_TIMESTAMP',
	ends_at TIMESTAMP NOT NULL DEFAULT 'CURRENT_TIMESTAMP',
	discount DECIMAL(4, 2) UNSIGNED NOT NULL DEFAULT 0
);

CREATE TABLE reviews
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	customer_id INT(7) UNSIGNED NOT NULL, 
	product_id INT(5) UNSIGNED NOT NULL,
	comment TEXT NOT NULL,
	rating INT(1) NOT NULL,
	created_at DATETIME NOT NULL,
    CHECK (rating BETWEEN 1 AND 5),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE images
(
	id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT(5) UNSIGNED NOT NULL,
	path VARCHAR(255) NOT NULL,
	alt_text VARCHAR(255) NOT NULL,
	featured BOOLEAN NOT NULL,
	FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE users
(
	id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	email VARCHAR(100) UNIQUE NOT NULL,
	password VARCHAR(100) NOT NULL,
	role VARCHAR(20) NOT NULL,
    CHECK (role IN ('ADMIN', 'CUSTOMER'))
);

CREATE TABLE customers
(
	id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(7) UNIQUE UNSIGNED NOT NULL,
	first VARCHAR(50) NOT NULL,
	last VARCHAR(50) NOT NULL,
	dob DATE NOT NULL,
	phone VARCHAR(15) NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE payment_methods
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	customer_id INT(7) UNSIGNED NOT NULL,
	type VARCHAR(20) NOT NULL,
	cardholder VARCHAR(100) NOT NULL,
	last_digits INT(4) UNSIGNED NOT NULL,
	address_id INT(10) UNSIGNED NOT NULL,
    CHECK (type IN ('VISA', 'MASTERCARD', 'INTERAC')),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (address_id) REFERENCES addresses(id)
);

CREATE TABLE orders
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	customer_id INT(7) UNSIGNED NOT NULL,
	address_id INT(10) UNSIGNED NOT NULL,
	method_id INT(10) UNSIGNED NOT NULL,
	status VARCHAR(20) NOT NULL,
	total DECIMAL(8, 2) UNSIGNED NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT 'CURRENT_TIMESTAMP',
    CHECK (status IN ('PENDING', 'APPROVED', 'DELIVERED', 'CANCELLED', 'ERROR')),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (address_id) REFERENCES addresses(id),
    FOREIGN KEY (method_id) REFERENCES payment_methods(id)
);

CREATE TABLE order_details
(
	id INT(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	order_id INT(10) UNSIGNED NOT NULL,
	product_id INT(5) UNSIGNED NOT NULL,
	price DECIMAL(8, 2) UNSIGNED NOT NULL,
	quantity INT(5) UNSIGNED NOT NULL,
	FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE addresses
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	street VARCHAR(255) NOT NULL,
	city VARCHAR(50) NOT NULL,
	state VARCHAR(50) NOT NULL,
	country VARCHAR(50) NOT NULL,
	zip VARCHAR(10) NOT NULL
);

CREATE TABLE carts
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	customer_id INT(7) UNSIGNED,
	sess_id VARCHAR(50),
	created_at DATETIME NOT NULL,
	FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE cart_details
(
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	cart_id INT(10) UNSIGNED NOT NULL,
	product_id INT(5) UNSIGNED NOT NULL,
	quantity INT(5) UNSIGNED NOT NULL,
	FOREIGN KEY (cart_id) REFERENCES carts(id),
	FOREIGN KEY (product_id) REFERENCES products(id)
);


-- DB prepping

-- users
INSERT INTO users (name, email, password, role) VALUES ('Alex', 'alex@gmail.com', '123456', 'ADMIN');
INSERT INTO users (name, email, password, role) VALUES ('Josh', 'josh@gmail.com', '123456', 'ADMIN');
INSERT INTO users (name, email, password, role) VALUES ('David', 'david@gmail.com', '123456', 'CUSTOMER');
INSERT INTO users (name, email, password, role) VALUES ('Julia', 'julia@gmail.com', '123456', 'CUSTOMER');

INSERT INTO categories (name) VALUES ('Electronics');