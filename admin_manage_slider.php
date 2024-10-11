<?php
include_once("header.php");
include_once('admin_authentication.php');
$q = "select * from sliders";
$result = mysqli_query($con, $q);
?>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Manage Sliders</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-6" style="text-align: right;">
        </div>

        <div class="col-4 style=" text-align: right;">
            <!-- <input id="myInput" type="text" placeholder="Search.." class="form-control"> -->

        </div>
        <div class="col-2" style="text-align: right;">
            <a href="admin_add_slider_image.php" class="btn btn-dark form-control;"><i class="fas fa-user-plus"></i> Add Slider Image</a>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>Slider Image</th>
                            <td>Action </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($r = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $r['id']; ?></td>
                                <td>
                                    <img src="images/slider/<?php echo $r['img_name']; ?>" class="img-fluid" height="30%" width="35%" />
                                </td>
                                <td>
                                    <a href='admin_delete_slider.php?id=<?php echo $r['id'] ?>' class='btn btn-dark'><i class='fas fa-trash'></i></a>
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
