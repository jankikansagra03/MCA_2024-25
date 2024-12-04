<?php
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];

?>

<script>
    $(document).ready(function() {
        $("form").validate({
            rules: {
                review: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                review: {
                    required: "Please enter your review.",
                    minlength: "Your review must be at least 10 characters long."
                }
            },
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            }

        });
    });
</script>
<?php

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $order_query = "SELECT * FROM orders WHERE sub_order_id='$id'";
    $order_result = mysqli_fetch_assoc(mysqli_query($con, $order_query));
?>
    <div class="container">
        <div class="row text-center">
            <div class="col-12 bg-dark text-white p-2 align-center">
                <h2>
                    Rate and Review order:: <?php echo $order_result['order_id']; ?>
                </h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8">
                <?php
                if ($order_result) {
                ?>
                    <div class="container">

                        <form action="user_review_product.php" method="POST">
                            <input type="hidden" name="sub_order_id" value="<?php echo $id; ?>">
                            <div class="mb-3">
                                <label for="rating" class="form-label"><b>Rating</b></label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="" disabled selected>Select Rating</option>
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="5">5 Stars</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label"><b>Review</b></label>
                                <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark" name="save_review">Submit Review</button>
                        </form>
                    </div>
            <?php
                } else {
                    echo "<p class='text-danger'>Order not found.</p>";
                }
            }
            ?>
            </div>
        </div>
    </div>

    <?php
    include_once('admin_footer.php');
    if (isset($_POST['save_review'])) {
        $sub_order_id = $_POST['sub_order_id'];
        $rating = $_POST['rating'];
        $review = mysqli_real_escape_string($con, $_POST['review']);

        $update_query = "UPDATE orders SET rating='$rating', review='$review' WHERE sub_order_id='$sub_order_id'";

        if (mysqli_query($con, $update_query)) {
            setcookie("success", "Thank you for your review!", time() + 5, "/"); // Cookie set for 30 days
        } else {
            setcookie("error", "Error in submitting review please try again after some time.", time() + 5, "/"); // Cookie set for 30 days

        }
    ?>
        <script>
            window.location.href = 'user_view_order.php?id=<?php echo $sub_order_id; ?>';
        </script>
    <?php
    }
    ?>