<?php
include_once('../backend/config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['productId'])) {
    $conn = $conexao;

    // Obter o ID do produto da URL
    $productId = $_GET['productId'];

    // Consulta SQL para selecionar as variações do produto com base no ID
    $getVariationsSql = "SELECT variations FROM product WHERE id = ?";
    $getVariationsStmt = mysqli_prepare($conn, $getVariationsSql);

    if ($getVariationsStmt) {
        mysqli_stmt_bind_param($getVariationsStmt, "s", $productId);
        mysqli_stmt_execute($getVariationsStmt);
        mysqli_stmt_bind_result($getVariationsStmt, $variations); // Aqui estamos tentando armazenar o resultado da consulta em $variations
        mysqli_stmt_fetch($getVariationsStmt); // Aqui tentamos buscar o resultado

        // Verificar se as variações foram encontradas
        if ($variations !== null) { // Verifica se $variations não é null
            // Deserializar as variações apenas se $variations não for null
            if (is_string($variations)) { // Verifica se $variations é uma string
                $variationsArray = unserialize($variations);

                // Verificar se $variationsArray é um array antes de tentar iterá-lo
                if (is_array($variationsArray)) {
                    // Exibir as variações
                    foreach ($variationsArray as $variationKey => $variationValue) {
                        if (is_array($variationValue)) {
                            // Se o valor da variação for um array, imprima suas chaves e valores
                            echo "<p>" . ucfirst($variationKey) . ":</p>";
                            echo "<ul>";
                            foreach ($variationValue as $innerKey => $innerValue) {
                                echo "<li>" . ucfirst($innerKey) . ": " . $innerValue . "</li>";
                            }
                            echo "</ul>";
                        } else {
                            // Se o valor da variação for uma string, imprima normalmente
                            echo "<p>" . ucfirst($variationKey) . ": " . $variationValue . "</p>";
                        }
                    }
                } else {
                    echo "As variações não estão em um formato válido.";
                }
            } else {
                echo "As variações não estão em um formato válido.";
            }
        } else {
            echo "Nenhuma variação encontrada para o produto com ID: " . $productId;
        }

        // Fechar a declaração e a conexão
        mysqli_stmt_close($getVariationsStmt);
        mysqli_close($conn);
    } else {
        echo "Erro ao preparar a consulta: " . mysqli_error($conn);
    }
} else {
    echo "Nenhum ID de produto fornecido na URL.";
}
?>
