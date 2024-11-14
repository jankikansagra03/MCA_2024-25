<?php
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    $query = "SELECT * FROM registration WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo 'taken';
    } else {
        echo 'available';
    }
} else {
    echo 'invalid';
}

mysqli_close($con);
