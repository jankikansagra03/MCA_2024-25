<?php
session_start();
include("connection.php");
// include_once("header.php");
// include_once('user_authentication.php');
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $q = "select * from address where id=$id";
    $r = mysqli_query($con, $q);
    $address = mysqli_fetch_assoc($r);
    $_SESSION['address'] = $address['delivery_address'];
    echo $address['delivery_address'];
}
