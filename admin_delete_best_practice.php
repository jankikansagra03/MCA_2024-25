<?php
include_once("header.php");
include_once('admin_authentication.php');

$id = $_GET['id'];
$q1 = "select * from best_practices where id=$id";
$result = mysqli_query($con, $q1);

$q = "delete from best_practices where `id`=$id";

if (mysqli_query($con, $q)) {
    while ($r = mysqli_fetch_assoc($result)) {
        unlink("images/best_practices/" . $r['img_name']);
    }
    setcookie('success', 'Image Deleted Sucessfully', time() + 5, "/");
} else {
    setcookie('error', 'Error in deleting image. Try again', time() + 5, "/");
}
echo "<script> window.location.href = 'admin_manage_best_practices.php';</script>";
