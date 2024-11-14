<?php
include_once('header.php');
include_once("user_authentication.php");
$email = $_SESSION['user'];
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $q = "delete from cart where product_id=$id and email='$email'";
    if (mysqli_query($con, $q)) {
        setcookie('success', "Product removed from cart", time() + 5, "/");
    } else {
        setcookie('error', 'Error in removing product', time() + 5, "/");
    }
}
?>
<script>
    window.location.href = "view_cart.php";
</script>