<?php
include_once('header.php');
include_once("user_authentication.php");
$email = $_SESSION['user'];
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $q = "delete from wishlist where product_id=$id and email='$email'";
    echo $q;
    if (mysqli_query($con, $q)) {
        setcookie('success', "Product removed from wishlist", time() + 5, "/");
    } else {
        setcookie('error', 'Error in removing product', time() + 5, "/");
    }
}
?>
<script>
    window.location.href = "view_wishlist.php";
</script>