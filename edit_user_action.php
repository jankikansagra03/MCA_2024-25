<?php
include_once("header.php");
if (isset($_POST['btn'])) {
    $fn = $_POST['fn'];
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];

    $address = $_POST['address'];
    $gen = $_POST['gen'];
    $mobile = $_POST['mobile'];
    $q = "select * from registration where `email`='$email'";
    $result = mysqli_query($con, $q);
    while ($r = mysqli_fetch_array($result)) {
        $_SESSION['old_pic'] = $r[7];
    }
    if ($_FILES['pic']['name'] != "") {
        $pic = uniqid() . $_FILES['pic']['name'];
        $update_query = "UPDATE `registration` SET `fullname`='$fn',`password`='$pswd',`address`='$address',`gender`='$gen',`mobile_number`=$mobile,`profile_picture`='$pic' WHERE `email`='$email'";
    } else {
        $update_query = "UPDATE `registration` SET `fullname`='$fn',`password`='$pswd',`address`='$address',`gender`='$gen',`mobile_number`=$mobile WHERE `email`='$email'";
    }
    if (mysqli_query($con, $update_query)) {
        if ($_FILES['pic']['name'] != "") {
            unlink("images/profile_pictures/" . $_SESSION['old_pic']);
            move_uploaded_file($_FILES['pic']['tmp_name'], "images/profile_pictures/" . $pic);
        }
        setcookie('success', "user data updated", time() + 60, "/");
?>
        <script>
            window.location.href = "manage_users.php";
        </script>
    <?php
    } else {
        setcookie('error', "Error in updating data", time() + 60, "/");
    ?>
        <script>
            window.location.href = "manage_users.php";
        </script>
<?php
    }
}
