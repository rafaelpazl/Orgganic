<?php
include('../backend/config.php');
// Function to create a directory for product images

function createProductDirectory($userId, $productId) {
    $directory = "../uploads/" . $userId . "/" . $productId . "/";
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    return $directory;
}

// Function to move uploaded file to the specified directory and return the file path
function moveUploadedFile($file, $targetDirectory) {
    $targetFile = $targetDirectory . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    } else {
        return null;
    }
}

$productId = isset($_POST['productId']);
$userId = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;
$mainImage = isset($_FILES['main_image']);

echo $productId, $userId, $mainImage;

/* if ($userId) {
    $productDirectory = createProductDirectory($userId, $productId);
    $mainImage = isset($_FILES['main_image']) ? moveUploadedFile($_FILES['main_image'], $productDirectory) : null;
    echo $mainImage;
}
 */
/* $sql = "INSERT INTO variation (main_image) VALUES (?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {            
                    // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $mainImage);

            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Produto adicionado com sucesso.";
                /* header("Location: ../pages_admin/frontend_add_unit_product_input.php");
                exit; */
           /*  } else {
                echo "Erro ao adicionar produto: " . mysqli_error($conn);
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao preparar a declaração: " . mysqli_error($conn);
        } */

 
?>

