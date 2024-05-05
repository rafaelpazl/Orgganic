<?php
// Include database connection
include_once('config.php');
$conn = $conexao;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if productId is set and not empty
    if (isset($_POST['productId']) && !empty($_POST['productId'])) {
        // Get productId from POST data
        $productId = $_POST['productId'];

        // Retrieve and sanitize form data
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $discount = mysqli_real_escape_string($conn, $_POST['discount']);
        $gtin = mysqli_real_escape_string($conn, $_POST['gtin']);
        $qnt_storage = intval($_POST['qnt_storage']); // Sanitize as integer

        // Update product details in the database using prepared statement
        $updateProductSql = "UPDATE product SET title=?, description=?, price=?, discount=?, gtin=?, qnt_storage=? WHERE id=?";
        $updateProductStmt = mysqli_prepare($conn, $updateProductSql);
        mysqli_stmt_bind_param($updateProductStmt, "ssssssi", $title, $description, $price, $discount, $gtin, $qnt_storage, $productId);
        
        if (mysqli_stmt_execute($updateProductStmt)) {
            mysqli_stmt_close($updateProductStmt);
            mysqli_close($conn);
            // Redirect to view product page after successful update
            header("Location: ../pages_admin/view_product.php?id=$productId");
            exit;
        } else {
            // Log error and display generic error message
            error_log("Error updating product details: " . mysqli_error($conn));
            echo "Error updating product details. Please try again later.";
        }
    } else {
        // Provide error message if productId is not provided
        echo "Product ID not provided.";
    }
} else {
    // Redirect to error page if accessed via GET request
    header("Location: error.php");
    exit();
}
?>
