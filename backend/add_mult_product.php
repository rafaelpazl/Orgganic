<?php
include_once('config.php');

// Function to create a directory for a user if it doesn't exist
function createUserDirectory($userId) {
    $directory = "../uploads/" . $userId . "/";
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    return $directory;
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = $conexao;

    // Retrieve user ID from cookies
    $userId = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;

    if ($userId) {
        // Generate unique product ID
        $productId = uniqid();

        // Obter os dados do formulário
        $title = isset($_POST['title-product']) ? $_POST['title-product'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $sku = isset($_POST['sku']) ? $_POST['sku'] : '';
        $qnt_storage = isset($_POST['storage']) ? $_POST['storage'] : '';

        // Create directory for main product images
        $productDirectory = createProductDirectory($userId, $productId);

        // Move main image to product directory
        $mainImage = isset($_FILES['picture__input']) ? moveUploadedFile($_FILES['picture__input'], $productDirectory) : null;

        // Move additional images to product directory
        $additionalImages = [];
        if (isset($_FILES['picture__input__mult']['tmp_name'])) {
            foreach ($_FILES['picture__input__mult']['tmp_name'] as $fileKey => $tmpName) {
                if (!empty($tmpName) && isset($_FILES['picture__input__mult']['name'][$fileKey])) {
                    $additionalImages[] = moveUploadedFile(
                        ['tmp_name' => $tmpName, 'name' => $_FILES['picture__input__mult']['name'][$fileKey]], 
                        $productDirectory
                    );
                }
            }
        }

        // Preparar e executar a consulta SQL
        $sql = "INSERT INTO product (id, title, description, price, sku, qnt_storage, main_image, additional_images, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            // Prepare additional images as a comma-separated string
        $additionalImagesStr = implode(',', $additionalImages);

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssdsssssi", $productId, $title, $description, $price, $sku, $qnt_storage, $mainImage, $additionalImagesStr, $userId);


            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Produto adicionado com sucesso.";
                // header("Location: ../pages/index.html");
                exit;
            } else {
                echo "Erro ao adicionar produto: " . mysqli_error($conn);
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao preparar a declaração: " . mysqli_error($conn);
        }
    } else {
        echo "Erro: ID do usuário não encontrado nos cookies.";
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
}
?>
