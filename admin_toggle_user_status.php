<?php
include_once("header.php");
include_once('admin_authentication.php');
$id = $_GET['id'];
$status = $_GET['status'];

if ($status == "Active") {
    $updt = "update registration set status='Inactive' where id=$id";
} else {
    $updt = "update registration set status='Active' where id=$id";
}

if (mysqli_query($con, $updt)) {
    setcookie("success", "User status updated", time() + 5, "/");
?>
    <script>
        window.location.href = "manage_users.php";
    </script>
<?php
}

include_once("admin_footer.php");
?>