<?php
include_once('config.php');

require_once __DIR__ . '/../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

function createUserDirectory($userId) {
    $directory = "../uploads/" . $userId . "/";
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    return $directory;
}

function createProductDirectory($userId, $uuid) {
    $directory = "../uploads/" . $userId . "/" . $uuid . "/";
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    return $directory;
}

function moveUploadedFile($file, $targetDirectory) {
    $targetFile = $targetDirectory . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    } else {
        return null;
    }
}

// Verificar se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = $conexao;

    // Verificar se o ID do produto foi fornecido na URL
    $productId = isset($_GET['productId']) ? $_GET['productId'] : null;

    // Verificar se o ID do usuário está disponível nos cookies
    $userId = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;

    // Verificar se o ID do produto e do usuário estão disponíveis
    if ($productId && $userId) {
        // Gerar UUID para a variação
        $variationUUID = Uuid::uuid4()->toString();

        // Extrair dados da variação do formulário
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $variation = isset($_POST['variation']) ? $_POST['variation'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $discount = isset($_POST['discount']) ? $_POST['discount'] : '';
        $gtin = isset($_POST['gtin']) ? $_POST['gtin'] : '';
        $storage = isset($_POST['storage']) ? $_POST['storage'] : '';

        // Criar diretório para as imagens principais do produto
        $productDirectory = createProductDirectory($userId, $variationUUID);

        // Mover a imagem principal para o diretório do produto
        $mainImage = isset($_FILES['picture__input']) ? moveUploadedFile($_FILES['picture__input'], $productDirectory) : null;

        // Verificar se a tabela 'variation' existe, caso contrário, criá-la
        $createTableSql = "CREATE TABLE IF NOT EXISTS variation (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id VARCHAR(255) NOT NULL,
            uuid VARCHAR(255) NOT NULL,
            category VARCHAR(255) NOT NULL,
            variation VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            discount INT NOT NULL,
            gtin VARCHAR(255) NOT NULL,
            storage INT NOT NULL,
            main_image VARCHAR(255) NOT NULL,
            FOREIGN KEY (product_id) REFERENCES product(id)
        )";
        mysqli_query($conn, $createTableSql);

       // Inserir dados da variação na tabela 'variation'
$insertVariationSql = "INSERT INTO variation (product_id, uuid, category, variation, price, discount, gtin, storage, main_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$insertVariationStmt = mysqli_prepare($conn, $insertVariationSql);

if ($insertVariationStmt) {
    mysqli_stmt_bind_param($insertVariationStmt, "ssssddsss", $productId, $variationUUID, $category, $variation, $price, $discount, $gtin, $storage, $mainImage);

    if (mysqli_stmt_execute($insertVariationStmt)) {
        // Redirecionar para a página de adição de variações com o mesmo ID do produto
        header("Location: ../pages_admin/frontend_add_mult_product_input2.php?productId=$productId");
        exit;
    } else {
        echo "Erro ao adicionar variação do produto: " . mysqli_error($conn);
    }

    mysqli_stmt_close($insertVariationStmt);
} else {
    echo "Erro ao preparar a declaração para inserir variação: " . mysqli_error($conn);
}

    } else {
        echo "ID do produto ou do usuário não fornecido.";
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conn);
}
?>
