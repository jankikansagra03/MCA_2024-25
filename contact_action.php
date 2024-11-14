<?php
include_once("header.php");
if (isset($_POST['btn'])) {
    $name = $_POST['fn'];
    $em = $_POST['email'];
    $mobile = $_POST['mobile'];
    $msg = $_POST['msg'];

    $q = "insert into inquiry (`fullname`, `email`, `mobile`, `message`) values ('$name','$em',$mobile,'$msg')";
    if (mysqli_query($con, $q)) {
        setcookie("success", "we have saved your inquiry, soon you will hear from us", time() + 5, "/");
    } else {
        setcookie("error", "Error in sending inquiry. Please try after sometime", time() + 5, "/");
    }
?>
    <script>
        window.location.href = "contact.php";
    </script>
<?php
}
include_once("footer.php");
