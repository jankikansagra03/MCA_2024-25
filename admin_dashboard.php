<?php
include_once('header.php');
include_once('admin_authentication.php');
?>
<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Admin Dashboard</h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-users"></i>
                        <h5 class="card-title">Total Users</h5>
                        <?php
                        $query = "SELECT COUNT(*) as total_users FROM registration";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo '<p class="card-text">' . $row['total_users'] . '</p>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-list"></i>
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-shopping-bag"></i>
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="card bg-dark text-white mb-4 ">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope"></i>
                        <h5 class="card-title">Total Inquiries</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body text-center">

                        <i class="fas fa-user-check"></i>
                        <h5 class="card-title">Active Users</h5>
                        <?php
                        $query = "SELECT COUNT(*) as total_users FROM registration where status='Active'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo '<p class="card-text">' . $row['total_users'] . '</p>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-user-times"></i>
                        <h5 class="card-title">Inactive Users</h5>
                        <?php
                        $query = "SELECT COUNT(*) as total_users FROM registration where status='Inactive'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo '<p class="card-text">' . $row['total_users'] . '</p>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-users"></i>
                        <h5 class="card-title">Pending Orders</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-users"></i>
                        <h5 class="card-title">Today's Orders</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include_once("admin_footer.php");
?>