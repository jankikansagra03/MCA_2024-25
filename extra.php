 <div class="container">
     <div class="row text-center">
         <div class="col-2"></div>
         <div class="col-8">
             <h1><u><?php echo htmlspecialchars($product['product_name']); ?></u></h1>
         </div>
     </div>
     <br>
     <div class="row">
         <div class="col-2"></div>
         <div class="col-md-4">
             <img src="images/products/<?php echo htmlspecialchars($product['main_image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
         </div>
         <div class="col-md-4">
             <h3>Details</h3>
             <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
             <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
             <p><strong>Status:</strong> <?php echo $product['status']; ?></p>
             <p><strong>Quantity Available:</strong> <?php echo $product['quantity']; ?></p>
             <p><strong>Discount:</strong> <?php echo $product['discount']; ?>%</p>
             <p><strong>Category:</strong> <?php
                                            $category_id = $product['category_id'];
                                            $category_query = "SELECT category_name FROM category_master WHERE id = $category_id";
                                            $category_result = mysqli_query($con, $category_query);
                                            $category_row = mysqli_fetch_assoc($category_result);
                                            echo htmlspecialchars($category_row['category_name']);
                                            ?></p>


         </div>
     </div>
     <br>
     <div class="row">
         <div class="col-2"></div>
         <div class="col-8">
             <h3>Other Images</h3>
             <?php
                $other_images = explode(",", $product['other_images']);
                foreach ($other_images as $image) {
                    echo '<img src="images/products/' . $image . '" class="img-thumbnail" alt="Additional Image" style="width: 150px; margin: 5px;">';
                }
                ?>
         </div>
     </div>
 </div>