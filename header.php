<?php
include_once("connection.php");
date_default_timezone_set('Asia/Kolkata');
ob_start();
session_start();
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
setcookie("error", "9", time() - 578977, "/");
// setcookie("error", "9", time() - 5, "/");
$url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($url);
$url1 = $parsed_url['path'];
$parts = explode("/", $url1);
$current_time = date("Y-m-d H:i:s");
$query = "UPDATE offers SET status='Inactive' WHERE NOT ('$current_time' BETWEEN start_date AND end_date)";

mysqli_query($con, $query);
$query = "UPDATE offers SET status='Active' WHERE ('$current_time' BETWEEN start_date AND end_date)";

mysqli_query($con, $query);
$delete_query = "DELETE FROM password_token WHERE expires_at < '$current_time'";
mysqli_query($con, $delete_query);
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
    <link rel="stylesheet" href="css/style.css">

</head>
<?php
if (isset($_SESSION['admin'])) {
    //Admin Navbar
    $email = $_SESSION['admin'];
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
                                        <a class="nav-link text-white <?php if ($parts[2] == "manage_category.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="manage_category.php">Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "manage_products.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="manage_products.php">Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white <?php if ($parts[2] == "manage_inquiry.php") {
                                                                            echo "active btn btn-success    ";
                                                                        } ?>" href="admin_manage_inquiry.php">Inquiry</a>
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
                                        <div class="dropdown">
                                            <a class="nav-link text-white dropdown-toggle <?php if ($parts[2] == "site_settings.php") {
                                                                                                echo "active btn btn-success";
                                                                                            } ?>" href="#" id="siteSettingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Site Settings
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="siteSettingsDropdown">
                                                <li><a class="dropdown-item" href="admin_manage_about.php">About Page</a></li>
                                                <li><a class="dropdown-item" href="admin_manage_best_practices.php">Best Practices</a></li>
                                                <li><a class="dropdown-item" href="admin_manage_contact.php">Contact Us</a></li>
                                                <li><a class="dropdown-item" href="admin_manage_slider.php">Slider</a></li>

                                            </ul>
                                </ul>
                            </div>
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
} else if (isset($_SESSION['user'])) {
    //User Navbar
    $email = $_SESSION['user'];
    $q = "select * from registration where email='$email'";
    $result = mysqli_query($con, $q);
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
                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($parts[2] == "view_cart.php") {
                                                                    echo "active btn btn-success    ";
                                                                } ?>" href="view_cart.php">Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($parts[2] == "view_wishlist.php") {
                                                                    echo "active btn btn-success    ";
                                                                } ?>" href="view_wishlist.php">WishList</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($parts[2] == "user_order.php") {
                                                                    echo "active btn btn-success    ";
                                                                } ?>" href="user_order.php">My Orders</a>
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
                                                <li><a class="dropdown-item" href="user_change_password.php">Change Password</a></li>
                                                <li><a class="dropdown-item" href="user_view_profile.php">View Profile</a></li>
                                                <li><a class="dropdown-item" href="user_logout.php">Logout</a></li>
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
    } else {
        //Guest Navbar
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
            <?php
        }
            ?>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">

                        <?php
                        if (isset($_COOKIE['success']) || isset($_COOKIE['error'])) {
                            $message = isset($_COOKIE['success']) ? $_COOKIE['success'] : $_COOKIE['error'];
                            $alertType = isset($_COOKIE['success']) ? 'success' : 'danger';
                            $strongText = isset($_COOKIE['success']) ? 'Success!' : 'Error!';
                        ?>
                            <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
                                <strong><?php echo $strongText; ?></strong> <?php echo htmlspecialchars($message); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            // Clear the cookie after displaying the message
                            setcookie('success', '', time() - 3600, '/');
                            setcookie('error', '', time() - 3600, '/');
                        }

                        ?>

                    </div>
                </div>
            </div>