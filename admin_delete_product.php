<?php
include_once("header.php");
include_once("admin_authentication.php");
$id = $_GET['id'];

$query = "update products set status='Deleted' where id=$id";

if (mysqli_query($con, $query)) {
    setcookie('success', "Product deleted successfully", time() + 5, "/");
} else {
    setcookie('error', "Error in deleting product", time() + 5, "/");
}
?>
<script>
    window.location.href = "manage_products.php";
</script>

?>

<?php
include_once("admin_footer.php");

?>