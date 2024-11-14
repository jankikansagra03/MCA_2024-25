<?php
include_once('header.php');
include_once("user_authentication.php");
$email = $_SESSION['user'];
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $q = "select * from cart where email='$email' and  product_id=$id";
    echo $q;
    $result = mysqli_query($con, $q);
    while ($r = mysqli_fetch_assoc($result)) {
        if ($r['quantity'] == 5) {
            setcookie('error', "Quantity cant be more than 5", time() + 5, "/");
        } else {
            $total = $r['total_price'];
            $price_per_product = $total / $r['quantity'];
            $quantity = $r['quantity'] + 1;
            $final_price = $quantity * $price_per_product;

            $updt = "update cart set quantity=$quantity,total_price=$final_price where email='$email' and  product_id=$id";
            echo $updt;
            if (mysqli_query($con, $updt)) {
                setcookie('success', "Cart updated successfully", time() + 5, "/");
            } else {
                setcookie('error', 'Error in updating cart', time() + 5, "/");
            }
        }
    }
}
?>
<script>
    window.location.href = "view_cart.php";
</script>