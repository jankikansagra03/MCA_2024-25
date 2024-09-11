<?php
include_once("connection.php");
session_start();
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($url);
$url1 = $parsed_url['path'];
$parts = explode("/", $url1);
// echo $parts[2];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap/min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/additional-methods.js"></script>


</head>

<body>
    <div class="container-fluid">
        <div class="row bg-dark">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar" href="index.php"><img src="images/logo_white.png" height="10%" width="35%" /> </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-90">
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($parts[2] == "index.php") {
                                                            echo "active btn btn-success    ";
                                                        } ?>" aria-current="page" href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($parts[2] == "gallery.php") {
                                                            echo "active btn btn-success    ";
                                                        } ?>" href="gallery.php">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($parts[2] == "about.php") {
                                                            echo "active btn btn-success    ";
                                                        } ?>" href="about.php">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($parts[2] == "contact.php") {
                                                            echo "active btn btn-success    ";
                                                        } ?>" href="contact.php">Contact Us</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="Register.php">Link</a>
                                </li> -->

                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                                </li> -->
                            </ul>
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-success" type="submit">Search</button>
                            </form>
                            &nbsp;&nbsp;
                            <a href="register.php"> <button class="btn btn-success" type="button">Sign Up</button></a>&nbsp;&nbsp;
                            <a href="login.php"><button class="btn btn-success" type="button">Sign In</button></a>&nbsp;
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                if (isset($_COOKIE['success'])) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> <?php echo $_COOKIE['success']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
                if (isset($_COOKIE['error'])) {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> <?php echo $_COOKIE['error']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>