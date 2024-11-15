<?php
include_once('header.php');
include_once("user_authentication.php");
$email = $_SESSION['user'];
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $check_product = "select * from cart where product_id=$id and email='$email'";
    $count = mysqli_num_rows(mysqli_query($con, $check_product));
    echo $count;
    if ($count == 0) {
        $q = "INSERT INTO wishlist (email, product_id) VALUES ('$email', $id)";
        if (mysqli_query($con, $q)) {
            setcookie('success', "Product added to wishlist", time() + 5, "/");
        } else {
            setcookie('error', 'Error in adding product to wishlist', time() + 5, "/");
        }
    } else {
        setcookie("success", "Product already added to Wishlist", time() + 5, "/");
    }
}
?>
<script>
    window.location.href = "view_wishlist.php";
</script>