<?php
// Include database connection
include_once('config.php');
$conn = $conexao;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if productId is set and not empty
    if (isset($_POST['productId']) && !empty($_POST['productId'])) {
        // Get productId from POST data
        $productId = $_POST['productId'];

        // Retrieve other form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $gtin = $_POST['gtin'];
        $qnt_storage = $_POST['qnt_storage'];

        // Update product details in the database
        $updateProductSql = "UPDATE product SET title=?, description=?, price=?, discount=?, gtin=?, qnt_storage=? WHERE id=?";
        $updateProductStmt = mysqli_prepare($conn, $updateProductSql);
        mysqli_stmt_bind_param($updateProductStmt, "ssddsss", $title, $description, $price, $discount, $gtin, $qnt_storage, $productId);
        
        if (mysqli_stmt_execute($updateProductStmt)) {
            echo "Product details updated successfully.";
            header("Location: ../pages_admin/view_product.php?id=$productId");
            exit;
        } else {
            echo "Error updating product details: " . mysqli_error($conn);
        }

        // Close statement and database connection
        mysqli_stmt_close($updateProductStmt);
        mysqli_close($conn);
    } else {
        echo "Product ID not provided.";
    }
} else {
    // Redirect to error page if accessed via GET request
    header("Location: error.php");
    exit();
}
?>
