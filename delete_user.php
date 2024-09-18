<?php
include_once("header.php");

$id = $_GET['id'];

$update = "update registration set `status`='Deleted' where `id`=$id";
if (mysqli_query($con, $update)) {
    setcookie('success', "user data updated", time() + 2);
?>
    <script>
        window.location.href = "manage_users.php";
    </script>
<?php
} else {
    setcookie('success', "user data updated", time() + 2);
?>
    <script>
        window.location.href = "manage_users.php";
    </script>
<?php
}
