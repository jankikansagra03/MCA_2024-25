<?php
$con = mysqli_connect("localhost", "root", "", "MCA_2024-25");
// $q = "create database `MCA_2024-25`";

//create registration table

// $q = "CREATE TABLE registration ( id INT AUTO_INCREMENT PRIMARY KEY, fullname VARCHAR(255) NOT NULL,  email VARCHAR(255) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, address TEXT NOT NULL, gender char(10) NOT NULL, mobile_number int(15) NOT NULL, profile_picture VARCHAR(255), role CHAR(10) Default 'Normal', status Char(10) Default 'Inactive')";

//password token table      
// $q = "CREATE TABLE password_token (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL, otp INT NOT NULL,created_at DATETIME NOT NULL,expires_at DATETIME NOT NULL)";

//image slider table

// $q = "create table sliders(id int AUTO_INCREMENT PRIMARY KEY,img_name text(500))";
// $q = "create table best_practices(id int AUTO_INCREMENT PRIMARY KEY,img_name text(500))";

//About PAge

// $q = "CREATE TABLE about_us (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     content TEXT NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

//inquiry table

// $q = "create table inquiry(
// id INT AUTO_INCREMENT PRIMARY KEY,
// fullname char(25),
// email varchar(50),
// mobile int(10),
// message text,
// reply text,
// created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
// updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
// if (mysqli_query($con, $q)) {
//     echo "Table Registration created ";
// }
