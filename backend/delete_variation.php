<?php
include_once('config.php');

// Verificar se o UUID da variação foi passado pela URL
if(isset($_GET['uuid'])) {
    // Conectar ao banco de dados
    $conn = $conexao;

    // Obter o UUID da variação da URL
    $variationUUID = $_GET['uuid'];
    $productId = $_GET['productId'];

    // Consulta SQL para obter o caminho da imagem da variação
    $getImagePathSql = "SELECT main_image FROM variation WHERE uuid = ?";
    $getImagePathStmt = mysqli_prepare($conn, $getImagePathSql);
    mysqli_stmt_bind_param($getImagePathStmt, "s", $variationUUID);
    mysqli_stmt_execute($getImagePathStmt);
    mysqli_stmt_bind_result($getImagePathStmt, $imagePath);
    mysqli_stmt_fetch($getImagePathStmt);
    mysqli_stmt_close($getImagePathStmt);

    // Verificar se a consulta retornou um caminho de imagem válido
    if ($imagePath) {
        // Excluir a variação do banco de dados
        $deleteVariationSql = "DELETE FROM variation WHERE uuid = ?";
        $deleteVariationStmt = mysqli_prepare($conn, $deleteVariationSql);
        mysqli_stmt_bind_param($deleteVariationStmt, "s", $variationUUID);
        $success = mysqli_stmt_execute($deleteVariationStmt);
        mysqli_stmt_close($deleteVariationStmt);

        if ($success) {
            // Remover o arquivo de imagem da variação
            $filePath = '../uploads/' . $imagePath;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $productId = $_GET['product_id'];
            echo "Variação excluída com sucesso.";
            // Redirect to view_product.php with the productId parameter in the URL
            header("Location: ../pages_admin/view_product.php?id=$productId");
            exit;
        } else {
            echo "Erro ao excluir a variação.";
        }
    } else {
        echo "Caminho da imagem não encontrado para a variação especificada.";
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
} else {
    echo "UUID da variação não fornecido na URL.";
}
?>
