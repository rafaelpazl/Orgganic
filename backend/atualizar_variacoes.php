<?php
include_once('config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = $conexao;

    // Retrieve product ID from the form data
    $productId = isset($_POST['productId']) ? $_POST['productId'] : null;

    // Check if the product ID is available
    if ($productId) {
        // Loop through the variation data sent from the form
        for ($i = 0; $i < count($_POST['uuid']); $i++) {
            // Retrieve variation data
            $uuid = $_POST['uuid'][$i];
            $category = $_POST['category'][$i];
            $variation = $_POST['variation'][$i];
            $price = $_POST['price'][$i];
            $discount = $_POST['discount'][$i];
            $gtin = $_POST['gtin'][$i];
            $storage = $_POST['storage'][$i];

            // Update the variation data in the database
            $updateVariationSql = "UPDATE variation SET category = ?, variation = ?, price = ?, discount = ?, gtin = ?, storage = ? WHERE product_id = ? AND uuid = ?";
            $stmt = mysqli_prepare($conn, $updateVariationSql);
            mysqli_stmt_bind_param($stmt, "ssssssss", $category, $variation, $price, $discount, $gtin, $storage, $productId, $uuid);

            // Execute the update statement
            if (mysqli_stmt_execute($stmt)) {
                // Handle success, if needed
            } else {
                echo "Error updating variation: " . mysqli_error($conn);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }

        // Redirect back to the product details page
        header("Location: ../pages_admin/view_product.php?id=$productId");
        exit;
    } else {
        echo "Product ID not provided.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
