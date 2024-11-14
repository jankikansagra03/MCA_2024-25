<?php
include_once("header.php");
include_once("admin_authentication.php");
?>

<div>
    <?php
    if (isset($_SESSION['admin'])) {
        $email = $_SESSION['admin'];
        $q = "select * from registration where email='$email'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
    }
    ?>
    <div class="container">
        <div class="row text-center">
            <div class="col-12 bg-dark text-white p-2 align-center">
                <h1>Profile Information</h1>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php echo "images/profile_pictures/" . $row['profile_picture']; ?>" alt="Profile Picture" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h5 class="card-title"><?php echo $row['fullname']; ?></h5>

                                
                                <p class="card-text">Email: <?php echo $row['email']; ?></p>
                                <p class="card-text">Phone: <?php echo $row['mobile_number']; ?></p>
                                <p class="card-text">Address: <?php echo $row['address']; ?></p>
                                <p class="card-text">Gender: <?php echo $row['gender']; ?></p>

                                <a href="admin_edit_profile.php" class="btn btn-dark">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include_once("admin_footer.php");
