<?php
include_once("header.php");
include_once("admin_authentication.php");
$id = $_GET['id'];
$status = $_GET['status'];

$q = "update offers set status='$status' where `id`=$id";

if (mysqli_query($con, $q)) {
    setcookie('success', "Offer status updated to $status", time() + 5, "/");
} else {
    setcookie('error', "Error in updating offer status", time() + 5, "/");
}
?>
<script>
    window.location.href = "manage_offers.php";
</script>

<?php
include_once("admin_footer.php");
?>