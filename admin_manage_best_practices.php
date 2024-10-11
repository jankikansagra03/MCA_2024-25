<?php
include_once("header.php");
include_once('admin_authentication.php');
$q = "select * from best_practices";
$result = mysqli_query($con, $q);
?>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Manage Best Practices</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-6" style="text-align: right;">
        </div>

        <div class="col-3 style=" text-align: right;">
            <!-- <input id="myInput" type="text" placeholder="Search.." class="form-control"> -->

        </div>
        <div class="col-2" style="text-align: right;">
            <a href="admin_add_best_practice.php" class="btn btn-dark form-control;"><i class="fas fa-user-plus"></i> Add Best Practices</a>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>Slider Image</th>
                            <th>Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($r = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $r['id']; ?></td>
                                <td>
                                    <img src="images/best_practices/<?php echo $r['img_name']; ?>" class="img-fluid" height="35%" width="40%" />
                                </td>
                                <td>
                                    <a href='admin_delete_best_practice.php?id=<?php echo $r['id'] ?>' class='btn btn-dark'><i class='fas fa-trash'></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once('admin_footer.php');
