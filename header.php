<?php
include_once("connection.php");
ob_start();
session_start();
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($url);
$url1 = $parsed_url['path'];
$parts = explode("/", $url1);
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
<?php
if (isset($_SESSION['admin_user'])) {
    $email = $_SESSION['admin_user'];
    $q = "select * from registration where email='$email'";
    $result = mysqli_query($con, $q);
?>

    <body>
        <br>
        <div class="container-fluid">
            <div class="row bg-dark">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container-fluid">
                            <a class="navbar" href="index.php" style="text-decoration: none;">
                                <!-- <img src="images/logo_white.png" height="10%" width="35%" />--> </a>

                            <h1 class="text-white">Admin</h1>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-90">
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "admin_dashboard.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" aria-current="page" href="admin_dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "manage_users.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="manage_users.php">Users</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "manage_products.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="manage_products.php">Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "manage_inquiry.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="manage_inquiry.php">Inquiry</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "manage_orders.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="manage_orders.php">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "manage_offers.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="manage_offers.php">Offers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "site_settings.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="site_settings.php">Site Settings</a>
                                    </li>

                                </ul>

                                <?php
                                while ($r = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="dropdown">

                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="<?php echo "images/profile_pictures/" . $r['profile_picture']; ?>" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px;">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $r['fullname']; ?>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="admin_change_password.php">Change Password</a></li>
                                            <li><a class="dropdown-item" href="admin_view_profile.php">View Profile</a></li>
                                            <li><a class="dropdown-item" href="admin_logout.php">Logout</a></li>
                                        </ul>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    <?php
} else if (isset($_SESSION['user_uname'])) {
} else {
    ?>

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
        <?php
    }
        ?>


        <br>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                    if (isset($_COOKIE['success'])) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> <?php echo $_COOKIE['success']; ?>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    <?php
                    }
                    if (isset($_COOKIE['error'])) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> <?php echo $_COOKIE['error']; ?>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    <?php
                    }

                    setcookie('success', '', time() - 3600, '/');
                    setcookie('error', '', time() - 3600, '/');
                    ?>
                </div>
            </div>
        </div>