<?php
include_once("header.php");
include_once("admin_authentication.php");
$id = $_GET['id'];

$query = "update registration set status='Deleted' where id=$id";

if (mysqli_query($con, $query)) {
    setcookie('success', "User deleted successfully", time() + 5, "/");
} else {
    setcookie('error', "Error in deleting user", time() + 5, "/");
}
?>
<script>
    window.location.href = "manage_users.php";
</script>

?>

<?php
include_once("admin_footer.php");

?>