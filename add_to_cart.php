<?php
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $quantity = 1;
    $check_product = "select * from cart where product_id=$id and email='$email'";
    $count = mysqli_num_rows(mysqli_query($con, $check_product));
    echo $count;
    if ($count == 0) {
        $q = "select * from products where id=$id";
        $products = mysqli_query($con, $q);
        while ($r = mysqli_fetch_assoc($products)) {
            $price = $quantity * $r['discounted_price'];
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
}
