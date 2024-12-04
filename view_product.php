<?php
include_once("header.php");
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Start Generation Here
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
?>
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="bg-dark text-white p-2 align-center"><?php echo htmlspecialchars($product['product_name']); ?></h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <img src="images/products/<?php echo htmlspecialchars($product['main_image']); ?>" class="img-fluid" height="200px" width="200px" />
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon bg-dark text-white">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="timeline-content shadow-sm">
                                <h5 class="text-dark">Product Description</h5>
                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-icon bg-dark text-white">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="timeline-content shadow-sm">
                                <h5 class="text-dark">Price</h5>
                                <p><strong>Price:</strong> ₹ <?php echo number_format($product['price'], 2); ?></p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-icon bg-dark text-white">
                                <i class="fas fa-percent"></i>
                            </div>
                            <div class="timeline-content shadow-sm">
                                <h5 class="text-dark">Discount</h5>
                                <p><strong>Discount:</strong> <?php echo htmlspecialchars($product['discount']); ?>%</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-icon bg-dark text-white">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="timeline-content shadow-sm">
                                <h5>Review and Ratings</h5><br>
                                <?php
                                $reviews_query = "SELECT rating, review,email FROM orders WHERE product_id = $id";
                                $reviews_result = mysqli_query($con, $reviews_query);
                                $total_rating = 0;
                                $rating_count = 0;

                                while ($review = mysqli_fetch_assoc($reviews_result)) {
                                    if ($review['review'] != NULL && $review['rating'] != NULL) {
                                        $user = "select * from registration where email='$email'";
                                        $user_result = mysqli_fetch_assoc(mysqli_query($con, $user));
                                        $user_image = $user_result['profile_picture']; // Assuming there's a profile_image field in the registration table
                                        $user_name = htmlspecialchars($user_result['fullname']); // Assuming there's a fullname field in the registration table
                                ?>
                                        <div class="review-user">
                                            <img src="images/profile_pictures/<?php echo $user_image; ?>" class="img-thumbnail rounded" alt="User Image" style="width: 50px; height: 50px; margin-right: 10px;">
                                            <strong><?php echo $user_name; ?></strong>
                                        </div>
                                        <div style="margin: 10px 60px;">
                                            <p style="margin: 0px;"><b>Rating: </b><?php echo htmlspecialchars($review['rating']); ?></p>
                                            <p><b>Review:</b> <?php echo htmlspecialchars($review['review']); ?></p>
                                        </div>
                                <?php
                                        $total_rating += $review['rating'];
                                        $rating_count++;
                                    }
                                }
                                $average_rating = $rating_count > 0 ? $total_rating / $rating_count : 0;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon bg-dark text-white">
                                <i class="fa fa-images"></i>
                            </div>
                            <div class="timeline-content shadow-sm">

                                <h5 class="text-dark">Other Images</h5>
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <?php
                                        $other_images = explode(",", $product['other_images']);
                                        $count = count($other_images);
                                        for ($i = 0; $i <= $count - 1; $i++) {
                                        ?>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" class="active" aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php
                                        $i = 1;
                                        foreach ($other_images as $image) {
                                        ?>
                                            <div class="carousel-item <?php if ($i == 1) {
                                                                            echo "active";
                                                                        } ?>">
                                                <img src="images/products/<?php echo $image; ?>" class="d-block w-100 img-fluid" alt="...">
                                            </div>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>

                                </div>

                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-icon bg-dark">
                                <i class="fa-solid fa-thumbs-up" style="color: #ffffff;"></i>
                            </div>
                            <div class="timeline-content shadow-sm">
                                <h4>Average Rating: (<?php echo number_format($average_rating, 1); ?>)</h4>
                                <div class="average-rating">

                                    <div style="font-size: 20px; color: BLACK;">
                                        <?php

                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $average_rating) {
                                                echo '★'; // Full star
                                            } else {
                                                echo '☆'; // Empty star
                                            }
                                        }
                                        ?>
                                    </div>
                                    <p style="color: #black;">Based on <?php echo $rating_count; ?> reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<?php
    } else {
        echo "<p>Product not found.</p>";
    }
}
include_once("admin_footer.php");
