<?php
// Cart items
$cart_items = [
    ["product_id" => 1, "price" => 5000],
    ["product_id" => 2, "price" => 7000],
];

// Cart total
$cart_total = array_sum(array_column($cart_items, "price"));

// Total discount
$total_discount = 200; // ₹200 discount on ₹12000 cart total

// Distribute the discount
foreach ($cart_items as &$item) {
    // Calculate the proportion of the cart total
    $proportion = $item["price"] / $cart_total;

    // Calculate the discount for the product
    $item_discount = round($proportion * $total_discount, 2);

    // Store the discounted price
    $item["discounted_price"] = $item["price"] - $item_discount;

    // Store the discount amount for reference
    $item["discount"] = $item_discount;
}

// Display results
print_r($cart_items);
