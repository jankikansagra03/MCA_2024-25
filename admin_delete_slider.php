<?php
include_once("header.php");
include_once('admin_authentication.php');

$id = $_GET['id'];
$q = "delete from sliders where `id`=$id";

if (mysqli_query($con, $q)) {
    setcookie('success', 'Image Deleted Sucessfully', time() + 5, "/");
} else {
    setcookie('error', 'Error in deleting image. Try again', time() + 5, "/");
}
echo "<script> window.location.href = 'admin_manage_slider.php';</script>";
