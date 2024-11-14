<?php
include_once("header.php");

?>

<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-4 align-center">
            <h1>About RK University</h1>
        </div>
    </div>
    <br>
    <div class="row p-4">
        <?php
        $query = "SELECT * FROM about_us";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                echo $row['content'];
            }
        }

        ?>
    </div>
</div>

<?php
include_once("footer.php");
?>