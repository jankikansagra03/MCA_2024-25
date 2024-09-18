<?php
include_once("header.php");

$q = "select * from registration";
$result = mysqli_query($con, $q);
?>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
    while ($r = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $r['id']; ?></td>
            <td><?php echo $r['fullname']; ?></td>
            <td><?php echo $r['email']; ?></td>
            <td><?php echo $r['status']; ?></td>
            <td>
                <a href="view_user.php?id=<?php echo $r['id']; ?>">
                    <input type="button" value="View" class="btn btn-info">
                </a>
                <a href="edit_user.php?id=<?php echo $r['id']; ?>">
                    <input type="button" value="Edit" class="btn btn-primary">
                </a>
                <a href="delete_user.php?id=<?php echo $r['id']; ?>">
                    <input type="button" value="Delete" class="btn btn-danger">
                </a>
            </td>
        </tr>
    <?php

    }
    ?>
</table>

<?php
$q = "select * from registration";
$result = mysqli_query($con, $q);

?>
<div class="container">
    <div class="row">

        <?php
        while ($r1 = mysqli_fetch_assoc($result)) {

        ?>

            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-xs-12">
                <div class="card">
                    <img src="images/profile_pictures/<?php echo
                                                        $r1['profile_picture']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Television</h5>
                        <p class="card-text">Price: Rs. 80,000</p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>
<?php

http://localhost/MCA_2024-25/edit_user.php?id=3