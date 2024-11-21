<?php
$con = mysqli_connect("localhost", "root", "", "MCA_Project");
// $q = "create database `MCA_2024-25`";

//create registration table

// $q = "CREATE TABLE registration ( id INT AUTO_INCREMENT PRIMARY KEY, fullname VARCHAR(255) NOT NULL,  email VARCHAR(255) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, address TEXT NOT NULL, gender char(10) NOT NULL, mobile_number int(15) NOT NULL, profile_picture VARCHAR(255), role CHAR(10) Default 'Normal', status Char(10) Default 'Inactive', token VARCHAR(255) NOT NULL)";

//password token table      
// $q = "CREATE TABLE password_token (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL, otp INT NOT NULL,created_at DATETIME NOT NULL,expires_at DATETIME NOT NULL)";


// 

//about us 
// Start Generation Here

// Create about us table
// $q = "CREATE TABLE about_us (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     content TEXT NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

//Create about us table
// $q = "CREATE TABLE about_us (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     content TEXT NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// $q = "create table sliders(id int AUTO_INCREMENT PRIMARY KEY,img_name text(500))";
// $q1 = "create table best_practices(id int AUTO_INCREMENT PRIMARY KEY,img_name text(500))";

// inquiry table

// $q = "create table inquiry(
// id INT AUTO_INCREMENT PRIMARY KEY,
// fullname char(25),
// email varchar(50),
// mobile int(10),
// message text,
// reply text,
// created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
// updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";


// $q = "CREATE TABLE products (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_name VARCHAR(255) NOT NULL,
//     main_image VARCHAR(255) NOT NULL,
//     other_images TEXT,
//     category_id INT NOT NULL,
//     FOREIGN KEY (category_id) REFERENCES category_master(id),
//     price DECIMAL(10, 2) NOT NULL,
//     description TEXT,
// status ENUM('Active', 'Inactive') NOT NULL DEFAULT 'active',
// quantity int(10) default 0,
// discount int(2) default 0,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// $q = "CREATE TABLE category_master (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     category_name VARCHAR(255) NOT NULL,
//     status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// $q = "CREATE TABLE cart (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     email varchar(50) NOT NULL,
//     product_id INT NOT NULL,
//     quantity INT(2) NOT NULL,
//     total_price DECIMAL(10, 2) NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     FOREIGN KEY (product_id) REFERENCES products(id)
// )";

// $q = "create table cart(
// id INT AUTO_INCREMENT PRIMARY KEY,
// foreign key(id) references registration(id),
// foreign key(id) references products(id),
// quantity int(2),
// total_price int(10),
//  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// $q = "CREATE TABLE wishlist (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     email varchar(50) NOT NULL,
//     product_id INT NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     FOREIGN KEY (product_id) REFERENCES products(id)
// )";

// $q = "CREATE TABLE offers (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     offer_name VARCHAR(255) NOT NULL,
// offer_description text not null,
//     discount_percentage DECIMAL(5, 2) NOT NULL,
//     cart_total int not null,
//     max_discount int not null,
//     start_date DATETIME NOT NULL,
//     end_date DATETIME NOT NULL,
//     status ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";



// $q = "CREATE TABLE orders (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     order_id VARCHAR(255) NOT NULL,
//      sub_order_id varchar(255) NOT NULL,
//     product_id INT NOT NULL,
//     rating DECIMAL(2, 1) DEFAULT NULL,
//     review TEXT DEFAULT NULL,
//     email VARCHAR(50) NOT NULL,
//     delivery_address varchar(255) NOT NULL,
//     total_amount DECIMAL(10, 2) NOT NULL,
//     delivery_status ENUM('Ordered','Shipped','Delivered','Return','Replaced') not null default 'Ordered',
//     payment_status ENUM('Pending', 'Completed', 'Failed') NOT NULL DEFAULT 'Pending',
//      offer_name varchar(20),
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     FOREIGN KEY (product_id) REFERENCES products(id)
// )";

// $q = "CREATE TABLE address (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//      email VARCHAR(50) NOT NULL,
//         delivery_address varchar(255) NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";
// if (mysqli_query($con, $q)) {
//     echo "Table Registration created ";
// }
