<?php
include_once('config.php');

// Verificar se o ID do produto foi passado pela URL
if(isset($_GET['id'])) {
    // Conectar ao banco de dados
    $conn = $conexao;

    // Obter o ID do produto da URL
    $productId = $_GET['id'];

    // Consulta SQL para obter o caminho da imagem principal do produto
    $getMainImagePathSql = "SELECT main_image FROM product WHERE id = ?";
    $getMainImagePathStmt = mysqli_prepare($conn, $getMainImagePathSql);
    mysqli_stmt_bind_param($getMainImagePathStmt, "s", $productId);
    mysqli_stmt_execute($getMainImagePathStmt);
    mysqli_stmt_bind_result($getMainImagePathStmt, $mainImagePath);
    mysqli_stmt_fetch($getMainImagePathStmt);
    mysqli_stmt_close($getMainImagePathStmt);

    // Excluir todas as variações do produto
    $deleteVariationsSql = "DELETE FROM variation WHERE product_id = ?";
    $deleteVariationsStmt = mysqli_prepare($conn, $deleteVariationsSql);
    mysqli_stmt_bind_param($deleteVariationsStmt, "s", $productId);
    mysqli_stmt_execute($deleteVariationsStmt);
    mysqli_stmt_close($deleteVariationsStmt);

    // Excluir o produto principal do banco de dados
    $deleteProductSql = "DELETE FROM product WHERE id = ?";
    $deleteProductStmt = mysqli_prepare($conn, $deleteProductSql);
    mysqli_stmt_bind_param($deleteProductStmt, "s", $productId);
    $success = mysqli_stmt_execute($deleteProductStmt);
    mysqli_stmt_close($deleteProductStmt);

    if ($success) {
        // Remover o arquivo de imagem principal do produto
        $mainImagePath = '../uploads/' . $mainImagePath;
        if (file_exists($mainImagePath)) {
            unlink($mainImagePath);
        }

        // Remover imagens adicionais do produto
        // Recupere o caminho das imagens adicionais do produto, se houver, e exclua-as

        echo "Produto e todas as suas variações excluídos com sucesso.";
        header("Location: ../pages_admin/manager_products.php");
        exit;
    } else {
        echo "Erro ao excluir o produto.";
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
} else {
    echo "ID do produto não fornecido na URL.";
}
?>
