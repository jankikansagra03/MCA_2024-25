<?php
include_once("header.php");
$_SESSION['user'] = "jankikansagra12@gmail.com";
$email = $_SESSION['user'];
include_once("user_authentication.php");


if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    echo $id;
}

$quantity = 1;

$check_product = "select * from cart where id=$id and email='$email'";
$count = mysqli_num_rows(mysqli_query($con, $check_product));
if ($count == 0) {
    $q = "select * from products where id=$id";
    $products = mysqli_query($con, $q);
    while ($r = mysqli_fetch_assoc($products)) {
        $price = $quantity * $r['price'];
    }

    $insert = "INSERT INTO `cart`(`email`, `product_id`, `quantity`, `total_price`) VALUES ('$email',$id,$quantity,$price)";
    if (mysqli_query($con, $insert)) {
        setcookie("success", "product added to cart", time() + 5, "/");
?>
        <script>
            window.location.href = "view_cart.php";
        </script>
    <?php
    } else {
        setcookie("error", "Error in adding to cart", time() + 5, "/");
    ?>
        <script>
            window.location.href = "gallery.php";
        </script>
    <?php
    }
} else {

    setcookie("success", "Product already added to cart", time() + 5, "/");
    ?>
    <script>
        window.location.href = "view_cart.php";
    </script>
<?php
}
