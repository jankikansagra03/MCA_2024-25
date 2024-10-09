<?php
include_once("header.php");
include_once("admin_authentication.php");
$id = $_GET['id'];
?>
<div>
    <div class="container">
        <div class="row">
            <div class="col-12 bg-dark text-white p-2 text-center">
                <h1>User Details</h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        $id = $_GET['id'];
                        $query = "SELECT * FROM registration WHERE id = '$id'";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='row'>";
                                echo "<div class='col-4'>";
                                echo "<img src='images/profile_pictures/" . $row['profile_picture'] . "' alt='Profile Picture' class='img-fluid'>";
                                echo "</div>";
                                echo "<div class='col-8'>";
                                echo "<h5 class='card-title'>" . $row['fullname'] . "</h5>";
                                echo "<p class='card-text'>Email: " . $row['email'] . "</p>";
                                echo "<p class='card-text'>Mobile Number: " . $row['mobile_number'] . "</p>";
                                echo "<p class='card-text'>Gender: " . $row['gender'] . "</p>";
                                echo "<p class='card-text'>Address: " . $row['address'] . "</p>";
                                echo "<p class='card-text'>Status: " . $row['status'] . "</p>";
                                echo "<div class='row'>";
                                echo "<div class='col-12'>";
                                echo "<a href='admin_edit_user.php?id=" . $row['id'] . "' class='btn btn-dark'>Edit</a> &nbsp;&nbsp;";
                                echo "<a href='admin_delete_user.php?id=" . $row['id'] . "' class='btn btn-dark'>Delete</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>User not found.</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include_once("admin_footer.php");
?>