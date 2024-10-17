<?php
include_once("header.php");
if(isset($_POST['btn']))
{
    $name=$_POST['fn'];
    $em=$_POST['email'];
    $mobile=$_POST['mobile'];
    $msg=$_POST['msg'];

    $q="insert into inquiry (name,email,mobil,msg) values ('$name','$email',$mobile,'$msg')";
    $result=mysqli_query($con,$q);
    $count=
    


}