<?php
$con = mysqli_connect("localhost", "root", "", "MCA_2024-25");
// $q = "create database `MCA_2024-25`";

//create registration table

// $q = "CREATE TABLE registration ( id INT AUTO_INCREMENT PRIMARY KEY, fullname VARCHAR(255) NOT NULL,  email VARCHAR(255) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, address TEXT NOT NULL, gender char(10) NOT NULL, mobile_number int(15) NOT NULL, profile_picture VARCHAR(255), role CHAR(10) Default 'Normal', status Char(10) Default 'Inactive')";


// if (mysqli_query($con, $q)) {
//     echo "Table Registration created ";
// }
